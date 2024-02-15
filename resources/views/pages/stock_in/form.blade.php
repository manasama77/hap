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
                <form enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Detail Information</h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="vendor_id">Vendor</label>
                                        <select class="form-control" id="vendor_id" name="vendor_id" required>
                                            <option value="">-- Choose Vendor --</option>
                                            @foreach ($vendor as $v)
                                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="date_buy">Date BUY</label>
                                        <input type="date" class="form-control" id="date_buy" name="date_buy"
                                            required />
                                    </div>

                                    <div class="form-group">
                                        <label for="date_in">Date IN</label>
                                        <input type="date" class="form-control" id="date_in" name="date_in" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="po_number_vendor">PO Number Vendor</label>
                                        <input type="text" class="form-control" id="po_number_vendor"
                                            name="po_number_vendor" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="attachment">File Attachment</label>
                                        <input type="file" class="form-control" id="attachment" name="attachment" />
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-8">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Add Item</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group" id="group_item">
                                                <div class="d-flex justify-content-between">
                                                    <label for="item_id">Item</label>
                                                    <a href="{{ route('item') }}" class="btn btn-link">
                                                        Item not on the list <i class="far fa-question-circle fa-beat"></i>
                                                    </a>
                                                </div>
                                                <select class="form-control" id="item_id" name="item_id">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="qty">QTY</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="qty"
                                                        name="qty" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="unit_text">-</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="sn">SN</label>
                                                <input type="text" class="form-control" id="sn" name="sn"
                                                    disabled />
                                            </div>
                                            <div class="form-group">
                                                <label for="mac">Mac Address</label>
                                                <input type="text" class="form-control" id="mac" name="mac"
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-warning btn-block" id="btn_add">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <h3 class="card-title">List Item In</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">
                                                                <i class="fas fa-cog"></i>
                                                            </th>
                                                            <th>Item Name</th>
                                                            <th>Qty</th>
                                                            <th>SN</th>
                                                            <th>MAC</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <a href="{{ route('stock-in') }}" class="btn btn-dark btn-block mb-3">
                                <i class="fas fa-backward"></i> Back to List
                            </a>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection

@section('sanskrit')
    <script>
        const temp_id = '{{ $temp_id }}'
        // const temp_id = 'IN40298251'
        let total_item = 0

        $(document).ready(() => {
            updateItem();

            $('#item_id').on('change', () => {
                $('#unit_text').html('-')
                if ($('#item_id').val().length > 0) {

                    if ($('#item_id option:selected').data('has_sn') == 1) {
                        $('#sn').prop('disabled', false)
                        $('#mac').prop('disabled', false)
                        $('#qty').prop('disabled', true)
                    } else {
                        $('#sn').prop('disabled', true)
                        $('#mac').prop('disabled', true)
                        $('#qty').prop('disabled', false)
                        let unit = $('#item_id option:selected').data('unit')
                        $('#unit_text').html(unit)
                    }
                } else {
                    $('#qty').val('')
                    $('#sn').val('')
                    $('#mac').val('')
                }
            })

            $('#btn_add').on('click', e => {
                e.preventDefault()

                let item_id = $('#item_id').val()
                let qty = $('#qty').val()
                let sn = $('#sn').val()
                let mac = $('#mac').val()

                if (item_id.length == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Item cannot be empty',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                        position: 'top-end'
                    }).then(() => {
                        $('#item_id').focus().trigger('click')
                    })
                    return false
                }

                if ($('#item_id option:selected').data('has_sn') == 1) {
                    if (sn.length == 0 || sn == 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'SN cannot be empty or zero',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                            position: 'top-end'
                        }).then(() => {
                            $('#sn').focus().trigger('click')
                        })
                        return false
                    }

                    if (mac.length == 0 || mac == 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'MAC cannot be empty or zero',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                            position: 'top-end'
                        }).then(() => {
                            $('#mac').focus().trigger('click')
                        })
                        return false
                    }
                } else {
                    if (qty.length == 0 || qty == 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'QTY cannot be empty or zero',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                            position: 'top-end'
                        }).then(() => {
                            $('#qty').focus().trigger('click')
                        })
                        return false
                    }
                }

                addTempItem(item_id, qty, sn, mac)
            })

            $('form').on('submit', e => {
                e.preventDefault()
                if (total_item == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Item cannot be empty',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                        position: 'top-end'
                    }).then(() => {
                        $('#item_id').focus().trigger('click')
                    })
                    return false
                }

                processStore()
            })
        })

        function updateItem() {
            $.ajax({
                url: `{{ route('get_list_item') }}`,
                method: 'get',
                dataType: 'json',
                beforeSend: function() {
                    $('#item_id').html('<option value=""></option>')
                    $('#group_item').block({
                        message: '<i class="fas fa-spinner fa-spin"></i>',
                        css: {
                            border: 'none',
                            backgroundColor: 'transparent'
                        },
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.5
                        }
                    })
                }
            }).fail(e => {
                console.log(e)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: e.responseText
                })
            }).done(res => {
                $('#group_item').unblock()
                console.log(res)
                res.data.forEach(item => {
                    console.log(item)
                    $('#item_id').append(
                        `<option value="${item.id}" data-unit="${item.unit}" data-has_sn="${item.has_sn}">${item.name}</option>`
                    )
                })
            }).then(() => {
                getTempItem()
            })
        }

        function addTempItem(item_id, qty, sn, mac) {
            $.ajax({
                url: `{{ route('stock-in.store_temp') }}`,
                method: 'post',
                dataType: 'json',
                data: {
                    temp_id: temp_id,
                    item_id: item_id,
                    qty: qty,
                    sn: sn,
                    mac: mac,
                },
                beforeSend: function() {
                    $('#btn_add').block({
                        message: '<i class="fas fa-spinner fa-spin"></i>',
                        css: {
                            border: 'none',
                            backgroundColor: 'transparent'
                        },
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.5
                        }
                    })
                }
            }).fail(e => {
                console.log(e)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: e.responseText
                })
            }).done(res => {
                $('#btn_add').unblock()
                console.log(res)
                if (res.success == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                        position: 'top-end'
                    }).then(() => {
                        $('#item_id').val('')
                        $('#qty').val('')
                        // updateItem()
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.message
                    })
                }
            }).then(() => {
                $('#item_id').val('').trigger('change')
                getTempItem()
            })
        }

        function getTempItem() {
            // adam
            $.ajax({
                url: `{{ route('stock-in.get_temp_item') }}`,
                method: 'get',
                dataType: 'json',
                data: {
                    temp_id: temp_id
                },
                beforeSend: function() {
                    $('#btn_add').block({
                        message: '<i class="fas fa-spinner fa-spin"></i>',
                        css: {
                            border: 'none',
                            backgroundColor: 'transparent'
                        },
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.5
                        }
                    })
                }
            }).fail(e => {
                console.log(e)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: e.responseText
                })
            }).done(res => {
                $('#btn_add').unblock()
                console.log(res)
                if (res.success == true) {
                    let html = ''
                    total_item = 0
                    res.data.forEach(item => {
                        html += `<tr>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteTempItem(${item.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            <td>${item.item.name}</td>
                            <td>${item.qty} ${item.item.unit}</td>
                            <td>${item.sn ?? ''}</td>
                            <td>${item.mac ?? ''}</td>
                        </tr>`

                        total_item++
                    })
                    $('tbody').html(html)
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.message
                    })
                }
            })
        }

        function deleteTempItem(id) {
            $.ajax({
                url: `{{ route('stock-in.delete_temp_item') }}`,
                method: 'post',
                dataType: 'json',
                data: {
                    id: id
                },
                beforeSend: function() {
                    $('#btn_add').block({
                        message: '<i class="fas fa-spinner fa-spin"></i>',
                        css: {
                            border: 'none',
                            backgroundColor: 'transparent'
                        },
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.5
                        }
                    })
                }
            }).fail(e => {
                console.log(e)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: e.responseText
                })
            }).done(res => {
                $('#btn_add').unblock()
                console.log(res)
                if (res.success == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                        position: 'top-end'
                    }).then(() => {
                        // updateItem()
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.message
                    })
                }
            }).then(() => {
                getTempItem()
            })
        }

        function processStore() {
            let form_data = new FormData()
            form_data.append('temp_id', temp_id)
            form_data.append('vendor_id', $('#vendor_id').val())
            form_data.append('date_buy', $('#date_buy').val())
            form_data.append('date_in', $('#date_in').val())
            form_data.append('po_number_vendor', $('#po_number_vendor').val())
            form_data.append('attachment', $('#attachment')[0].files[0])

            $.ajax({
                url: `{{ route('stock-in.store') }}`,
                method: 'post',
                dataType: 'json',
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').block({
                        message: '<i class="fas fa-spinner fa-spin"></i>',
                        css: {
                            border: 'none',
                            backgroundColor: 'transparent'
                        },
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.5
                        }
                    })
                }
            }).fail(e => {
                console.log(e)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: e.responseText
                }).then(() => {
                    $('button[type="submit"]').unblock()
                })
            }).done(res => {
                $('button[type="submit"]').unblock()
                console.log(res)
                if (res.success == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                        position: 'top-end'
                    }).then(() => {
                        window.location.href = `{{ route('stock-in') }}`
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.message
                    })
                }
            })
        }
    </script>
@endsection
