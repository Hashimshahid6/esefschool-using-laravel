@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Admin</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        @include('_messages')
                        <form method="post" action="">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $getRecord->name) }}" required placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="text" class="form-control" name="email" value="{{old('email', $getRecord->email)}}" required placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" required placeholder="Password">
                                    <p>Do you want to change password?</p>
                                </div>
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select class="form-control" name="user_type" required>
                                        <option value="admin" {{ $getRecord->user_type == '1' ? 'selected' : '' }}>Admin</option>
                                        <option value="teacher" {{ $getRecord->user_type == '2' ? 'selected' : '' }}>Teacher</option>
                                        <option value="student" {{ $getRecord->user_type == '3' ? 'selected' : '' }}>Student</option>
                                        <option value="parent" {{  $getRecord->user_type == '4' ? 'selected' : '' }}>Parent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection