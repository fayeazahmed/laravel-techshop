<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('auth.reset-password', ['categories' => $categories]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $user = User::firstWhere('id', $request->user()->id);
        if (!Hash::check($request->old_password, $user->password))
            return redirect()->back()->withErrors('Current password does not match');

        $this->validate($request, [
            'password' => 'required|min:6',
            'password_confirmation' => ['same:password']
        ]);
        $user->update(['password' => Hash::make($request->password)]);
        $user->save();
        return redirect()->to('/account')->with('message', 'Password changed');
    }
}
