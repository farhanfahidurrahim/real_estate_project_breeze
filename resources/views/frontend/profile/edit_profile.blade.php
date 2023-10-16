@extends('frontend.dashboard')
@section('main')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <section class="sidebar-page-container blog-details sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">

                @include('frontend.profile.sidebar_profile')

                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="news-block-one">
                            <div class="inner-box">

                                <div class="lower-content">
                                    <h3>Edit Profile</h3>
                                    <form action="{{ route('user.profile.update') }}" method="post" class="default-form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input type="text" name="username" value="{{ $userData->username }}" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name" value="{{ $userData->name }}" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input type="email" name="email" value="{{ $userData->email }}" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" value="{{ $userData->phone }}" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" value="{{ $userData->address }}" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="formFile" class="form-label">Photo</label>
                                            <input class="form-control" type="file" name="photo" id="img" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="formFile" class="form-label"> </label>
                                            <img id="showImg" src="{{ !empty($userData->photo) ? url('upload/images/user/'.$userData->photo) : url('upload/images/no_image.jpg') }}" alt="" style="width:100px; height:100px">
                                        </div>

                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Save Changes </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#img').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImg').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>

@endsection
