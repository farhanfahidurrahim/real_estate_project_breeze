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
                                            placeholder="Enter lowest price">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Maximum Price</label>
                                        <input type="text" name="" class="form-control"
                                            placeholder="Enter maximum price">
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
                                        <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple="">
                                        <div class="row" id="preview_img"></div>
                                    </div>
                                </div>
                                <!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Bedrooms</label>
                                        <input type="text" class="form-control" placeholder="Enter bedrooms">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Bathrooms</label>
                                        <input type="text" class="form-control" placeholder="Enter bathrooms">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Garage</label>
                                        <input type="text" class="form-control" placeholder="Enter garage">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Garage Size</label>
                                        <input type="text" class="form-control" placeholder="Enter garage size">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" placeholder="Enter address">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" placeholder="Enter city">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" class="form-control" placeholder="Enter state">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Zip</label>
                                        <input type="text" class="form-control" placeholder="Enter zip code">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Size</label>
                                        <input type="text" class="form-control" placeholder="Enter property size">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Video</label>
                                        <input type="text" class="form-control" placeholder="Enter property video">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Neighborhood</label>
                                        <input type="text" class="form-control" placeholder="Enter neighborhood">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" class="form-control" placeholder="Enter latitude">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here get Latitude from address</a>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" class="form-control" placeholder="Enter longitude">
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here get Longitude from address</a>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Type</label>
                                        <input type="text" class="form-control" placeholder="Enter property">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Amenities</label>
                                        <input type="text" class="form-control" placeholder="Enter property">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Agent</label>
                                        <input type="text" class="form-control" placeholder="Enter state">
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

    {{-- Single Thumnail Image --}}
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

    {{-- Multiple Image Choose --}}
    <script>
        $(document).ready(function(){
        $('#multiImg').on('change', function(){ //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file){ //loop though each file
                    if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                        .height(80); //create image element
                            $('#preview_img').append(img); //append image to output element
                        };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
        });
    </script>
@endsection
@endsection
