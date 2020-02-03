@extends('admin.master')

@section('content')

<div class="container-fluid">
    
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Kategori</h1>
    
    {{-- button tambah produk --}}
    <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-primary my-2">Tambah Kategori</a>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
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

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createForm" action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status" class="col-form-label">Nama:</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                        
                        @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createForm" action="{{route('categories.update', 'id=?')}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{method_field('PUT')}}
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" class="form-control">
                    <div class="form-group">
                        <label for="status" class="col-form-label">Nama:</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                        
                        @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
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
            ajax:"{{route('ajax.get.categories')}}",
            columns: [
            {data: 'rownum', name: 'rownum'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action'},
            ]
            
        });
        
        
        var validator = $('#createForm').validate({
            rules: {
                name: {
                    required:true,
                    minlength:5,
                },
                
            }
        });
        
        
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var id = button.data('id')
            var name = button.data('name')

            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #name').val(name)
        });
        
    });
    
    
    
    
</script>

@endsection