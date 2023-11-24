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
                    <div class="col-sm-12 col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $page_title }} Lists</h3>
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
                                                <th class="text-center">
                                                    <i class="fas fa-cogs"></i>
                                                </th>
                                                <th>Vendor Name</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                                <th>PIC</th>
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
                                                    <td>
                                                        {{ $l->name }}
                                                    </td>
                                                    <td>
                                                        {{ $l->phone_number }}
                                                    </td>
                                                    <td>
                                                        {{ $l->address }}
                                                    </td>
                                                    <td>
                                                        {{ $l->pic }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <form action="{{ route('vendor.store') }}" method="post">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Add New Vendor</h3>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="m-0">
                                                @foreach ($errors->all() as $e)
                                                    <li>{{ $e }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="name">Vendor Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter Vendor Name" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="tel" name="phone_number" id="phone_number" class="form-control"
                                            placeholder="08xxxxxxxxxx" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" class="form-control" placeholder="Enter Vendor Address"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="pic">PIC</label>
                                        <input type="text" name="pic" id="pic" class="form-control"
                                            placeholder="Enter PIC Name" required />
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-plus"></i>
                                        Add
                                    </button>
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
                        url: `{{ url('/vendor/delete/') }}${id}`,
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
