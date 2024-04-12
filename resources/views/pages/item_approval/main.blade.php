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
                                                                onclick="showDetail({{ $l->id }})">
                                                                <i class="fas fa-eye"></i> Show Detail
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

    <div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Code Request: <span id="v_code"></span></h4>
                    <h4>Date Request: <span id="v_date_request"></span></h4>
                    <h4>Note: <span id="v_note"></span></h4>
                    <hr />
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>QTY Request</th>
                                    <th>QTY Approve</th>
                                    <th>SN & Mac</th>
                                    <th>MAC</th>
                                </tr>
                            </thead>
                            <tbody id="v_list"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id" name="id" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sanskrit')
    <script>
        let team_id = null;

        $(document).ready(() => {})

        function showDetail(id) {
            $.ajax({
                url: `{{ route('get_list_item_request_detail') }}`,
                method: 'get',
                dataType: 'json',
                data: {
                    id: id
                },
                beforeSend: function() {
                    $.blockUI()
                }
            }).fail(e => {
                console.log(e.responseText)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.responseText,
                })
                $.unblockUI()
            }).done(e => {
                console.log(e)

                let id = e.id
                let code = e.code
                let date_request = e.date_request
                let note = e.note

                $('#v_code').text(code)
                $('#v_date_request').text(date_request)
                $('#v_note').text(note)
                $('#id').val(id)



                let htmlnya = ``
                e.lists.forEach(k => {
                    let item_id = k.item_id
                    let item_name = k.item_name
                    let item_request_detail_id = k.item_request_detail_id
                    let item_sn_id = k.item_sn_id
                    let sn = k.sn
                    let mac = k.mac
                    let qty = k.qty
                    let qty_approved = k.qty_approved
                    let readonly = item_sn_id ? 'readonly' : ''

                    htmlnya += `
                    <tr>
                        <td>${item_name}"</td>
                        <td>${qty}</td>
                        <td>${qty_approved}</td>
                        <td>${sn ?? ''}</td>
                        <td>${mac ?? ''}</td>
                    </tr>
                    `
                })

                console.log(htmlnya)
                $('#v_list').html(htmlnya)
                $('#modal_detail').modal('show')
                $.unblockUI()
            })
        }
    </script>
@endsection
