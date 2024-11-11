@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subcategoryModal">
                                + Add New
                            </button> --}}
                             <a href="{{ route('page.create') }}" class="btn btn-primary"> + Add New </a>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Page List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Page Name</th>
                                            <th>Page title</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($page as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $row->page_name }}</td>
                                                <td>{{ $row->page_title }}</td>
                                                <td>
                                                    <a href="{{ route('page.edit', $row->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>

                                                    {{-- <a href="#" class="btn btn-info btn-sm edit" data-id="{{ $row->id }}" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a> --}}

                                                    <a href="{{ route('page.delete', $row->id) }}" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection
