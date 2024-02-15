@extends('template')

@section('aku_isi_3_bulan_mas')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $page_title }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm-12 col-md-6 offset-md-3">
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">Form Create User</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="username">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            minlength="3" maxlength="50" value="{{ old('username') }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            minlength="3" maxlength="50" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Password Confirmation<span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" minlength="3" maxlength="50" required />
                                    </div>
                                    <hr />
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            minlength="3" maxlength="50" value="{{ old('name') }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="phone_number" name="phone_number"
                                            placeholder="08xxxxxxxx" minlength="10" maxlength="15"
                                            value="{{ old('phone_number') }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photo <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="photo" name="photo"
                                            accept="image/*" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role <span class="text-danger">*</span></label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value=""></option>
                                            <option @selected(old('role') == 'gudang') value="gudang">Gudang</option>
                                            <option @selected(old('role') == 'teknisi') value="teknisi">Teknisi</option>
                                            <option @selected(old('role') == 'admin') value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <div id="group_team" class="form-group" style="display: none;">
                                        <label for="team_id">Team</label>
                                        <select class="form-control" id="team_id" name="team_id">
                                            <option value=""></option>
                                            @foreach ($teams as $team)
                                                <option @selected(old('team_id') == $team->id) value="{{ $team->id }}">
                                                    {{ $team->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                    <a href="{{ route('user') }}" class="btn btn-dark btn-block">
                                        <i class="fas fa-arrow-left"></i> Back
                                    </a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sanskrit')
    <script>
        $('#role').on('change', () => {
            let value = $('#role').val()

            if (value == 'teknisi') {
                $('#group_team').show()
                $('#team_id').attr('required', true)
            } else {
                $('#group_team').hide()
                $('#team_id').attr('required', false)
            }
        })
    </script>
@endsection
