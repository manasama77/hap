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
                <form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Installation Data</h3>
                                    <div class="card-tools">
                                        <a href="{{ route('work-order.instalasi-baru') }}" class="btn btn-dark">
                                            <i class="fas fa-backward"></i> Back to list
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="account_no">Account No</label>
                                                <input type="text" class="form-control" id="account_no" name="account_no"
                                                    value="{{ old('account_no') }}" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="vendor_partner_id">Vendor Partner</label>
                                                <select class="form-control" id="vendor_partner_id" name="vendor_partner_id"
                                                    required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="location_address">Location Address</label>
                                                <input type="text" class="form-control" id="location_address"
                                                    name="location_address" value="{{ old('location_address') }}"
                                                    required />
                                            </div>
                                            <div class="form-group">
                                                <label for="install_status">Install Status</label>
                                                <select class="form-control" id="install_status" name="install_status"
                                                    required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="install_notes">Install Notes</label>
                                                <input type="text" class="form-control" id="install_notes"
                                                    name="install_notes" value="{{ old('install_notes') }}" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="reason_1">Reason 1</label>
                                                <select class="form-control" id="reason_1" name="reason_1" required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="reason_2">Reason 2</label>
                                                <select class="form-control" id="reason_2" name="reason_2" required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="coordinate_install">Coordinate Install</label>
                                                <input type="text" class="form-control" id="coordinate_install"
                                                    name="coordinate_install" value="{{ old('coordinate_install') }}"
                                                    required />
                                            </div>
                                            <div class="form-group">
                                                <label for="odp_code">ODP Code</label>
                                                <select class="form-control" id="odp_code" name="odp_code" required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="actual_distance">Actual Distance (m)</label>
                                                <input type="text" class="form-control" id="actual_distance"
                                                    name="actual_distance" value="{{ old('actual_distance') }}" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="cable_length">Cable Length</label>
                                                <select class="form-control" id="cable_length" name="cable_length" required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="mac_address">MAC Address</label>
                                                <select class="form-control" id="mac_address" name="mac_address" required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-block">
                                                <i class="fas fa-plus"></i> Tambah Material
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Data Installer</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group">
                                                <label for="technician_group_id">Technician Group</label>
                                                <select class="form-control" id="technician_group_id"
                                                    name="technician_group_id" required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group">
                                                <label for="installer_1_id">Installer Name (1)</label>
                                                <select class="form-control" id="installer_1_id" name="installer_1_id"
                                                    required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group">
                                                <label for="installer_2_id">Installer Name (2)</label>
                                                <select class="form-control" id="installer_2_id" name="installer_2_id"
                                                    required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('sanskrit')
    <script>
        $(document).ready(() => {})
    </script>
@endsection
