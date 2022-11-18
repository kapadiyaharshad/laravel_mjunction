@extends('layouts.app-master')
<title>Profit Center Code</title>
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
            <a href="{{route('profit_center.create')}}" class="btn btn-primary btn-md float-right mb-2">Add</a>
            <table class="table table-bordered profit_center_datatable mt-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profit Center</th>
                        <th>Business Unit</th>
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
        var table = $('.profit_center_datatable').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "aaSorting": [],
            ajax: "{{ route('profit_center.index') }}",
            columns: [{
                    "render": function() {
                        return i++;
                    }
                },
                {
                    data: 'profit_center',
                    name: 'profit_center'
                },
                {
                    data:'business_unit_id',
                    name:'business_unit_id'
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
    $('.profit_center_datatable').on('click', '.btn-delete[data-remote]', function(e) {
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