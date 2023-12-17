<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AdminController extends Controller
{
    public function list(){
        $data['get_Record']= User::getAdmins();
        $data['header_title'] = 'Admin List';
        return view('admin.admin.list', $data);
    }
    public function add(){
        $data['header_title'] = 'Add New Admin';
        return view('admin.admin.add', $data);
    }
    public function insert(Request $request)
    {
        // dd($request->all());
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return redirect('admin/admin/add')->with('error', 'User already exists');
        }
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        switch ($request->user_type) {
            case 'admin':
                $user->user_type = 1;
                $successMessage = 'Admin added successfully';
                break;
            case 'teacher':
                $user->user_type = 2;
                $successMessage = 'Teacher added successfully';
                break;
            case 'student':
                $user->user_type = 3;
                $successMessage = 'Student added successfully';
                break;
            case 'parent':
                $user->user_type = 4;
                $successMessage = 'Parent added successfully';
                break;
        }
        $user->save();
        return redirect('admin/admin/list')->with('success', $successMessage);
    }
    public function edit($id){
        $data['getRecord'] = User::find($id);
        $data['header_title'] = 'Edit Admin';
        return view('admin.admin.edit', $data);
    }
    public function update($id, Request $request){
        $existingUser = User::where('email', $request->email)->where('id', '!=', $id)->first();
        if ($existingUser) {
            return redirect('admin/admin/add')->with('error', 'User already exists');
        }
        $user = User::find($id);
        $user->name = trim(request()->name);
        $user->email = trim(request()->email);
        $user->password = Hash::make(request()->password);
        switch (request()->user_type) {
            case 'admin':
                $user->user_type = 1;
                $successMessage = 'Admin updated successfully';
                break;
            case 'teacher':
                $user->user_type = 2;
                $successMessage = 'Teacher updated successfully';
                break;
            case 'student':
                $user->user_type = 3;
                $successMessage = 'Student updated successfully';
                break;
            case 'parent':
                $user->user_type = 4;
                $successMessage = 'Parent updated successfully';
                break;
        }
        $user->save();
        return redirect('admin/admin/list')->with('success', $successMessage);
    }
    public function delete($id){
        $user = User::find($id);
        $user->is_deleted = 1;
        $user->save();
        return redirect('admin/admin/list')->with('success', 'User deleted successfully');
    }
}
