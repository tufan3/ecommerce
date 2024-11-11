@extends('layouts.admin')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Page Create</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Update Page</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form action="{{ route('page.update',$page->id) }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="page_name">Page Position</label>
                            <select class="form-control" name="page_position">
                                <option value="1" @if ($page->page_position == 1) selected @endif>Page one</option>
                                <option value="2" @if ($page->page_position == 2) selected @endif>Page two</option>
                            </select>
                          </div>

                      <div class="form-group">
                        <label for="page_name">Page Name</label>
                        <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Page Name" value="{{ $page->page_name }}">
                      </div>
                      <div class="form-group">
                        <label for="page_title">Page Title</label>
                        <input type="test" class="form-control" id="page_title" name="page_title" placeholder="Page title" value="{{ $page->page_title }}">

                      </div>

                      <div class="form-group">
                        <label for="page_description" class="form-label">Page Description</label>
                        <textarea name="page_description"  class="form-control summernote" rows="4">{{ $page->page_description }}</textarea>
                    </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Update Page</button>
                    </div>
                  </form>
                </div>
                <!-- /.card -->
              </div>

        </div>

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
