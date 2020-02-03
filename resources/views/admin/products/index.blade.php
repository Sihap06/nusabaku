@extends('admin.master')

@section('content')

<div class="container-fluid">
    
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Produk</h1>
    
    {{-- button tambah produk --}}
    <a class="btn btn-primary mb-3" href="javascript:void(0)" id="create"> Tambah Produk</a>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name Produk</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

{{-- modal hapus --}}
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Postingan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('products.destroy', 'id')}}" method="POST">
                    {{method_field('DELETE')}}
                    @csrf
                    Hapus postingan ini ?
                    <input type="hidden" name="hapus_id" id="hapus_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createForm" name="createForm" method="POST" enctype="multipart/form-data">
                @csrf
                <meta name="csrf-token" content="{{csrf_token()}}">
                <div class="modal-body">
                    {{-- <input type="hidden" name="user_id" id="user_id" value=""> --}}
                    <div class="form-group">
                        <label for="status" class="col-form-label">Nama Produk:</label>
                        <input type="text" name="name" id="name" class="form-control ">
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Harga Produk:</label>
                        <input type="text" name="price" id="price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Stock:</label>
                        <input type="text" name="stock" id="stock" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Deskrispi:</label>
                        <input type="text" id="deskripsi" name="deskripsi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Alamat Mitra:</label>
                        <input type="text" name="address" id="address" class="form-control form-control-user" id="address">
                    </div>
                    <div class="form-group">
                        <label for="country">Kategori:</label>
                        <div class="select-wrap">
                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                            <select name="categories[]" id="category" class="form-control  @error('status') is-invalid @enderror">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <img width="100"class="img-responsive mb-2" id="uploadPreview"/> <br>
                        <label for="">Avatar:</label><br>
                        <input type="file" name="_avatar" id="_avatar" onchange="PreviewImage()";>
                        {{-- <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Avatar</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="avatar" id="_avatar" class="custom-file-input">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div> --}}
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save-btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@section('footer-script')

<script>
    $(document).ready(function(){
        var table = $('#dataTable').DataTable({
            processing:true,
            searching:true,
            order:[[0,'asc']],
            info:false,
            // lengthMenu: [[2,3,4,5,-1],[2,3,4,5,"All"]],
            serverside:true,
            ordering:false,
            ajax:"{{route('ajax.get.produk')}}",
            columns: [
            {data: 'rownum', name: 'rownum'},
            {data: 'product_name', name: 'product_name'},
            {data: 'price', name: 'price'},
            {data: 'stock', name: 'stock'},
            {data: 'action', name: 'action'},
            ]
            
        });
        
        var validator = $('#createForm').validate({
            rules: {
                name: {
                    required:true,
                    minlength:5,
                },
                price: {
                    required:true,
                    number:true,
                },
                stock: {
                    required:true,
                    number:true,
                },
                deskripsi: {
                    minlength:10,
                    required:true,
                },
                address: {
                    required:true,
                    minlength:10,
                },
                categories: {
                    required:true,
                    number:true,
                    minlength: 12,
                    maxlength: 13,  
                },
                _avatar: {
                    required:true,
                    extension: "jpg|jpeg|png",
                }
                
            }
        });
        
        $('#create').click(function () {
            $('#modal-title').html("Tambah produk");
            $('#saveBtn').val("create-user");
            $('#user_id').val('');
            $('#createForm').trigger("reset");
            $('#createModal').modal('show');
        });
        
        $('#save-btn').click(function (e) {
            var data = new FormData();
            data.append('_avatar', $('#_avatar')[0].files[0]);
            data.append('name', $('#name').val());
            data.append('price', $('#price').val());
            data.append('stock', $('#stock').val());
            data.append('deskripsi', $('#deskripsi').val());
            data.append('address', $('#address').val());
            data.append('categories', $('#category').val());
            e.preventDefault();
            // console.log(data);
            
            $(this).html('Sending..');
            
            $.ajax({
                
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                // data: $('#createForm').serialize(),
                // console.log(data);
                data: data,
                processData: false,
                contentType: false,
                url: "{{ route('products.store') }}",
                type: "POST",
                dataType: 'json',
                // cache: false;
                
                success: function (data) {
                    console.log(data);
                    
                    $('#createForm').trigger("reset");
                    
                    $('#createModal').modal('hide');
                    
                    table.draw();
                    
                    
                    
                },
                
                error: function (data) {
                    
                    console.log('Error:', data);
                    
                    $('#save-btn').html('Save Changes');
                    
                }
                
            });
            
        });
        
        
    });
    
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("_avatar").files[0]);
        
        oFReader.onload = function(oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
    
</script>

@endsection