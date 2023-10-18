@extends('backend.admin.dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('property.index') }}">Property</a></li>
                <li class="breadcrumb-item" aria-current="page">Property Details</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Property Name</th>
                                        <td><code>{{ $data->property_name }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Property Status</th>
                                        <td><code>{{ $data->property_status }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Lowest Price</th>
                                        <td><code>{{ $data->lowest_price }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Maximum Price</th>
                                        <td><code>{{ $data->maximum_price }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Bedrooms</th>
                                        <td><code>{{ $data->bedrooms }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Garage</th>
                                        <td><code>{{ $data->garage }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Garage Size</th>
                                        <td><code>{{ $data->garage_size }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><code>{{ $data->address }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td><code>{{ $data->city }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td><code>{{ $data->state }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Postal Code</th>
                                        <td><code>{{ $data->postal_code }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Main Image</th>
                                        <td><code></code></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($data->status == '1')
                                                <span>Active</span>
                                            @else
                                            <span>Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Property Code</th>
                                        <td><code>{{ $data->property_code }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Property Size</th>
                                        <td><code>{{ $data->property_size }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Property Video</th>
                                        <td><code>{{ $data->property_video }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Property Type</th>
                                        <td><code>{{ $data->type->type_name }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Property Amenities</th>
                                        <td>
                                            <select name="amenities_id[]" class="js-example-basic-multiple form-select"
                                            multiple="multiple" data-width="100%">
                                                @foreach ($amenities as $row)
                                                    <option value="{{ $row->id }}" {{ (in_array($row->id, $amenitiesArray)) ? 'selected' : '' }}
                                                        >{{ $row->amenity_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Neighborhood</th>
                                        <td><code>{{ $data->neighborhood }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Latitude</th>
                                        <td><code>{{ $data->latitude }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Longitude</th>
                                        <td><code>{{ $data->longitude }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Agent</th>
                                        <td><code>{{ $data->agentName->name }}</code></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
