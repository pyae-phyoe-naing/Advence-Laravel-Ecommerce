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
                                <h3 class="card-title">Update Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ url('/admin/update-pwd') }}" name="updatePasswordForm" id='updatePasswordForm'>
                               @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Admin Name</label>
                                        <input type="text"  class="form-control" value="{{ $adminDetail->name }}"
                                        name="admin_name" id='admin_name' placeholder="Enter Admin/Sub Admin Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input  class="form-control" value="{{ $adminDetail->email }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Admin Type</label>
                                        <input  class="form-control" value="{{ $adminDetail->type }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Current Password</label>
                                        <input type="password" class="form-control"
                                         id="current_pwd" name="current_pwd"   placeholder="Enter Current Password">
                                         <small id="chkCurrentPwd"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">New Password</label>
                                        <input type="password" class="form-control"
                                          name="new_pwd" id="new_pwd"  placeholder="Enter New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Confirm Password</label>
                                        <input type="password" class="form-control"
                                          name="confirm_pwd" id='confirm_pwd'  placeholder="Confirm New Password">
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
