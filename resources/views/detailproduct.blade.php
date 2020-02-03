@extends('layouts/index')

@section('container')
<section class="ftco-section">
	<div class="container">
		@if (session()->has('warning'))
		<div class="alert alert-warning">
			{{session()->get('warning')}}
		</div>
		@endif
		<div class="row">
			<div class="col-lg-7 mb-5 ftco-animate">
				<a href="{{asset('storage/'. $product->avatar)}}" class="image-popup img-responsive"><img src="{{asset('storage/'. $product->avatar)}}" class="img-detail img-responsive" alt="Colorlib Template"></a>
			</div>
			<div class="col-lg-5 product-details pl-md-5 ftco-animate">
				<h3 class="text-capitalize">{{$product->product_name}}</h3>
				<div class="rating d-flex">
					<p class="text-left mr-4">
						@php
						$ratting = \DB::table('testimoni')->where('product_id', $product->id)->sum('value');
						$floor_item = \DB::table('testimoni')->where('product_id', $product->id)->get();
						$floor = count($floor_item);
						@endphp
						@if($floor != 0)
						<a href="#" class="mr-2">Ratting Product : {{($ratting / $floor) / 20}}</a>
						@endif
						@if($floor == 0)
						<a href="#" class="mr-2">Ratting Product : 0</a>
						@endif
					</p>
				</div>
				<p class="text-left">
					<a href="#" class="mr-2" style="color: #000;">{{$product->stock}} <span style="color: #bbb;">Stock Tersedia</span></a>
				</p>
				<p class="price"><span>Rp. {{number_format($product->price, 0)}}</span></p>
				<form action="{{route('cart.store')}}" method="POST">
					<div class="row mt-4">
						<div class="w-100"></div>
						<div class="input-group col-md-6 d-flex mb-3">
							<span class="input-group-btn mr-2">
								<button type="button" class="quantity-left-minus"  data-type="minus" data-field="">
									<i class="ion-ios-remove"></i>
								</button>
							</span>
							<input type="text" id="quantity" name="qty" class="form-control input-number" value="1" min="1" max="100">
							<span class="input-group-btn ml-2">
								<button type="button" class="quantity-right-plus" data-type="plus" data-field="">
									<i class="ion-ios-add"></i>
								</button>
							</span>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<p style="color: #000;">1000 g per 1 quantity</p>
						</div>
					</div>
					<p>{{ $product->description}}</p>
					@csrf
					<input type="hidden" name="id" value="{{$product->id}}">
					<input type="hidden" name="name" value="{{$product->product_name}}">
					<input type="hidden" name="price" value="{{$product->price}}">
					@guest

					@if ($product->stock > 0)


					<button type="button" style="background: #82ae46" data-toggle="modal" data-target="#loginModal" class="btn btn-outline-success btn-lg px-5">Tambah Ke Keranjang</button>

					@elseif($product->stock == 0)

					<button disabled type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-secondary btn-lg px-5">Stock Kosong</button>
					@endif


					@else

					@if ($product->stock > 0)

					<button type="submit" style="background: #82ae46" class="btn btn-outline-success btn-lg px-5">Tambah Ke Keranjang</button>

					@elseif($product->stock == 0)
					<button disabled type="submit" class="btn btn-secondary btn-lg px-5">Stock Kosong</button>

					@endif

					@endguest
				</form>

			</div>
		</div>
	</div>
</section>


<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center mb-3 pb-3">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<span class="subheading">Products</span>
				<h2 class="mb-4">Related Products</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">

			@foreach ($recentProducts as $product)

			<div class="col-md-6 col-lg-3 ftco-animate">
				<div class="product">
					<a href="#" class="img-prod"><img class="img-fluid" src="{{asset('storage/'. $product->avatar)}}" alt="Colorlib Template">
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
@section('section-footer')

<script>
	$(document).ready(function(){

		var quantitiy=0;
		$('.quantity-right-plus').click(function(e){

			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($('#quantity').val());

			// If is not undefined

			$('#quantity').val(quantity + 1);


			// Increment

		});

		$('.quantity-left-minus').click(function(e){
			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($('#quantity').val());

			// If is not undefined

			// Increment
			if(quantity>0){
				$('#quantity').val(quantity - 1);
			}
		});

	});
</script>
@endsection
