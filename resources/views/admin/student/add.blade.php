@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Student</h1>
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
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>First Name<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="name" required placeholder="First Name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Last Name<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="last_name" required placeholder="Last Name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Admission Number <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="admission_number" required placeholder="Admission Number">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Roll No <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="roll_number" required
                                        placeholder="Roll Number">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Roll No <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="roll_number" required
                                        placeholder="Roll Number">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Class ID <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="class_id" required
                                        placeholder="Class ID">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Gender<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="gender" required
                                        placeholder="Gender">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email Address</label>
                                    <input type="text" class="form-control" name="email" required placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" required placeholder="Password">
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