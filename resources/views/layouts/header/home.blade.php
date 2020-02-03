<section class="ftco-section">
	<div class="container">
		<div class="owl-carousel">
			@foreach ($banners as $banner)
			<div><img src="{{asset('storage/'. $banner->image)}}" alt=""></div>
			@endforeach
		</div>
		
	</div>
</section>