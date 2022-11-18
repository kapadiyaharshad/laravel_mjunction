@extends('layouts.app-master')
<title>Users</title>
@section('content')
<!-- @include('sweetalert::alert') -->
@if(Session::get('success'))
<script>
    swal("{{ Session::get('success') }}");
</script>
@endif



<div class="container-fluid">
    <div class="row">


        <div class="col-12 table-responsive">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Import Users
            </button>
            <a class="btn btn-info" href="{{route('users.export')}}">Export Users</a>
            <a href="{{route('users.create')}}" class="btn btn-primary btn-md float-right mb-2">Add</a>
            <table class="table table-bordered user_datatable mt-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Export</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('users.import')}}" method="POST" name="importform" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">File:</label>
                        <input id="file" type="file" name="file" class="form-control" required>
                    </div>
                    <p class="text-danger">Note: Email and username should not be duplicate</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success">Import Users</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal end -->

<script type="text/javascript">
    $(function() {
        var i = 1;
        var table = $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "aaSorting": [],
            ajax: "{{ route('users.index') }}",
            columns: [{
                    "render": function() {
                        return i++;
                    }
                },
                // {
                //     data: 'fname',
                //     name: 'fname'
                // },
                {
                data: function (data, type, row, meta) {
                        if(data.fname != '') {
                            return data.fname;
                        }
                        return '-';
                    name: 'fname'
                    }
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role_id',
                    name: 'role_id'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
    //delete user
    $('.user_datatable').on('click', '.btn-delete[data-remote]', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = $(this).data('remote');

        swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            method: '_DELETE',
                            submit: true
                        }
                    }).always(function(data) {
                        location.reload();
                        // $('.user_datatable').DataTable().ajax.reload();
                    });
                }
            });
    });
</script>

@endsection