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
                                <a href="{{ route('stock-out.create') }}" class="btn btn-primary mb-3">
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
                                                <th>Title</th>
                                                <th>Type</th>
                                                <th>Date OUT</th>
                                                <th>List Item</th>
                                                {{-- <th class="text-center">
                                                    <i class="fas fa-image"></i>
                                                </th> --}}
                                                <th>Updated</th>
                                                <th>Created</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lists as $l)
                                                <tr>
                                                    {{-- <td class="text-center">
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="askDelete({{ $l->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td> --}}
                                                    <td>
                                                        {{ $l->order_number }}
                                                    </td>
                                                    <td>
                                                        {{ $l->title }}
                                                    </td>
                                                    <td>
                                                        {{ $l->type }}
                                                    </td>
                                                    <td>
                                                        {{ $l->date_out }}
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($l->stockOutItems as $d)
                                                                <li>
                                                                    {{ $d->item->name ?? '' }} -
                                                                    {{ $d->qty }} {{ $d->item->unit ?? '' }}
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
        $(document).ready(() => {

        })

        function askDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteData(id)
                }
            })
        }

        function deleteData(id) {
            $.ajax({
                url: `{{ url('stock-out/destroy') }}/${id}`,
                method: 'POST',
                beforeSend: () => {
                    Swal.fire({
                        title: 'Please wait',
                        html: 'Deleting data',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading()
                        },
                    })
                },
            }).fail(e => {
                Swal.fire({
                    title: 'Failed',
                    html: 'Failed to delete data',
                    icon: 'error'
                })
            }).done(res => {
                Swal.fire({
                    title: 'Success',
                    html: 'Data has been deleted',
                    icon: 'success'
                }).then(res => {
                    window.location.reload()
                })
            })
        }
    </script>
@endsection
