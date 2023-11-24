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
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>
                                                    <i class="fas fa-image"></i>
                                                </th>
                                                <th>Category</th>
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Last Update</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lists as $l)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($l->photo != null)
                                                            <img src="{{ asset('storage/' . $l->photo) }}"
                                                                alt="{{ $l->name }}" class="img-fluid"
                                                                width="100px" />
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $l->category_item->name }}
                                                    </td>
                                                    <td>
                                                        {{ $l->name }}
                                                    </td>
                                                    <td>
                                                        {{ $l->qty }} {{ $l->unit }}
                                                    </td>
                                                    <td>
                                                        {{ $l->updated_at->diffForHumans() }}<br />
                                                        <span class="font-italic font-bold">
                                                            <small>{{ $l->updated_by_name->name }}</small>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
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
        let team_id = null;

        $(document).ready(() => {

        })
    </script>
@endsection
