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
                                <a href="{{ route('stock-in.create') }}" class="btn btn-primary mb-3">
                                    <i class="fas fa-plus"></i> Add New
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                {{-- <th class="text-center">
                                                    <i class="fas fa-cog"></i>
                                                </th> --}}
                                                <th class="text-center">No Order</th>
                                                <th>Vendor</th>
                                                <th>Date BUY</th>
                                                <th>Date IN</th>
                                                <th>List Item</th>
                                                <th>Updated</th>
                                                <th>Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lists as $l)
                                                <tr>
                                                    {{-- <td class="text-center">
                                                        <button type="button" class="btn btn-info"
                                                            onclick="showModalDetail({{ $l->id }})">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </td> --}}
                                                    <td>
                                                        {{ $l->order_number }}
                                                    </td>
                                                    <td>
                                                        {{ $l->vendor->name ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $l->date_buy }}
                                                    </td>
                                                    <td>
                                                        {{ $l->date_in }}
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($l->stockInItems as $d)
                                                                <li>
                                                                    {{ $d->item->name ?? '' }} -
                                                                    {{ $d->qty }} {{ $d->item->unit ?? '' }}
                                                                    @if ($d->item->has_sn == 1)
                                                                        <br />
                                                                        SN: {{ $d->sn }}
                                                                        <br />
                                                                        Mac: {{ $d->mac }}
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                    </td>
                                                    <td>
                                                        {{ $l->updated_at->diffForHumans() }}<br />
                                                        <span class="font-italic font-bold">
                                                            <small>{{ $l->updated_by_name->name ?? '' }}</small>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        {{ $l->created_at->diffForHumans() }}<br />
                                                        <span class="font-italic font-bold">
                                                            <small>{{ $l->created_by_name->name ?? '' }}</small>
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
