<?php

namespace App\Http\Controllers;
use App\Models\ClassModel;
use App\Models\User;
use Hash;
use Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function list(){
        $data['header_title'] = 'Student List';
        $data['getRecord'] = User::getStudent();
        return view('admin.student.list', $data);
    }
    public function add(){
        $data['header_title'] = 'Add New Student';
        $data['getClasses'] = ClassModel::getClass();
        return view('admin.student.add', $data);
    }
    public function insert(Request $request){
        request()->validate([
            'email' => 'required|unique:users,email',
        ]);
        $student = new User();
        $student->name = request()->name;
        $student->last_name = request()->last_name;
        $student->admission_number = request()->admission_number;
        $student->roll_number = request()->roll_number;
        $student->class_id = request()->class_id;
        $student->gender = request()->gender;
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
        }
        $student->caste = request()->caste;
        $student->religion = request()->religion;
        $student->mobile_number = request()->mobile_number;
        if(!empty($request->admission_date)){
            $student->admission_date = date('Y-m-d', strtotime($request->admission_date));
        }
        if(!empty($request->profile_pic)){
            $extension = $request->file('profile_pic')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $request->file('profile_pic')->move('uploads/student/', $fileName);
            $student->profile_pic = $fileName;
        }
        $student->blood_group = request()->blood_group;
        $student->height = request()->height;
        $student->weight = request()->weight;
        $student->status = request()->status;
        $student->email = request()->email;
        $student->password = Hash::make(request()->password);
        $student->user_tye = 3;
        $student->save();
        return redirect('admin/student/list')->with('success', 'Student Successfully Added');
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
