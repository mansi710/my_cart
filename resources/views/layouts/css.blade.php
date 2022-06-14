<html>
        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <script src="https:://code.jquery.com/jquery-3.6.0.min.js"></script>



        </head>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Shopping</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                  
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @can('isAdmin')
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('categoryies.index')}}">List Category</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('products.index')}}">List Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('orders.list')}}">Order List</a>
                        </li>
                    @endcan

                    @can('isUser')
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('userShopping')}}">
                            Shopping Iteam
                        </a>
                    </li>
                    @endcan

                  
                
                </ul>
               
                </div>
                
                @can('isUser')
                    <a class="nav-link active pull-right" aria-current="page" href="{{route('show.carts')}}">
                        <span class="badge radius:20rm badge-pill bg-success cart-count">
                            0
                        </span>
                    </a>
                @endcan

                <span class="navbar-text">
                    
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                                <a href="route('logout')"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                     {{Auth::user()->name}}
                                    {{ __('Log Out') }}
                                </a>
                        </form>
                       
                </span>
            </div>
        </nav>
        

        @yield('content')

        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https:://code.jquery.com/jquery-3.6.0.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        @yield('script') 
     
    </html>