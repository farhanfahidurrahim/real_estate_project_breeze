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
                                        <input type="file" name="property_thumbnail" class="form-control"
                                            onChange="mainThumbUrl(this)">
                                        <img src="" id="mainThumb">
                                    </div>
                                </div>
                                <!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Multiple Image</label>
                                        <input type="file" name="multi_img[]" class="form-control" id="multiImg"
                                            multiple="">
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
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go here get Latitude from address</a>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" class="form-control" placeholder="Enter longitude">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go here get Longitude from address</a>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Type</label>
                                        <select class="form-select" name="ptype_id" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Type</option>
                                            @foreach ($propertyType as $row)
                                                <option value="{{ $row->id }}">{{ $row->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Property Amenities</label>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select"
                                            multiple="multiple" data-width="100%">
                                            @foreach ($amenities as $row)
                                                <option value="{{ $row->id }}">{{ $row->amenity_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Agent</label>
                                        <select class="form-select" name="agent_id" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Agent</option>
                                            @foreach ($activeAgent as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea class="form-control" name="" id="" rows="3"></textarea>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Long Description</label>
                                        <textarea class="form-control" name="tinymce" id="tinymceExample" rows="6"></textarea>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Choose</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="skill_check" class="form-check-input"
                                                    id="checkInline1">
                                                <label class="form-check-label" for="checkInline1">Feature
                                                    Property</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="skill_check" class="form-check-input"
                                                    id="checkInline2">
                                                <label class="form-check-label" for="checkInline2">Hot Property</label>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <!--========== Facilities ==============-->
                            <div class="row">
                                <div class="row add_item">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="facility_name" class="form-label">Facilities </label>
                                            <select name="facility_name[]" id="facility_name" class="form-control">
                                                <option value="">Select Facility</option>
                                                <option value="Hospital">Hospital</option>
                                                <option value="SuperMarket">Super Market</option>
                                                <option value="School">School</option>
                                                <option value="Entertainment">Entertainment</option>
                                                <option value="Pharmacy">Pharmacy</option>
                                                <option value="Airport">Airport</option>
                                                <option value="Railways">Railways</option>
                                                <option value="Bus Stop">Bus Stop</option>
                                                <option value="Beach">Beach</option>
                                                <option value="Mall">Mall</option>
                                                <option value="Bank">Bank</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="distance" class="form-label"> Distance </label>
                                            <input type="text" name="distance[]" id="distance" class="form-control"
                                                placeholder="Distance (Km)">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" style="padding-top: 30px;">
                                        <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add
                                            More..</a>
                                    </div>
                                </div>
                            </div>
                            <!--========== Facilities Ajax ==============-->
                            <div style="visibility: hidden">
                                <div class="whole_extra_item_add" id="whole_extra_item_add">
                                   <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                      <div class="container mt-2">
                                         <div class="row">

                                            <div class="form-group col-md-4">
                                               <label for="facility_name">Facilities</label>
                                               <select name="facility_name[]" id="facility_name" class="form-control">
                                                     <option value="">Select Facility</option>
                                                     <option value="Hospital">Hospital</option>
                                                     <option value="SuperMarket">Super Market</option>
                                                     <option value="School">School</option>
                                                     <option value="Entertainment">Entertainment</option>
                                                     <option value="Pharmacy">Pharmacy</option>
                                                     <option value="Airport">Airport</option>
                                                     <option value="Railways">Railways</option>
                                                     <option value="Bus Stop">Bus Stop</option>
                                                     <option value="Beach">Beach</option>
                                                     <option value="Mall">Mall</option>
                                                     <option value="Bank">Bank</option>
                                               </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                               <label for="distance">Distance</label>
                                               <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                                            </div>
                                            <div class="form-group col-md-4" style="padding-top: 20px">
                                               <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                                               <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')

    {{-- Single Thumnail Image --}}
    <script>
        function mainThumbUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThumb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <!------- Multiple Image Choose ------->
    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

    <!------- Facilities Ajax ------->
    <script>
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
@endsection
@endsection
