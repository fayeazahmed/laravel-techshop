<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Product extends Component
{
    public $id;
    public $title;
    public $image;
    public $description;
    public $price;
    public $inStock;
    public $inCart;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $title, $image, $description, $price, $inCart, $inStock)
    {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->description = $description;
        $this->price = $price;
        $this->inCart = $inCart;
        $this->inStock = $inStock;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product');
    }
}
