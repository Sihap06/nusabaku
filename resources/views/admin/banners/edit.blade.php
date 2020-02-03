@extends('admin.master')

@section('content')

<div class="container">
    <h2 class="text-center">Form Edit Banner</h2>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="p-5">
                <form class="user" action="{{route('banners.update', $banner->id)}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    {{method_field('PUT')}}

                    @if ($banner->image)
                    <img src="{{asset('storage/'. $banner->image)}}" alt="" width="300px">
                    @endif
                    <div class="form-group mt-5">
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="customFile">
                            <label class="custom-file-label" for="customFile">Gambar Banner</label>
                            @error('image') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <Button type="submit" class="btn btn-primary btn-user btn-block">
                        Submit
                    </Button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
