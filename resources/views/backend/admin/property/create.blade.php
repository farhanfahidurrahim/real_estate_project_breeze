@extends('backend.admin.dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Agent</li> --}}
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property</h6>
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Property Name</label>
                                        <input type="text" name="" class="form-control"
                                            placeholder="Enter first name">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Property Status</label>
                                        <select class="form-select" name="" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Status</option>
                                            <option>12-18</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lowest Price</label>
                                        <input type="text" name="" class="form-control"
                                            placeholder="Enter first name">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Maximum Price</label>
                                        <input type="text" name="" class="form-control"
                                            placeholder="Enter first name">
                                    </div>
                                </div>
                                <!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Main Thumbnail</label>
                                        <input type="file" name="property_thumbnail" class="form-control" onChange="mainThumbUrl(this)">
                                        <img src="" id="mainThumb">
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Multiple Image</label>
                                        <input type="file" name="" class="form-control">
                                    </div>
                                </div>
                                <!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" placeholder="Enter city">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" class="form-control" placeholder="Enter state">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Zip</label>
                                        <input type="text" class="form-control" placeholder="Enter zip code">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input type="email" class="form-control" placeholder="Enter email">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" autocomplete="off"
                                            placeholder="Password">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                        </form>
                        <button type="button" class="btn btn-primary submit">Submit form</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        function mainThumbUrl(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThumb').attr('src',e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
@endsection
