@extends('layouts.index1')

@section('container')

<form method="POST" action="{{ url('testi') }}" enctype="multipart/form-data">
	@csrf

	{{-- @php
		echo $data->id;
	@endphp --}}

	<div class="rating d-flex">
		<p class="text-left mr-4">
		<a href="#" class="mr-2 fa-2x">Rating : </a>
			<a href="{{url('testi/'. $data->id. '/'. 20)}}"><span class="ion-ios-star-outline fa-2x"></span></a>
			<a href="{{url('testi/'. $data->id. '/'. 40)}}"><span class="ion-ios-star-outline fa-2x"></span></a>
			<a href="{{url('testi/'. $data->id. '/'. 60)}}"><span class="ion-ios-star-outline fa-2x"></span></a>
			<a href="{{url('testi/'. $data->id. '/'. 80)}}"><span class="ion-ios-star-outline fa-2x"></span></a>
			<a href="{{url('testi/'. $data->id. '/'. 100)}}"><span class="ion-ios-star-outline fa-2x"></span></a>
		</p>

	</div>


</form>

@endsection

