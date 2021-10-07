@extends('layouts.app', ['title' => 'Orders'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-shopping-cart"></i> ORDERS</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.order.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="q"
                                    placeholder="cari berdasarkan no. invoice">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                    <th scope="col">NO. Order</th>
                                    <th scope="col">NAMA LENGKAP</th>
                                    <th scope="col">Down Payment</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $no => $order)
                                <tr>
                                    <th scope="row" style="text-align: center">
                                        {{ ++$no + ($orders->currentPage()-1) * $orders->perPage() }}</th>
                                    <td>{{ $order->down_payment }}</td>
                                    <td>{{ $order->name }}</td>
                                   
                                    <td>{{ moneyFormat($order->down_payment) }}</td>
                                    <td class="text-center">{{ $order->status }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.order.show', $order->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa fa-list-ul"></i>
                                        </a>
                                    </td>
                                </tr>

                                @empty

                                    <div class="alert alert-danger">
                                        Data Belum Tersedia!
                                    </div>

                                @endforelse
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{ $orders->links("vendor.pagination.bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection