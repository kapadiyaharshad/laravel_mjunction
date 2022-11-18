@extends('layouts.app-master')
<title>Clients</title>
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clientModal">
                Import Clients
            </button>
            <a class="btn btn-info" href="{{route('client.export')}}">Export Clients</a>
           
            <a href="{{route('client.create')}}" class="btn btn-primary btn-md float-right mb-2">Add</a>
            <table class="table table-bordered client_datatable mt-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Mobile</th>
                        <th>Account Type</th>
                        <th>Profit Code</th>
                        <th>Category</th>
                        <th>Business Segment</th>
                        <th>Service</th>
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
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Client Export</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('client.import')}}" method="POST" name="importform" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">File:</label>
                        <input id="file" type="file" name="file" class="form-control" required>
                    </div>
                    <p class="text-danger">Note: Client name should not be duplicate</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-success">Import Client</button>
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
        var table = $('.client_datatable').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "aaSorting": [],
            ajax: "{{ route('client.index') }}",
            columns: [{
                    "render": function() {
                        return i++;
                    }
                },
                {
                    data:'client_name',
                    name:'client_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },

                {
                    data: 'contact',
                    name: 'contact'
                },
                {
                    data: 'mobile',
                    name: 'mobile'
                },
                {
                    data: 'account_type_id',
                    name: 'account_type_id'
                },
                {
                    data: 'profit_center_id',
                    name: 'profit_center_id'
                },
                {
                    data: 'category_id',
                    name: 'category_id'
                },
                {
                    data: 'business_segment_id',
                    name: 'business_segment_id'
                },
                {
                    data: 'service_id',
                    name: 'service_id'
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
    $('.client_datatable').on('click', '.btn-delete[data-remote]', function(e) {
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
                    });
                }
            });
    });
</script>

@endsection