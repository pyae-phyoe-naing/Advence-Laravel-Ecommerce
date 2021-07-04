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
                <form  method="POST" enctype="multipart/form-data" name="categoryForm" id="CategoryForm"
                    @if(!empty($categorydata->id)) action="{{ url('/admin/add-edit-category',$categorydata->id) }}" @else action="{{ url('/admin/add-edit-category') }}" @endif>
                    @csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>

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
                                        <label for="category_name">Category Name</label>
                                        <input type="text" name="category_name" class="form-control
                                        @error('category_name') is-invalid  @enderror" id="category_name" placeholder="Enter name"
                                         @if(!empty($categorydata->category_name)) value="{{ $categorydata->category_name }}" @else value="{{ old('category_name') }}" @endif>
                                        @error('category_name')
                                            <small class="text text-danger"><strong>{{ $message }}</strong></small>
                                        @enderror
                                    </div>
                                    <div id="appendCategoriesLevel">
                                        @include('admin.categories.append_categories_level')
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Session</label>
                                        <select name="section_id" id="section_id"
                                            class="form-control select2 @error('section_id') is-invalid  @enderror"
                                            style="width: 100%;">
                                            @if(empty($categorydata->id))<option disabled selected="selected">-- select --</option>@endif
                                            @foreach ($getSection as $section)
                                                <option {{ !empty($categorydata->section_id) && $section->id == $categorydata->section_id ? 'selected' : '' }}
                                                value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('section_id')
                                            <small class="text text-danger"><strong>{{ $message }}</strong></small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cat_image">Category Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="category_image"
                                                    class="custom-file-input @error('category_image') is-invalid  @enderror"
                                                    id="category_image">
                                                <label class="custom-file-label" for="category_image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        @error('category_image')
                                            <small class="text text-danger"><strong>{{ $message }}</strong></small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 ">
                                    <div class="form-group">
                                        <label for="cat_discount">Category Discount</label>
                                        <input type="text" name="category_discount" class="form-control" id="category_discount" placeholder="Enter Discount"
                                        @if(!empty($categorydata->category_discount)) value="{{ $categorydata->category_discount }}" @else value="{{ old('category_discount') }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Category Description</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Enter..." rows="3">
                                              @if(!empty($categorydata->description)) {{ $categorydata->description }} @else {{ old('description') }} @endif
                                        </textarea>

                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for='url'>Category Url</label>
                                        <input type="text" name="url" class="form-control @error('url') is-invalid  @enderror" id="url" placeholder="Enter Url"
                                        @if(!empty($categorydata->url)) value="{{ $categorydata->url }}" @else value="{{ old('url') }}" @endif>
                                        @error('url')
                                            <small class="text text-danger"><strong>{{ $message }}</strong></small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <textarea name="meta_title" id="meta_title" placeholder="Enter..." class="form-control" rows="3">
                                            @if(!empty($categorydata->meta_title)) {{ $categorydata->meta_title }} @else {{ old('meta_title') }} @endif
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control"  rows="3" placeholder="Enter...">
                                            @if(!empty($categorydata->meta_description)) {{ $categorydata->meta_description }} @else {{ old('meta_description') }} @endif
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_keyword">Meta Keywords</label>
                                        <textarea name="meta_keywords" id="meta_keywords" placeholder="Enter..." class="form-control" rows="3">
                                            @if(!empty($categorydata->meta_keywords)) {{ $categorydata->meta_keywords }} @else {{ old('meta_keywords') }} @endif
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
        </section>
    </div>
@endsection
