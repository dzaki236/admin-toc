@extends('layouts.app', ['title' => 'Detail Order'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid mb-5">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-shopping-cart"></i> DETAIL ORDER</h6>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 25%">
                                NO. INVOICE
                            </td>
                            <td style="width: 1%">:</td>
                            <td>
                                {{ $invoice->invoice }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                NAMA LENGKAP
                            </td>
                            <td>:</td>
                            <td>
                                {{ $invoice->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                NO. TELP / WA
                            </td>
                            <td>:</td>
                            <td>
                                {{ $invoice->phone }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                KURIR / SERVICE / COST
                            </td>
                            <td>:</td>
                            <td>
                                {{ $invoice->courier }} / {{ $invoice->service }} / {{ moneyFormat($invoice->cost_courier) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ALAMAT LENGKAP
                            </td>
                            <td>:</td>
                            <td>
                                {{ $invoice->address }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                TOTAL PEMBELIAN
                            </td>
                            <td>:</td>
                            <td>
                                {{ moneyFormat($invoice->grand_total) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                TANGGAL PEMBELIAN
                            </td>
                            <td>:</td>
                            <td>
                                {{ $invoice->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                STATUS
                            </td>
                            <td>:</td>
                            <td>
                                {{ $invoice->status }}
                           
                                <form action="{{ route('admin.order.update', $invoice->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="{{$invoice->id}}" name="id">
                                <select class="form-control col-md-3" name="status" id="status">
                                    <option value="pending">Pending</option>
                                    <option value="failed">Failed</option>
                                    <option value="success">Success</option>
                                </select>
                                <div class="float-right">
                                <button type="submit" 
                                    class="btn btn-sm btn-primary">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                             </form>

                                <button onClick="Delete(this.id)" class="btn btn-sm btn-danger"
                                    id="{{ $invoice->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card border-0 rounded shadow mt-4">
                <div class="card-body">
                    <h5><i class="fa fa-shopping-cart"></i> DETAIL ORDER</h5>
                    <hr>
                    <table class="table"
                        style="border-style: solid !important;border-color: rgb(198, 206, 214) !important;">
                        <tbody>

                            @foreach ($invoice->orders()->get() as $product)
                                <tr style="background: #edf2f7;">
                                    <td class="b-none" width="25%">
                                        <div class="wrapper-image-cart">
                                            <img src="{{ $product->image }}" style="width: 100%;border-radius: .5rem">
                                        </div>
                                    </td>
                                    <td class="b-none" width="50%">
                                        <h5><b>{{ $product->product_name }}</b></h5>
                                        <table class="table-borderless" style="font-size: 14px">
                                            <tr>
                                                <td style="padding: .20rem">QTY</td>
                                                <td style="padding: .20rem">:</td>
                                                <td style="padding: .20rem"><b>{{ $product->qty }}</b></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="b-none text-right">
                                        <p class="m-0 font-weight-bold">{{ moneyFormat($product->price) }}</p>
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
<!-- /.container-fluid -->

<script>
    //ajax delete
    function Delete(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");

        swal({
            title: "APAKAH KAMU YAKIN ?",
            text: "INGIN MENGHAPUS DATA INI!",
            icon: "warning",
            buttons: [
                'TIDAK',
                'YA'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {

                //ajax delete
                jQuery.ajax({
                    url: "{{ route("admin.order.index") }}/" + id,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function (response) {
                        if (response.status == "success") {
                            swal({
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIHAPUS!',
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton: false,
                                showCancelButton: false,
                                buttons: false,
                            }).then(function () {
                                location.replace("{{ route("admin.order.index") }}");
                            });
                        } else {
                            swal({
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                icon: 'error',
                                timer: 1000,
                                showConfirmButton: false,
                                showCancelButton: false,
                                buttons: false,
                            }).then(function () {
                                location.replace("{{ route("admin.order.index") }}");
                            });
                        }
                    }
                });

            } else {
                return true;
            }
        })
    }
</script>
@endsection