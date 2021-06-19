@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Admin Settings</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Admin Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ url('/admin/update-admin-details') }}" name="updateAdminDetailsForm"
                                id='updatePasswordForm'>
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Admin Type</label>
                                        <input class="form-control" value="{{Auth::guard('admin')->user()->type }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_name"> Name</label>
                                        <input type="text" value="{{Auth::guard('admin')->user()->name }}"
                                            class="form-control @error('admin_name') is-invalid @enderror" id="admin_name"
                                            name="admin_name" placeholder="Enter Admin Name">
                                        @error('admin_name')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="admin_mobile">Mobile</label>
                                        <input type="text" class="form-control @error('admin_mobile') is-invalid @enderror" name="admin_mobile" id="admin_mobile"
                                        value="{{Auth::guard('admin')->user()->mobile }}"  placeholder="Enter Phone Number">
                                        @error('admin_mobile')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_image">Image</label>
                                        <input type="file" class="form-control p-1 @error('admin_image') is-invalid @enderror" name="admin_image" id='admin_image'
                                           >
                                        @error('admin_image')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
