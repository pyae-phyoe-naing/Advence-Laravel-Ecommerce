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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Categories</h3>
                                <a href="{{ url('/admin/add-edit-category') }}"
                                    class="btn btn-success btn-primary float-right">Add Category</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="categories" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Section</th>
                                            <th>Parent Category</th>
                                            <th>Category</th>
                                            <th>URL</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            @if (empty($category->parentcategory->category_name))
                                                @php $parent_category = 'Root'  @endphp
                                            @else
                                                @php $parent_category = $category->parentcategory->category_name  @endphp
                                            @endif
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->section->name }}</td>
                                                <td>{{ $parent_category }}</td>
                                                <td>{{ $category->category_name }}</td>
                                                <td>{{ $category->url }}</td>
                                                <td>
                                                    @if ($category->status == 1)
                                                        <a class="updateCategoryStatus" id="category-{{ $category->id }}"
                                                            category_id="{{ $category->id }}"
                                                            href="javascript:void(0)">Active</a>
                                                    @else
                                                        <a class="updateCategoryStatus" id="category-{{ $category->id }}"
                                                            category_id="{{ $category->id }}"
                                                            href="javascript:void(0)">InActive</a>
                                                    @endif
                                                </td>
                                                <td><a href="{{ url('/admin/add-edit-category',$category->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#categories').DataTable();
        });
    </script>
@endpush
