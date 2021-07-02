@extends('layouts.admin_layout.admin_layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Catalogues</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Add Category</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cat_name">Category Name</label>
                                    <input type="text" class="form-control" id="cat_name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label>Select Category Level</label>
                                    <select name="parent_id" class="form-control select2" style="width: 100%;">
                                        <option value="0">Main Category</option>
                                    </select>
                                </div>

                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Session</label>
                                    <select name="section_id" class="form-control select2" style="width: 100%;">
                                        <option disabled selected="selected">-- select --</option>
                                        @foreach ($getSection as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cat_image">Category Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="category_image" class="custom-file-input" id="cat_image">
                                            <label class="custom-file-label" for="cat_image">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="cat_discount">Category Discount</label>
                                    <input type="text" name="category_discount" class="form-control" id="cat_discount" placeholder="Enter Discount">
                                </div>
                                <div class="form-group">
                                    <label for="cat_description">Category Description</label>
                                    <textarea name="category_description" class="form-control" placeholder="Enter..." rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="3" placeholder="Enter..."></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for='cat_url'>Category Url</label>
                                    <input type="text" name="category_url" class="form-control" id="cat_url" placeholder="Enter Url">
                                </div>
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <textarea name="meta_title" placeholder="Enter..." class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <textarea name="meta_keyword" placeholder="Enter..." class="form-control" rows="3"></textarea>
                                </div>

                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </section>
    </div>
@endsection
