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
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('store.permission') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Permission Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Group Name</label>
                                <select name="group_name" class="form-select">
                                    <option selected disabled>Select Group</option>
                                    <option value="type">Property Type</option>
                                    <option value="amenity">Amenity</option>
                                    <option value="property">Property</option>
                                    <option value="agent">Manage Agent</option>
                                    <option value="role">Role & Permission</option>
                                </select>
                                @error('group_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
