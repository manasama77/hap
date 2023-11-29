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
                                        <label for="date_out">Date OUT</label>
                                        <input type="date" class="form-control" id="date_out" name="date_out"
                                            required />
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-8">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Add Item OUT</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group" id="group_item">
                                                <div class="d-flex justify-content-between">
                                                    <label for="item_id">Item</label>
                                                </div>
                                                <select class="form-control" id="item_id" name="item_id">
                                                    <option value="">-- Choose Item --</option>
                                                    @foreach ($items as $item)
                                                        <option value="{{ $item->id }}" data-unit="{{ $item->unit }}"
                                                            data-qty="{{ $item->qty }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="qty">QTY</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="qty" name="qty"
                                                        max="0" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="unit_text">-</span>
                                                    </div>
                                                </div>
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
                                            <h3 class="card-title">List Item OUT</h3>
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
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
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
                            <a href="{{ route('stock-out') }}" class="btn btn-dark btn-block mb-3">
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
            $('#item_id').on('change', () => {
                $('#unit_text').html('-')
                $('#qty').attr('max', 0)
                if ($('#item_id').val().length) {
                    let unit = $('#item_id option:selected').data('unit')
                    let qty = $('#item_id option:selected').data('qty')
                    $('#unit_text').html(unit)
                    $('#qty').attr('max', qty)
                }
            })

            $('#btn_add').on('click', e => {
                e.preventDefault()

                let item_id = $('#item_id').val()
                let qty = $('#qty').val()
                let qty_max = $('#qty').attr('max')

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

                if (qty > qty_max) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: `Maximum QTY ${qty_max}`,
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true,
                        position: 'top-end'
                    }).then(() => {
                        $('#qty').focus().trigger('click')
                    })
                    return false
                }

                addTempItem(item_id, qty)
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

        function addTempItem(item_id, qty) {
            $.ajax({
                url: `{{ route('stock-out.store_temp') }}`,
                method: 'post',
                dataType: 'json',
                data: {
                    temp_id: temp_id,
                    item_id: item_id,
                    qty: qty
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
                getTempItem()
            })
        }

        function getTempItem() {
            // adam
            $.ajax({
                url: `{{ route('stock-out.get_temp_item') }}`,
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
                url: `{{ route('stock-out.delete_temp_item') }}`,
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
            $.ajax({
                url: `{{ route('stock-out.store') }}`,
                method: 'post',
                dataType: 'json',
                data: {
                    temp_id: temp_id,
                    vendor_id: $('#vendor_id').val(),
                    date_out: $('#date_out').val()
                },
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
                        window.location.href = `{{ route('stock-out') }}`
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
