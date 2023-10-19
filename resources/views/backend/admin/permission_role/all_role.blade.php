@extends('backend.admin.dashboard')
@section('admin')

    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.role') }}" class="btn btn-inverse-info">Add Role</a></a>&nbsp; &nbsp;
                <a href="" class="btn btn-inverse-warning">Import</a></a>&nbsp; &nbsp;
                <a href="" class="btn btn-inverse-danger">Export</a></a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        {{-- <h6 class="card-title">All Property Type</h6> --}}
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>
                                                <a href="" class="btn btn-inverse-warning"><i
                                                        data-feather="edit"></i> </a>
                                                <a href="{{ route('delete.role', $row->id) }}"
                                                    class="btn btn-inverse-danger" id="delete" title="Delete"><i
                                                        data-feather="trash-2"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Status Change -->
    <script>
        $(function() {
            $('.toggleClass').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                // var status = $(this).prop('checked') ? 'active' : 'inactive';
                var status_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "/admin/change-agent-status",
                    data: {
                        'status': status,
                        'id': status_id,
                    },
                    success: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                                type: 'success',
                                title: data.success,
                            })
                        }
                    },
                })

            })
        })
    </script>
@endsection

@endsection
