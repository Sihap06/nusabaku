@extends('admin.master')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Pengguna</h1>

    {{-- button tambah produk --}}
    {{-- <a class="btn btn-primary mb-3" href="javascript:void(0)" id="create"> Tambah Pengguna</a> --}}
    {{-- <a href="{{route('dashboard.create')}}" class="btn btn-primary my-2">Tambah User</a> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Status</th>
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
                        <label for="status" class="col-form-label">Nama:</label>
                        <input type="text" name="_name" id="_name" class="form-control @error('name') is-invalid @enderror">

                        @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Email:</label>
                        <input type="email" name="_email" id="_email" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Password:</label>
                        <input type="password" name="_password" id="_password" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Konfirmasi password:</label>
                        <input type="password" id="_confirmpassword" name="_confirmpassword" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Alamat:</label>
                        <input type="text" name="_address" id="_address" class="form-control @error('address') is-invalid @enderror">
                        @error('address') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">No Telepon:</label>
                        <input type="text" name="_phone" id="_phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Avatar:</label><br>
                        <input type="file" name="_avatar" id="_avatar">

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
{{-- modal hapus --}}
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Akun Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.destroy', 'id')}}" method="POST">
                    {{method_field('DELETE')}}
                    @csrf
                    Apakah anda yakin akan menghapus akun ini ?
                    <input type="hidden" name="hapus_id" id="hapus_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
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
            ajax:"{{route('ajax.get.user')}}",
            columns: [
            {data: 'rownum', name: 'rownum'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'telepon'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
            ]

        });

        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });

        var validator = $('#createForm').validate({
            rules: {
                _name: {
                    required:true,
                    minlength:5,
                },
                _email: {
                    required:true,
                    email:true,
                },
                _password: {
                    required:true,
                    minlength:6,
                },
                _confirmpassword: {
                    minlength:6,
                    required:true,
                    equalTo: "#_password"
                },
                _address: {
                    required:true,
                    minlength:10,
                },
                _phone: {
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
        // validator.showErrors({
            //     "name":"required"
            // });

            // create

            $('#create').click(function () {
                $('#modal-title').html("Tambah akun admin");
                $('#saveBtn').val("create-user");
                $('#user_id').val('');
                $('#createForm').trigger("reset");
                $('#createModal').modal('show');




            });

            $('#save-btn').click(function (e) {
                var data = new FormData();
                data.append('_avatar', $('#_avatar')[0].files[0]);
                data.append('_name', $('#_name').val());
                data.append('_email', $('#_email').val());
                data.append('_password', $('#_password').val());
                data.append('_address', $('#_address').val());
                data.append('_phone', $('#_phone').val());
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
                    url: "{{ route('dashboard.store') }}",
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

            $('#hapusModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var hapus_id = button.data('hapusid')
                var modal = $(this)
                modal.find('.modal-body #hapus_id').val(hapus_id)
            });

        });




    </script>

    @endsection
