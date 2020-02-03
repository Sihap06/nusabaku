@extends('admin.master')

@section('content')

<div class="container">
    <h2 class="text-center">Form Tambah Kategori</h2>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="p-5">
                <form class="user" action="{{route('categories.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleFirstName" placeholder="Nama Kategori">
                        @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection