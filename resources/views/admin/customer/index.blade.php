@extends('layouts.app', ['title' => 'Customer'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-users"></i>  Customer</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.customer.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="q"
                                    placeholder="cari berdasarkan nama customer">
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
                                    <th scope="col">NAMA USER</th>
                                    <th scope="col">FOTO</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">TELPON</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customer as $no => $user)
                                <tr>
                                    <th scope="row" style="text-align: center">
                                        {{ ++$no + ($customer->currentPage()-1) * $customer->perPage() }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td> <img src="{{asset('upload/customer/'. $user->photo . '.jpg') }}" alt="" style="height: 100px">
                                        </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                </tr>

                                @empty

                                    <div class="alert alert-danger">
                                        Data Belum Tersedia!
                                    </div>
                                
                                @endforelse
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{ $customer->links("vendor.pagination.bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection