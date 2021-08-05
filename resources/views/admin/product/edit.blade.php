@extends('layouts.app', ['title' => 'Edit Produk'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-shopping-bag"></i> EDIT PRODUK</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>GAMBAR</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">

                            @error('image')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NAMA PRODUK</label>
                            <input type="text" name="title" value="{{ old('title', $product->title) }}" placeholder="Masukkan Nama Produk"
                                class="form-control @error('title') is-invalid @enderror">

                            @error('title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>DESCRIPTION</label>
                            <input type="text" name="subtitle" value="{{ old('subtitle',$product->subtitle) }}" placeholder="Masukkan Deskripsi singkat"
                                class="form-control @error('subtitle') is-invalid @enderror">

                            @error('subtitle')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>KATEGORI</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">-- PILIH KATEGORI --</option>
                                        @foreach ($categories as $category)
                                            @if($product->category_id == $category->id)
                                                <option value="{{ $category->id  }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id  }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BERAT (gram)</label>
                                    <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror"
                                        value="{{ old('weight',$product->weight) }}" placeholder="Berat Produk (gram)">

                                    @error('weight')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <label>DESKRIPSI LENGKAP</label>
                            
                            
                            <textarea class="form-control content @error('content') is-invalid @enderror" name="content" rows="15"
                           placeholder="Content Product"    >{!! $product->content !!}</textarea>

                            @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                       
                        <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                                <label>HARGA </label>
                                <input type="number" name="price" id="pricebase" class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price',$product->price ) }}" placeholder="Harga Produk">

                                @error('price')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>DISKON (%)</label>
                                    <input type="number" id="discount" name="discount" class="form-control @error('discount') is-invalid @enderror"
                                        value="{{ old('discount',$product->discount) }}" value="0" placeholder="0 (%)">

                                    @error('discount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>MAX Ambil (Pcs)</label>
                                    <input type="number" name="promo_max" class="form-control @error('promo_max') is-invalid @enderror"
                                        value="{{ old('promo_max',$product->promo_max) }}" placeholder="Maksimum Beli ">

                                    @error('promo_max')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                          
                        </div>
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            UPDATE</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script src="//cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
<script>
 $("#profit").keyup(function() {
        var profit=$("#profit").val();
        var hargaDasar=$("#pricebase").val();
        var persen=(profit/100)*hargaDasar;
        var hargaJual=parseInt(hargaDasar) + parseInt(persen);
        console.log(persen);
        $("#sellprice").val(hargaJual);
       
    });

    $("#discount").keyup(function() {
       
        var hargaJual=parseInt($("#sellprice").val());
        var diskon=(parseInt($("#discount").val())/100) * hargaJual;
        var hargaJualAfterDisc = parseInt(hargaJual) - diskon;
        console.log(diskon);
        $("#sellpriceafter").val(hargaJualAfterDisc);
        console.log(hargaJualAfterDisc);
    });

    var editor_config = {
        selector: "textarea.content",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
    };

    tinymce.init(editor_config);
    tinymce.get('content').getBody().innerHTML = '<p>This is my new content!</p>';
</script>
@endsection