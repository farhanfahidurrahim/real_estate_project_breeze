@extends('backend.admin.dashboard')
@section('admin')
    <div class="page-content">

        {{-- <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Agent</li>
            </ol>
        </nav> --}}

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Blog Post</h6>
                        <form method="POST" action="{{ route('blog.post.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Post Title</label>
                                        <input type="text" name="post_title" value="{{ old('post_title') }}" class="form-control @error('post_title') is-invalid @enderror"
                                            placeholder="Enter first name">
                                        @error('post_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->
                            <div class="row">
                                 <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select name="blog_cat_id" class="form-select @error('blog_cat_id') is-invalid @enderror" id="exampleFormControlSelect1">
                                            <option selected disabled="">Select Category</option>
                                            @foreach ($categories as $row)
                                                <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('blog_cat_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea name="short_desc" class="form-control @error('short_desc') is-invalid @enderror" id="" rows="3"></textarea>
                                        @error('short_desc')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Long Description</label>
                                        <textarea name="long_desc" class="form-control @error('long_desc') is-invalid @enderror" id="tinymceExample" rows="6"></textarea>
                                        @error('long_desc')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Post Image</label>
                                        <input type="file" name="post_image" onChange="postImageURL(this)" class="form-control @error('post_image') is-invalid @enderror">
                                        <img src="" id="showPostImage">
                                        @error('post_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Post Tags</label>
                                        <input name="post_tag" id="tags" value="real estate," />
                                    </div>
                                </div><!-- Col -->
                            </div>
                            <button type="submit" class="btn btn-primary submit">Save...</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')

    {{-- Single Thumnail Image --}}
    <script>
        function postImageURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader;
                reader.onload = function(e){
                    $('#showPostImage').attr('src',e.target.result).width(80).height(80)
                }
                reader.readAsDataURL(input.files[0])
            }
        }
    </script>

@endsection
@endsection
