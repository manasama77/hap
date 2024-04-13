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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $page_title }} Lists</h3>
                                <div class="card-tools">
                                    <a href="{{ route('work-order.instalasi-baru.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Add New
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 350px;">
                                                    <i class="fas fa-cogs"></i>
                                                </th>
                                                <th>Req. Install Date</th>
                                                <th>Req. Install Time</th>
                                                <th>Address</th>
                                                <th>Account No.</th>
                                                <th>Name</th>
                                                <th>District Name</th>
                                                <th>Partner Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sanskrit')
    <script>
        $(document).ready(() => {})
    </script>
@endsection
