<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nusabaku</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}

    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <script src="https://kit.fontawesome.com/c024405133.js" crossorigin="anonymous"></script>
</head>
<body class="goto-here">
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}"><img src="https://lunarian-id.com/toko-online/storage/image_banner/nusabaku.png" class="img-responsive" width="200"  alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @foreach ($categories as $category)
                            <a class="dropdown-item" href="{{ url('/belanja/'. $category->id) }}">{{$category->name}}</a>
                            @endforeach

                            <!-- papatan iki menu, tapi engko diganti kategori seng onok nd dataabase -->

                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/cart') }}" class="nav-link">
                            <i class="icon-shopping_cart">{{Cart::count()}}</i>
                        </a>
                    </li>

                </ul>


                <div class="col-md-6 d-flex align-items-center">

                    <form action="{{url('/belanja')}}" class="subscribe-form" method="GET">
                        <div class="form-group d-flex">
                            <input type="text" class="form-control" name="cari" placeholder="masukkan produk">
                            <button type="submit" class="btn btn-primary submit px-3">Cari</button>
                        </div>
                    </form>

                </div>
                <ul class="navbar-nav ml-auto">

                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    @php
                    $data = \DB::table('orders')->where('status', 'order')->get()->all();
                    // dd(count($data));
                    @endphp

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('cekPembayaran', Auth::user()->id) }}"><i class="far fa-credit-card "></i><span class="badge badge-info"> {{count($data)}}</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @if (Auth::user()->hasAnyRole('admin'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">{{ __('Manage') }}</a>
                </li>
                @endif
                @endguest
            </ul>

        </div>
    </div>
</nav>

<section class="ftco-section">
    <div class="container">
        <div class="owl-carousel">
            @foreach ($banners as $banner)
            <div><img src="{{asset('storage/'. $banner->image)}}" alt=""></div>
            @endforeach
        </div>

    </div>
</section>


<section class="ftco-section">
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-6 col-lg-3 ftco-animate">

                <div id="product" class="product">

                    <a href="{{url('/show', $product->id)}}" class="img-prod"><img class="img-fluid" src="{{asset('storage/'. $product->avatar)}}" alt="Colorlib Template">
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">{{$product->product_name}}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="mr-2 price-dc"></span><span class="price-sale">Rp. {{number_format($product->price, 0)}}</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">

                                <form action="{{url('show', $product->id)}}" method="get">
                                    <button type="submit" class="btn btn-primary mr-1"><i class="ion-ios-menu"></i></button>
                                </form>
                                {{-- @dd($code) --}}
                                <form action="{{route('cart.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <input type="hidden" name="name" value="{{$product->product_name}}">
                                    <input type="hidden" name="price" value="{{$product->price}}">
                                    <input type="hidden" name="qty" value="1">
                                    @guest

                                    <button type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-primary"><i class="ion-ios-cart"></i></button>

                                    @else

                                    <button type="submit" class="btn btn-primary"><i class="ion-ios-cart"></i></button>

                                    @endguest
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            @endforeach
        </div>
    </div>
</section>

@include('layouts.footer.footer')



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/aos.js')}}"></script>
<script src="{{asset('js/jquery.animateNumber.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('js/scrollax.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{asset('js/google-map.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

<script>
    $('.owl-carousel').owlCarousel({
        stagePadding: 20,
        loop:true,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
    });
</script>

</body>
</html>
