@extends('layouts.app', ['title' => 'Edit User'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-user-circle"></i> EDIT USER</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.teknisi.update', $teknisi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NAMA LENGKAP</label>
                                    <input type="text" name="name" value="{{ old('name', $teknisi->name) }}"
                                        placeholder="Masukkan Nama User"
                                        class="form-control @error('name') is-invalid @enderror">

                                    @error('name')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ALAMAT EMAIL</label>
                                    <input type="email" name="email" value="{{ old('email', $teknisi->email) }}"
                                        placeholder="Masukkan Alamat Email"
                                        class="form-control @error('email') is-invalid @enderror">

                                    @error('email')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>FOTO</label>
                                    <input type="file" name="photo"
                                        class="form-control @error('photo') is-invalid @enderror">

                                    @error('photo')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NO TELEPON</label>
                                    <input type="number" name="phone" value="{{ old('phone', $teknisi->phone) }}"
                                        placeholder="Masukkan Nomer Telepon"
                                        class="form-control @error('phone') is-invalid @enderror">

                                    @error('phone')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PASSWORD</label>
                                    <input type="password" name="password" value="{{ old('password') }}"
                                        placeholder="Masukkan Password"
                                        class="form-control @error('password') is-invalid @enderror">

                                    @error('password')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>KONFIRMASI PASSWORD</label>
                                    <input type="password" name="password_confirmation"
                                        placeholder="Masukkan Konfirmasi Password" class="form-control">

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
@endsection