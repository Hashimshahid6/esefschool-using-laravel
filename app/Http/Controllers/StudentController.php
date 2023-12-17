<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\StudentModel;
use App\Models\User;
use Hash;
use Auth;

class StudentController extends Controller
{
    public function list(){
        $data['header_title'] = 'Student List';
        $data['getRecord'] = User::getStudent();
        return view('admin.student.list', $data);
    }
    public function add(){
        return view('admin.student.add');
    }
    public function insert(){
        return view('admin.student.list');
    }
    public function edit(){
        return view('admin.student.edit');
    }
    public function update(){
        return view('admin.student.list');
    }
}
