@extends('backend.admin.dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Agent</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('store.agent') }}" class="forms-sample">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Agent Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Agent Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Agent Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="Phone">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Agent Address</label>
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="Address">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('') is-invalid @enderror" id="exampleInputPassword1" autocomplete="off"
                                    placeholder="Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" autocomplete="off"
                                    placeholder="Retype Password">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Save</button>
                            <a href="{{ route('all.agent') }}" class="btn btn-secondary">All Agent</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
