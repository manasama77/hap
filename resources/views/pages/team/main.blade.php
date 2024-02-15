@extends('template')

@section('gaya')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('aku_isi_3_bulan_mas')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Team Lists</h1>
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
                                <h3 class="card-title">Team Lists</h3>
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
                                                <th>Team Name</th>
                                                <th>Status</th>
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
                                                            {{-- <button type="button" class="btn btn-dark" title="Assign Users"
                                                                onclick="assignModal({{ $l->id }}, '{{ $l->name }}')">
                                                                <i class="fa-solid fa-arrows-turn-to-dots"></i>
                                                                Assign Users
                                                            </button> --}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $l->name }}
                                                    </td>
                                                    <td>
                                                        {!! $l->is_active_badge !!}
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
                        <form action="{{ route('team.store') }}" method="post">
                            @csrf
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Add New Team</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Team Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter Team Name" required />
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

    {{-- bootstrap 4 modal static --}}
    <form id="form_assign">
        <div class="modal fade" id="modal_assign" data-keyboard="false" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Assign Technician</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="team_name">Team</label>
                            <input type="text" name="team_name" id="team_name" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <label for="technician_id">Technician 1</label>
                            <select id="technician_id" name="technician_id" class="duallistbox" multiple="multiple">
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('sanskrit')
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script>
        let team_id = null;

        $(document).ready(() => {
            $('.duallistbox').bootstrapDualListbox()
            $('.moveall').hide()
            $('.removeall').hide()

            $('#technician_id').on('change', function() {
                if ($('#technician_id').val().length >= 2) {
                    $('select[name=technician_id_helper1]').prop('disabled', true);
                } else {
                    $('select[name=technician_id_helper1]').prop('disabled', false);
                }
            })

            $('#form_assign').on('submit', e => {
                e.preventDefault()

                let data = {
                    team_id: team_id,
                    technician_id: $('#technician_id').val(),
                }

                $.ajax({
                    url: `{{ route('assign_technician') }}`,
                    type: "POST",
                    dataType: 'json',
                    data: data,
                    beforeSend: function() {
                        $.blockUI({
                            message: '<i class="fas fa-spinner fa-pulse"></i>',
                        })
                    }
                }).done((data) => {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your data has been saved.',
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
                    })
                })
            })
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
                        url: `{{ url('/team/delete/') }}${id}`,
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

        function assignModal(id, name) {
            team_id = id
            getListTechnician(id, name)
        }

        function getListTechnician(id, name) {
            $.ajax({
                url: `{{ route('get_technician_unassign') }}`,
                type: "GET",
                dataType: 'json',
                beforeSend: function() {
                    $.blockUI({
                        message: '<i class="fas fa-spinner fa-pulse"></i>',
                    })
                }
            }).done((data) => {
                let htmlnya = ``

                data.forEach((t) => {
                    let selected = (t.team_id == id) ? 'selected="selected"' : ''
                    htmlnya += `<option value="${t.id}" ${selected}>${t.name}</option>`
                })

                $('#team_name').val(name)
                $('#technician_id').empty()
                $('#technician_id').html(htmlnya)
                $('#technician_id').bootstrapDualListbox('refresh', true).trigger('change')
                $('#modal_assign').modal('show')

                $.unblockUI()
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
    </script>
@endsection
