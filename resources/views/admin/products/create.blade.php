@extends('admin.master')

@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-
rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-
rc.0/js/select2.min.js"></script>
<script>
    $('#categories').select2({
        ajax: {
            url: 'http://larashop.test/ajax/categories/search',
            processResults: function(data){
                return {
                    results: data.map(function(item){return {id: item.id, text:
                        item.name} })
                    }
                }
            }
        });
    </script>
    @endsection
    
    @section('content')
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="p-5">
                    <form class="user" action="{{route('products.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <input value="{{old('name')}}" type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" id="email" placeholder="Nama Produk">
                            @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <input value="{{old('price')}}" type="text" name="price" class="form-control form-control-user @error('price') is-invalid @enderror" id="harga-produk" placeholder="Harga Produk">
                        </div>
                        <div class="form-group">
                            <textarea name="description" rows="3" class="form-control form-control- @error('description') is-invalid @enderror" id="harga-produk" placeholder="Deskripsi"></textarea>
                            @error('description') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <input type="number" name="stock" min="0" value="0" class="form-control form-control-user @error('stock') is-invalid @enderror" id="harga-produk" placeholder="Stock Produk">
                            @error('stock') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" class="form-control form-control-user @error('address') is-invalid @enderror" id="alamat-mitra" placeholder="Alamat Mitra">
                            @error('address') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="Status">Pilih Kategori</label><br>
                            @foreach ($categories as $category)
                            {{-- @dd($category->id) --}}
                            
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('categories') is-invalid @enderror" type="checkbox" name="categories[]" id="category" value="{{ $category->id}}">
                                <label class="form-check-label" for="role">{{$category->name}}</label>
                                @error('categories') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <img width="100"class="img-responsive mb-2" id="uploadPreview"/> <br>
                            <div class="custom-file">
                                <input type="file" name="avatar" class="custom-file-input @error('avatar') is-invalid @enderror" id="uploadImage" onchange="PreviewImage()";>
                                <label class="custom-file-label" for="customFile">Gambar Produk</label>
                                @error('avatar') <div class="invalid-feedback">{{$message}}</div> @enderror
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
    @section('footer-script')
    
    <script>
        function PreviewImage() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
            
            oFReader.onload = function(oFREvent) {
                document.getElementById("uploadPreview").src = oFREvent.target.result;
            };
        };
    </script>
    
    @endsection