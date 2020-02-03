@extends('admin.master')

@section('content')

<div class="container">
    <h2 class="text-center">Form Edit {{$user->name}}</h2>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="p-5">
                <form class="user" action="{{route('dashboard.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT')}}
                    
                    <div class="form-group">
                        <input type="text" name="name" value="{{$user->name}}" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Nama Lengkap">
                        @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" value="{{$user->email}}" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" placeholder="Email">
                        @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" value="{{$user->address}}" class="form-control form-control-user @error('address') is-invalid @enderror" id="alamat"  placeholder="Alamat Lengkap">
                        @error('address') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" value="{{$user->phone}}" class="form-control form-control-user @error('phone') is-invalid @enderror" id="telepon" placeholder="Nomor Telepon">
                        @error('phone') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    @error('phone') <div class="invalid-feedback">{{$message}}</div> @enderror
                    <div class="form-group">
                        <label for="Status">Roles User</label><br>
                        @foreach ($roles as $role)
                        <div class="form-check form-check-inline">
                            <input {{ $user->hasAnyRole($role->name) ? 'checked' : ''}} class="form-check-input" type="radio" name="roles[]" id="role" value="{{ $role->id}}">
                            <label class="form-check-label" for="role">{{$role->name}}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="Status">Status</label><br>
                        <div class="form-check form-check-inline">
                            <input {{$user->status == 'ACTIVE' ? 'checked' : ''}} class="form-check-input" type="radio" name="status" id="active" value="ACTIVE">
                            <label class="form-check-label" for="Active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input {{$user->status == 'INACTIVE' ? 'checked' : ''}} class="form-check-input" type="radio" name="status" id="inactive" value="INACTIVE">
                            <label class="form-check-label" for="Inactive">Inactive</label>
                        </div>
                    </div>
                    <div class="form-group">
                        @if ($user->avatar)
                        <img src="{{asset('storage/'. $user->avatar)}}" width="90px" alt="">
                        @endif
                        <div class="custom-file">
                            <input type="file" name="avatar" class="custom-file-input @error('avatar') is-invalid @enderror" id="avatar">
                            <label class="custom-file-label" for="avatar">Avatar</label>
                            <small class="text-muted">Kosongkan jika tidak ingin merubah gambar produk</small>
                            @error('avatar') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    
                    <Button type="submit" class="btn btn-primary btn-user">
                        Update
                    </Button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection