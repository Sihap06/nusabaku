@extends('admin.master')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="p-5">
                <form class="user" action="/products/{{$product->id}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    
                    <div class="form-group">
                        <input type="text" name="name" value="{{$product->product_name}}" class="form-control form-control-user @error('name') is-invalid @enderror" id="email">
                        @error('name') <div class="invalid_feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" value="{{$product->price}}" class="form-control form-control-user @error('price') is-invalid @enderror" id="harga-produk" placeholder="Harga Produk">
                        @error('price') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="3" class="form-control form-control-user @error('description') is-invalid @enderror" id="harga-produk" placeholder="Deskripsi">{{$product->description}}</textarea>
                        @error('description') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input type="number" name="stock" value="{{$product->stock}}" min="0" value="0" class="form-control form-control-user @error('stock') is-invalid @enderror" id="harga-produk" placeholder="Stock Produk">
                        @error('stock') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" value="{{$product->address}}" class="form-control form-control-user @error('address') is-invalid @enderror" id="alamat-mitra" placeholder="Alamat Mitra">
                        @error('address') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="Status">Kategori</label><br>
                        @foreach ($categories as $category)
                        <div class="form-check form-check-inline">
                            <input {{ $product->hasAnyCategory($category->name) ? 'checked': ''}} class="form-check-input @error('categories') is-invalid @enderror" type="radio" name="categories[]" id="category" value="{{ $category->id}}">
                            <label class="form-check-label" for="product">{{$category->name}}</label>
                        </div>
                        @error('categories') <div class="invalid-feedback">{{$message}}</div> @enderror
                        @endforeach 
                    </div>
                    <div class="form-group">
                        @if ($product->avatar)
                        <img src="{{asset('storage/'. $product->avatar)}}" width="90px" alt="">
                        @endif
                        <div class="custom-file">
                            <input type="file" name="avatar" class="custom-file-input @error('avatar') is-invalid @enderror" id="customFile">
                            <label class="custom-file-label" for="avatar">Avatar</label>
                            <small class="text-muted">Kosongkan jika tidak ingin merubah gambar produk</small>
                            @error('avatar') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <Button type="submit" class="btn btn-primary btn-user">
                        Update
                    </Button>
                    {{-- <Button name="save_action" value="DRAFT" class="btn btn-success btn-user">
                        Save as draft
                    </Button> --}}
                </form>
            </div>
        </div>
    </div>
</div>

@endsection