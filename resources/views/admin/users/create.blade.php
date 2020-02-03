@extends('admin.master')

@section('content')

<div class="container">
    <h2 class="text-center">Form Register Admin</h2>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="p-5">
                <form class="user" action="{{route('dashboard.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <input value="{{old('name')}}" type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Nama lengkap">
                        @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input value="{{old('email')}}" type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" placeholder="Alamat email">
                        <small> ex : example@example.com</small>
                        @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="Password" placeholder="Password">
                            <small>minimal 8 karakter</small>
                            @error('password') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="confirmpassword" class="form-control form-control-user @error('confirmpassword') is-invalid @enderror" id="exampleRepeatPassword" placeholder="Konfirmasi password">
                            @error('confirmpassword') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input value="{{old('address')}}" type="text" name="address" class="form-control form-control-user @error('address') is-invalid @enderror"  placeholder="Alamat lengkap">
                        @error('address') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input value="{{old('phone')}}" type="text" name="phone" class="form-control form-control-user @error('phone') is-invalid @enderror" placeholder="Nomor telepon">
                        @error('phone') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="avatar" class="custom-file-input @error('avatar') is-invalid @enderror" id="customFile">
                            <label class="custom-file-label" for="customFile">Avatar</label>
                            @error('avatar') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Daftarkan Akun
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection