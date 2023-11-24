@extends('template')

@section('aku_isi_3_bulan_mas')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User Lists</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">User Lists</h3>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('user.create') }}" class="btn btn-primary mb-3" role="button">
                                    <i class="fas fa-plus"></i>
                                    Add User
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <i class="fas fa-cogs"></i>
                                                </th>
                                                <th class="text-center">
                                                    <i class="fas fa-image"></i>
                                                </th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Email</th>
                                                <th>Team</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lists as $l)
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('user.edit', $l->id) }}" class="btn btn-info">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="deleteData({{ $l->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <img src="{{ asset('storage/' . $l->photo) }}"
                                                            alt="{{ $l->name }}" class="img-thumbnail"
                                                            style="width: 100px;" />
                                                    </td>
                                                    <td>
                                                        {{ $l->username }}
                                                    </td>
                                                    <td>
                                                        {{ $l->role }}
                                                    </td>
                                                    <td>
                                                        {{ $l->name }}
                                                    </td>
                                                    <td>
                                                        {{ $l->phone_number }}
                                                    </td>
                                                    <td>
                                                        {{ $l->email }}
                                                    </td>
                                                    <td>
                                                        {{ $l->team->name ?? '' }}
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
                        url: `{{ url('/user/delete') }}/${id}`,
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
                            text: data.responseText,
                        }).then(() => {
                            location.reload();
                        })
                    })
                }
            })
        }
    </script>
@endsection
