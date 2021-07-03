<html lang="en"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <title>@yield('title', 'Laravel TechShop')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body cz-shortcut-listen="true">
  <nav>
      <div class="brand">
        <div class="burger-menus">
          <button class="btn"><i class="fa fa-bars" aria-hidden="true"></i></button>
          <button class="btn"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
        </div>
        <a href="/"><header>LARAVEL<br><span>TechShop</span></header></a>
        <input type="text" name="query" placeholder="Search for products">
        <div class="cart-menu">
          <a href="/cart"><i class="fa fa-cart-arrow-down fa-2x" aria-hidden="true"></i></a>
        </div>
      </div>
      <div class="links">
        <a href="/about">About</a>
        <a href="/cart"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a>
        @if (auth()->user())
          <a href="/account"><i class="fa fa-user me-1" aria-hidden="true"></i>Account</a>
          <a href="/logout"><i class="fa fa-sign-out me-1" aria-hidden="true"></i>Logout</a>
        @else
            <a href="/login"><i class="fa fa-user-circle me-1" aria-hidden="true"></i>Sign In</a>
        @endif
      </div>
  </nav>
  
  <div class="categories">
    <div class="container">
      <ul>
        @yield('category')
      </ul>
    </div>
  </div>

  @yield('message')

  <div class="container content">
      @yield('content')
  </div>

  </body>
</html>