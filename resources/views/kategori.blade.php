@extends('layouts.index')


@section('container')
    
@include('layouts.header.home')

<section class="ftco-section">
    <div class="container">
        <div class="row">
           
            
            @foreach ($products['products']->all() as $product)
                
            <div class="col-md-6 col-lg-3 ftco-animate">
                
                <div class="product">
                    
                    <a href="{{url('/show', $product->id)}}" class="img-prod"><img class="img-fluid" src="{{asset('storage/'. $product->avatar)}}" alt="Colorlib Template">
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">{{$product->product_name}}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="price-sale">Rp. {{number_format($product->price)}}</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="{{url('/show', $product->id)}}" class="d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <form action="{{route('cart.store')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="qty" value="1">
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                        <input type="hidden" name="name" value="{{$product->product_name}}">
                                        <input type="hidden" name="price" value="{{$product->price}}">
                                    <button type="submit" class="btn btn-primary"><i class="ion-ios-cart"></i></button>
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

@endsection