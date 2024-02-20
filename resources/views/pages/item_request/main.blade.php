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
                                    <a href="{{ route('item-request.create') }}" class="btn btn-success">
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
                                                <th>Code</th>
                                                <th>Date Request</th>
                                                <th>Status</th>
                                                <th>Note</th>
                                                <th>Request By</th>
                                                <th>Approved By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lists as $l)
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-info"
                                                                onclick="editData({{ $l->id }})">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </button>
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="deleteData({{ $l->id }})">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>{{ $l->code }}</td>
                                                    <td>{{ $l->date_request }}</td>
                                                    <td>{{ $l->status }}</td>
                                                    <td>{{ $l->note }}</td>
                                                    <td>{{ $l->createdBy->name }}</td>
                                                    <td>{{ $l->approvalBy->name ?? '-' }}<br /><small>{{ $l->date_approval ?? '-' }}</small>
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

        function deleteData(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('/tipe-item/delete/') }}${id}`,
                        type: "POST",
                        dataType: 'json',
                        data: {
                            id: id,
                        },
                        beforeSend: function() {
                            $.blockUI({
                                message: '<i class="fas fa-spinner fa-pulse"></i>',
                            })
                        }
                    }).done((data) => {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your data has been deleted.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        })
                    }).fail((data) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.responseJSON.message,
                        }).then(() => {
                            location.reload();
                        })
                    })
                }
            })
        }
    </script>
@endsection
