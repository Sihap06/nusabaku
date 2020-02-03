@extends('admin.master')

@section('content')

<div class="container">
    <h2 class="text-center">Form Tambah Kategori</h2>
    <div class="row justify-content-left">
        <div class="col-lg-10">
            <div class="p-5">
                <form class="user" action="{{route('categories.update', ['category' => $category->id])}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    {{ method_field('PUT')}}
                    <div class="form-group">
                        <input type="text" name="name" value="{{$category->name}}" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleFirstName" placeholder="Nama Kategori">
                        @error('name') <div class="invalid_feedback">{{$message}}</div> @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Edit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection