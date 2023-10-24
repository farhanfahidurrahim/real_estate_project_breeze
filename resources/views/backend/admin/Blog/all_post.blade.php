@extends('backend.admin.dashboard')
@section('admin')

    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('blog.post.create') }}" class="btn btn-inverse-info">Add New Blog Post</a></a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        {{-- <h6 class="card-title">All Agent</h6> --}}
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Post Title</th>
                                        <th>Category</th>
                                        <th>Tags</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ !empty($row->post_image) ? url('upload/images/blog-post/'.$row->post_image) : url('upload/images/no_image.jpg') }}">
                                            </td>
                                            <td>{{ $row->post_title }}</td>
                                            <td>{{ $row->cat->category_name}}</td>
                                            <td>{{ $row->post_tag }}</td>
                                            <td>
                                                <input data-id="{{ $row->id }}" class="toggleClass" type="checkbox" data-onstyle="success"
                                                    data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $row->status ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-inverse-info" title="View"><i data-feather="eye"></i></a>
                                                <a href="" class="btn btn-inverse-warning"><i data-feather="edit"></i> </a>
                                                <a href="" class="btn btn-inverse-danger"
                                                    id="delete" title="Delete"><i data-feather="trash-2"></i> </a>
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
                    url: "",
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
