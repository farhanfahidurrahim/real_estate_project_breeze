@extends('backend.admin.dashboard')
@section('admin')

    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('create.agent') }}" class="btn btn-inverse-info">Add Agent</a></a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Agent</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agents as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ !empty($row->photo) ? url('upload/images/agent/'.$row->photo) : url('upload/images/no_image.jpg') }}">
                                        </td>
                                        <td>{{ $row->name }}</td>
                                        <td>
                                            <input data-id="{{ $row->id }}" class="toggleClass" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $row->status ? 'checked' : '' }}>
                                        </td>
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-inverse-info"><i data-feather="eye"></i> </a>
                                            <a href="" class="btn btn-inverse-warning"><i data-feather="edit"></i> </a>
                                            <a href="{{ route('destroy.agent',$row->id) }}" class="btn btn-inverse-danger" id="delete" title="Delete"><i data-feather="trash-2"></i> </a>
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
            $(function(){
                $('.toggleClass').change(function(){
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var status_id = $(this).data('id');

                    $.ajax({
                        type: "GET",
                        url: "/admin/change-agent-status",
                        data:{
                            'status' : status,
                            'id' : status_id,
                        },
                        success: function(data){

                        },
                    })
                })
            })
        </script>
    @endsection

@endsection
