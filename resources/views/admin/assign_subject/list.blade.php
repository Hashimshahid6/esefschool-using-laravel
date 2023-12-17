@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assign Subject List</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{url('admin/assign_subject/add')}}" class="btn btn-primary">Assign Subject</a>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                  Search Assign Subject
                </div>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>Class Name</label>
                      <input type="text" class="form-control" name="class_name" value="{{Request::get('class_name')}}" placeholder="Class Name">
                    </div>
                    <div>
                      <label>Subject Name</label>
                        <input type="text" class="form-control" name="subject_name" value="{{Request::get('subject_name')}}" placeholder="Subject Name">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Date</label>
                      <input type="date" class="form-control" name="date" value="{{Request::get('date')}}" placeholder="Created Date">
                    </div>
                    <div class="form-group col-md-3">
                      <button type="submit" class="btn btn-primary" style="margin-top: 30px">Search</button>
                      <a href="{{url('admin/assign_subject/list')}}" class="btn btn-success" style="margin-top: 30px">Reset</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            @include('_messages')
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Assign Subject List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Class Name</th>
                      <th>Subject Name </th>
                      <th>Status</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- {{dd($getRecord)}} --}}
                    @foreach($getRecord as $key => $value)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->class_name}}</td>
                        <td>{{$value->subject_name}}</td>
                        <td>
                          @if($value->status == 0)
                            <span class="badge badge-success">Active</span>
                          @else
                            <span class="badge badge-danger">Inactive</span>
                          @endif
                        </td>
                        <td>{{$value->created_by_name}}</td>
                        <td>{{date('d-m-Y', strtotime($value->created_at))}}</td>
                        <td>
                          <a href="{{url('admin/assign_subject/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                          <a href="{{url('admin/assign_subject/edit_single/'.$value->id)}}" class="btn btn-info btn-sm">Edit Single </a>
                          <a href="{{url('admin/assign_subject/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  <tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection