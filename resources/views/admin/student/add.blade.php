@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Add New Student</div>
                        </div>
                        @include('_messages')
                        <form method="post" action="">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>First Name<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="name" required placeholder="First Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Last Name<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="last_name" required placeholder="Last Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Admission Number <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="admission_number" required placeholder="Admission Number">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Roll No <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="roll_number" required
                                        placeholder="Roll Number">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Class <span class="text-danger"> *</span></label>
                                        <select class="form-control" name="class_id" required>
                                            <option value="">Select Class</option> 
                                            @foreach($getClasses as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Gender <span class="text-danger"> *</span></label>
                                        <select class="form-control" name="gender" required>
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Date of Birth <span class="text-danger"> *</span></label>
                                        <input class="form-control" type="date" name="date_of_birth" required placeholder="Date of Birth">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cast</label>
                                        <input class="form-control" type="text" name="cast" placeholder="Caste">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Religion</label>
                                        <input class="form-control" type="text" name="religion" placeholder="Religion">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Phone Number</label>
                                        <input class="form-control" type="text" name="mobile_number" placeholder="Phone Number">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Admission Date</label>
                                        <input class="form-control" type="date" name="admission_date" placeholder="Admission Date" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Profile Pic</label>
                                        <input class="form-control" type="file" name="profile_pic" placeholder="Profile Pic">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Blood Group</label>
                                        <input class="form-control" type="text" name="blood_group" placeholder="Blood Group">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Height</label>
                                        <input class="form-control" type="text" name="height" placeholder="Height">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Weight</label>
                                        <input class="form-control" type="text" name="weight" placeholder="Weight">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Status <span class="text-danger">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option value="">Select Status</option>
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Email Address</label>
                                        <input type="text" class="form-control" name="email" required placeholder="Email">
                                    </div>
                                    <div class="form-group col">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" required placeholder="Password">
                                    </div>
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