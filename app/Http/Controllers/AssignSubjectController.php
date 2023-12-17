<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use Auth;

class AssignSubjectController extends Controller
{
    //
    public function list(Request $request){
        $data['header_title'] = 'Class Assign Subject List';
        $data['getRecord'] = AssignSubject::getRecord();
        return view('admin.assign_subject.list', $data);
    }

    public function add(Request $request){
        $data['header_title'] = 'Assign Subject Add';
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        return view('admin.assign_subject.add', $data);
    }
    public function insert(Request $request){
        if(!empty($request->subject_id)){
            foreach($request->subject_id as $subject_id){
                $getAlreadyFirst = AssignSubject::getAlreadyFirst($request->class_id, $subject_id);
                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status=$request->status;
                    $getAlreadyFirst->save();
                }else{
                    $save = new AssignSubject();
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('admin/assign_subject/list')->with('success', 'Class Subject Successfully Added');
        }
        else
        {
            return redirect()->back()->with('error', 'Please Select Subject');
        }
    }
    public function edit($id){
        $getRecord = AssignSubject::find($id);
        if(!empty($getRecord)){
            $data['getRecord'] = $getRecord;
            $data['getAssignsubjectID'] = AssignSubject::getAssignsubjectID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Edit Assign Subject';
            return view('admin.assign_subject.edit', $data);
        }else{
            return redirect()->back()->with('error', 'Record Not Found');
        }

    }
    public function update($id, Request $request){
        AssignSubject::deleteSubject($request->class_id);
        if(!empty($request->subject_id)){
            foreach($request->subject_id as $subject_id){
                $getAlreadyFirst = AssignSubject::getAlreadyFirst($request->class_id, $subject_id);
                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status=$request->status;
                    $getAlreadyFirst->save();
                }else{
                    $save = new AssignSubject();
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('admin/assign_subject/list')->with('success', 'Class Subject Successfully Updated');
        }
        else
        {
            return redirect()->back()->with('error', 'Please Select Subject');
        }
    }
    public function delete($id){
        $data = AssignSubject::find($id);
        $data->is_deleted=1;
        $data->save();
        return redirect()->back()->with('success', 'Class Subject Deleted Successfully');
    }

    public function edit_single($id){
        $getRecord=AssignSubject::find($id);
        if(!empty($getRecord)){
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Edit Single Assign Subject';
            return view('admin.assign_subject.edit_single', $data);
        }else{
            return redirect()->back()->with('error', 'Record Not Found');
        }
    }
    public function update_single($id, Request $request){
        $getAlreadyFirst = AssignSubject::getAlreadyFirst($request->class_id, $request->subject_id);
        if(!empty($getAlreadyFirst)){
            $getAlreadyFirst->status=$request->status;
            $getAlreadyFirst->save();
            return redirect('admin/assign_subject/list')->with('success', 'Status Successfully Updated');
        }else{
            $save = new AssignSubject();
            $save->class_id = $request->class_id;
            $save->subject_id = $request->subject_id;
            $save->status = $request->status;
            $save->save();
            return redirect('admin/assign_subject/list')->with('success', 'Subject Successfully Assigned to Class');
        }
    }
}
