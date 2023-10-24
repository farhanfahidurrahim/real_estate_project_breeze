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

                        <form method="POST" action="{{ route('setting.smtp.update') }}" class="forms-sample">
                            @csrf
                            <input type="hidden" name="id" value="{{ $smtp->id }}">
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">MAIL_MAILER</label>
                                <input type="text" name="mailer" value="{{ $smtp->mailer }}" class="form-control @error('mailer') is-invalid @enderror" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="mailer">
                                @error('mailer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">MAIL_HOST</label>
                                <input type="text" name="host" value="{{ $smtp->host }}" class="form-control @error('host') is-invalid @enderror" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="host">
                                @error('host')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">MAIL_PORT</label>
                                <input type="text" name="port" value="{{ $smtp->port }}" class="form-control @error('port') is-invalid @enderror" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="port">
                                @error('port')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">MAIL_USERNAME</label>
                                <input type="text" name="username" value="{{ $smtp->username }}" class="form-control @error('username') is-invalid @enderror" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="username">
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">MAIL_PASSWORD</label>
                                <input type="text" name="password" value="{{ $smtp->password }}" class="form-control @error('password') is-invalid @enderror" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">MAIL_ENCRYPTION</label>
                                <input type="text" name="encryption" value="{{ $smtp->encryption }}" class="form-control @error('encryption') is-invalid @enderror" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="encryption">
                                @error('type_icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">MAIL_FROM_ADDRESS</label>
                                <input type="text" name="from_address" value="{{ $smtp->from_address }}" class="form-control @error('from_address') is-invalid @enderror" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="from_address">
                                @error('from_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Save Change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
