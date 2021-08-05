@extends('layouts.app', ['title' => 'Orders Reseller'.$kode_mitra])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-shopping-cart"></i> ORDERS {{$kode_mitra }}</h6>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        @foreach ($profile_reseller as $profile)
                        <tr>
                            <th colspan="2">DATA RESELLER {{$profile->comunity}}</th>
                           
                        </tr>
                        
                       
                        <tr>
                            <td width="20%">Nama Reseller  </td>
                            <td>: {{$profile->namaketua}}</td>
                           
                        </tr>
                        <tr>
                            
                            <td>Kode Reseller  </td>
                            <td>: {{$profile->kode_mitra}}</td>
                        </tr>
                        <tr> 
                            <td>Nomor HP (WA)  </td>
                            <td>: {{$profile->phone}}</td>
                        </tr>
                        <tr> 
                            <td>Alamat Lengkap  </td>
                            <td>: {{$profile->address}} , {{$profile->city}}</td>
                        </tr>
                        <tr> 
                            <td>Nomor Rekening  </td>
                            <td>: {{$profile->bank}} {{$profile->rekening}} </td>
                        </tr>
                        <tr> 
                            <td>Total Revenue </td>
                            <td>: {{ moneyFormat($grand_total) }}  </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td>Profit Total</td>
                            <td>@foreach ($konf as $val)
                                @if ($grand_total<10000000)
                                    {{ moneyFormat(($val->range1/100) * $grand_total) }}
                                @else
                                    {{ moneyFormat(($val->range2/100) * $grand_total) }}
                                @endif
                               
                            @endforeach</td>
                        </tr>
                        <tr>
                            <td>Profit Bulan ini</td>
                            <td>@foreach ($konf as $val)
                                @if ($grand_total<10000000)
                                    {{ moneyFormat(($val->range1/100) * $totalBulan) }}
                                @else
                                    {{ moneyFormat(($val->range2/100) * $totalBulan) }}
                                @endif
                               
                            @endforeach</td>
                        </tr>
                        <tr>
                            <td>Status Klaim </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>@foreach ($konfig as $item)
                               Revenue di bawah 10 Juta Mendapatkan Peluang Profit <span class="badge badge-success" >{{ $item->range1 }} % </span> dan diatas 10 juta mendapatkan <span class="badge badge-success" >{{ $item->range2 }} %</span> 
                            @endforeach</td>
                        </tr>
                    </table>

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
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                    <th scope="col">NO. INVOICE</th>
                                    <th scope="col">NAMA LENGKAP</th>
                                    <th scope="col">GRAND TOTAL</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @forelse ($invoices as $no => $invoice)
                                <tr>
                                    <th scope="row" style="text-align: center">
                                        {{ ++$no + ($invoices->currentPage()-1) * $invoices->perPage() }}</th>
                                    <td>{{ $invoice->invoice }}</td>
                                    <td>{{ $invoice->name }}</td>
                                   
                                    <td>{{ moneyFormat($invoice->grand_total) }}</td>
                                    <td @if ($invoice->status=='success')
                                    class="text-center text-white bg-success" @else
                                    @if ($invoice->status=='pending')
                                        class="text-center"
                                    @else
                                        class="text-center text-white bg-secondary"
                                    @endif
                                    
                                    @endif  >{{ $invoice->status }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.order.show', $invoice->id) }}"
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
                            {{ $invoices->links("vendor.pagination.bootstrap-4") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection