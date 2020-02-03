@extends('admin.master')

@section('content')

<div class="container-fluid">
    <h2 class="text-center">Detail {{$product->product_name}}</h2>
    <div class="row justify-content-center">

        <div class="card align-items-center col-lg-8 mt-5 p-5">
            @if ($product->avatar)
            <img src="{{asset('storage/'. $product->avatar)}}" width="400px" alt="">
            @else
            <img src="{{asset('images/no_product.png')}}" width="400px" alt="">
            @endif
            <button data-toggle="modal" data-id="{{$product->id}}" data-target="#fotoModal" class="btn btn-outline-success mt-5">Ganti Foto</button>
        </div>


        <div class="col-lg-8 p-5">
            <div class="card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <b>Nama Produk :</b>
                    {{$product->product_name}}

                    <br>
                    <b>Harga :</b>
                    Rp. {{number_format($product->price, 0)}}

                    <br>
                    <b>Kategori :</b>
                    {{implode(', ', $product->categories()->get()->pluck('name')->toArray())}}

                    <br>
                    <b>Deskripsi :</b>
                    {{$product->description}}

                    <br>
                    <b>Stock :</b>
                    {{$product->stock}}

                    <br>
                    <b>Rating :</b>
                    {{-- {{$product->stock}} --}}

                    <p><a href="#" data-id="{{$product->id}}" data-price="{{$product->price}}" data-name="{{$product->product_name}}" data-deskripsi="{{$product->description}}" data-stock="{{$product->stock}}" data-toggle="modal" data-target="#dataModal" class="btn btn-outline-success mt-4">Edit Produk</a></p>

                </div>
            </div>
        </div>
    </div>


</div>
</div>


<!-- Modal -->
<div class="modal fade" id="fotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ganti Foto Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('gantiFotoProduk') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <img width="100"class="img-circle" id="uploadPreview"/> <br>

                    </div>

                    <div class="form-group">
                        <input type="file" style="border-radius: 5px; font-size: 15px" name="gambar" class="form-control" id="uploadImage" onchange="PreviewImage();" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{url('editProduct')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label>Nama Produk :</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label>Harga Produk :</label>
                        <input type="number" name="price" class="form-control" id="price">
                    </div>
                    <div class="form-group">
                        <label>Stock Produk :</label>
                        <input type="number" id="stock" name="stock" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Produk :</label>
                        <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer-script')
<script type="text/javascript">
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>

<script>

    $('#fotoModal').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var id = button.data('id')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
    });

    $('#dataModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var price = button.data('price')
        var stock = button.data('stock')
        var description = button.data('deskripsi')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #name').val(name)
        modal.find('.modal-body #price').val(price)
        modal.find('.modal-body #stock').val(stock)
        modal.find('.modal-body #description').val(description)
    });
</script>
@endsection
