<?php

namespace App\Http\Controllers;
use App\Models\User;
use Hash;
use Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function list(){
        $data['header_title'] = 'Student List';
        // $data['getRecord'] = User::getStudent();
        return view('admin.student.list', $data);
    }
    public function add(){
        $data['header_title'] = 'Add New Student';
        return view('admin.student.add', $data);
    }
    public function insert(){
        return view('admin.student.list');
    }
    public function edit($id){
        $data['getRecord'] = User::find($id);
        $data['header_title'] = 'Edit Student';
        return view('admin.student.edit', $data);
    }
    public function update($id, Request $request){
        $existingUser = User::where('email', $request->email)->where('id', '!=', $id)->first();
        if($existingUser){
            return redirect('admin/student/list')->with('error', 'User Already Exist');
        }
        $user= User::find($id);
        $user->name = request()->name;
        $user->email = request()->email;
        $user->password = Hash::make(request()->password);
        return redirect('admin/student/list')->with('success', 'User Successfully Updated');
    }
    public function delete($id){
        $user=User::find($id);
        $user->is_deleted = 1;
        $user->save();
        return redirect('admin/student/list')->with('success', 'Student deleted successfully');

    }
}
