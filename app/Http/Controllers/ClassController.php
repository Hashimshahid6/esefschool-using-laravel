<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use Auth;
class ClassController extends Controller
{
    public function list(){
        $data['header_title'] = 'Class List';
        $data['getRecord'] = ClassModel::getRecord();
        return view('admin.class.list', $data);
    }
    public function add(){
        $data['header_title'] = 'Add New Class';
        return view('admin.class.add', $data);
    }
    public function update($id, Request $request){
        $save = ClassModel::find($id);
        $save->name = $request->name;
        $save->status = $request->status;
        $save->updated_by = Auth::user()->id;
        $save->save();
        return redirect('admin/class/list')->with('success', 'Class Successfully Updated');
    }
    public function insert(Request $request){
        $save = new ClassModel();
        $save->name = $request->name;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();
        return redirect('admin/class/list')->with('success', 'Class Added Successfully');
    }
    public function edit($id){
        $data['getRecord'] = ClassModel::where('id', $id)->first();
        $data['header_title'] = 'Edit Class';
        return view('admin.class.edit', $data);
    }
    public function delete($id){
        $data = ClassModel::find($id);
        $data->is_deleted=1;
        $data->save();
        return redirect('admin/class/list')->with('success', 'Class Deleted Successfully');
    }
}
