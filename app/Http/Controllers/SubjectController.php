<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectModel;
use Auth;

class SubjectController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Subject List';
        $data['getRecord'] = SubjectModel::getRecord();
        return view('admin.subject.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New Subject';
        return view('admin.subject.add', $data);
    }
    public function insert(Request $request)
    {
        $save = new SubjectModel();
        $save->name = $request->name;
        $save->subject_type = $request->subject_type;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();
        return redirect('admin/subject/list')->with('success', 'Subject Added Successfully');
    }
    public function edit($id)
    {
        $data['getRecord'] = SubjectModel::where('id', $id)->first();
        $data['header_title'] = 'Edit Subject';
        return view('admin.subject.edit', $data);
    }
    public function update($id, Request $request)
    {
        $save = SubjectModel::find($id);
        $save->name = $request->name;
        $save->subject_type = $request->subject_type;
        $save->status = $request->status;
        $save->save();
        return redirect('admin/subject/list')->with('success', 'Subject Successfully Updated');
    }
    public function delete($id)
    {
        $data = SubjectModel::find($id);
        $data->is_deleted = 1;
        $data->save();
        return redirect('admin/subject/list')->with('success', 'Subject Deleted Successfully');
    }
}
