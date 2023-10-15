@extends('backend.admin.dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">

        {{-- <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="d-flex justify-content-center p-3 rounded-bottom">
                        <div>
                            <img class="wd-70 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/images/admin/'.$profileData->photo) : url('upload/images/no_image.jpg') }}" alt="profile">
                            <span class="h4 ms-3">{{ $profileData->username }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="mt-3">
                            <div>
                                <img class="wd-80 rounded-circle"
                                    src="{{ !empty($profileData->photo) ? url('upload/images/admin/' . $profileData->photo) : url('upload/images/no_image.jpg') }}"
                                    alt="profile">
                                <span class="h4 ms-3">{{ $profileData->username }}</span>
                            </div>
                            <br>
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                            <p class="text-muted">{{ $profileData->name }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{ $profileData->email }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                            <p class="text-muted">{{ $profileData->phone }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                            <p class="text-muted">{{ $profileData->address }}</p>
                        </div>

                        <div class="mt-3 d-flex social-links">
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="github"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="twitter"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="col-md-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Update Admin Profile</h6>

                                <form method="POST" action="{{ route('admin.profile.update') }}" class="forms-sample" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Username</label>
                                        <input type="text" name="username" value="{{ $profileData->username }}" class="form-control" id="exampleInputUsername1"
                                            autocomplete="off" placeholder="Username">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ $profileData->name }}" class="form-control" id="exampleInputUsername1"
                                            autocomplete="off" placeholder="Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ $profileData->email }}" class="form-control" id="exampleInputEmail1"
                                            placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Phone</label>
                                        <input type="text" name="phone" value="{{ $profileData->phone }}" class="form-control" id="exampleInputUsername1"
                                            autocomplete="off" placeholder="Phone">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername1" class="form-label">Address</label>
                                        <input type="text" name="address" value="{{ $profileData->address }}" class="form-control" id="exampleInputUsername1"
                                            autocomplete="off" placeholder="Address">
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1"
                                            autocomplete="off" placeholder="Password">
                                    </div> --}}
                                    {{-- Image Part --}}
                                    <div class="mb-3">
                                        <label class="form-label" for="formFile">Image upload</label>
                                        <input class="form-control" type="file" name="photo" id="image" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="formFile"> </label>
                                        <img id="showImage" class="wd-80 rounded-circle"
                                            src="{{ !empty($profileData->photo) ? url('upload/images/admin/' . $profileData->photo) : url('upload/images/no_image.jpg') }}"
                                            alt="profile">
                                    </div>

                                    <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                    <button class="btn btn-secondary">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Section JS -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        })
    </script>

@endsection
