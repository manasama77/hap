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
                                                <th class="text-center">
                                                    <i class="fas fa-image"></i>
                                                </th>
                                                <th>Category</th>
                                                <th>Item Name</th>
                                                <th>Unit</th>
                                                <th>Has SN?</th>
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
                                                        {{ $l->unit }}
                                                    </td>
                                                    <td>
                                                        {{ $l->has_sn_text }}
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
                        <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Add New Item</h3>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul style="margin-bottom: 0px !important;">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="category_item_id">Category</label>
                                        <select name="category_item_id" id="category_item_id" name="category_item_id"
                                            class="form-control" required>
                                            <option value=""></option>
                                            @foreach ($category_items as $k)
                                                <option @selected(old('category_item_id') == $k->id) value="{{ $k->id }}">
                                                    {{ $k->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Item Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter Item Name" value="{{ old('name') }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <input type="text" name="unit" id="unit" class="form-control"
                                            placeholder="Enter Unit Name" value="{{ old('unit') }}" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" name="photo" id="photo" class="form-control"
                                            accept="image/*" />
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="has_sn" id="has_sn"
                                                @checked(old('has_sn') == 1) />
                                            <label for="has_sn" class="form-check-lable">Has Serial Number?</label>
                                        </div>
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
                        url: `{{ url('/category-item/delete/') }}${id}`,
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
