@extends('layouts.app-master')
<title>Payer Code</title>
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
            <a href="{{route('payer_code.create')}}" class="btn btn-primary btn-md float-right mb-2">Add</a>
            <table class="table table-bordered payer_code_datatable mt-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Payer Code</th>
                        <th>Client</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        var i = 1;
        var table = $('.payer_code_datatable').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "aaSorting": [],
            ajax: "{{ route('payer_code.index') }}",
            columns: [{
                    "render": function() {
                        return i++;
                    }
                },
                {
                    data: 'payer_code',
                    name: 'payer_code'
                },
                {
                    data: 'client_id',
                    name: 'client_id'
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
    $('.payer_code_datatable').on('click', '.btn-delete[data-remote]', function(e) {
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