@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin List</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{url('admin/admin/add')}}" class="btn btn-primary">Add New Admin</a>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                  Search Users
                </div>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name" value="{{Request::get('name')}}" placeholder="Name">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Email Address</label>
                      <input type="text" class="form-control" name="email" value="{{Request::get('email')}}" placeholder="Email">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Select Date</label>
                      <input type="date" class="form-control" name="date" value="{{Request::get('date')}}" placeholder="Created Date">
                    </div>
                    <div class="form-group col-md-3">
                      <label>User Type</label>
                      <select class="form-control" name="user_type">
                        <option value="">Select User Type</option>
                        <option value="admin" {{ Request::get('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="teacher" {{ Request::get('user_type') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="student" {{ Request::get('user_type') == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="parent" {{ Request::get('user_type') == 'parent' ? 'selected' : '' }}>Parent</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <button type="submit" class="btn btn-primary">Search</button>
                      <a href="{{url('admin/admin/list')}}" class="btn btn-success">Reset</a>
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
                <h3 class="card-title">Admin List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>User Type</th>
                      <th>Created Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{dd($get_Record)}}
                    @foreach($get_Record as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->user_type}}</td>
                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        <td>
                            <a href="{{ url('admin/admin/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ url('admin/admin/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
                            <a href="{{ url('admin/admin/change-password/'.$value->id) }}" class="btn btn-warning">Change Password</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $get_Record->links() }}
                <p class="text-center">Total Records: {{$get_Record->total()}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection