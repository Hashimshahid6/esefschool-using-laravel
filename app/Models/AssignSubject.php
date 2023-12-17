<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AssignSubject extends Model
{
    use HasFactory;
    protected $table = 'class_subject';
    static public function getRecord()
    {
        $result = self::select('class_subject.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')
            ->join('class', 'class.id', 'class_subject.class_id')
            ->join('subject', 'subject.id', 'class_subject.subject_id')
            ->join('users', 'users.id', 'class_subject.created_by')
            ->where('class_subject.is_deleted', '=' , 0);

        if (!empty(Request::get('class_name'))) {
            $result = $result->where('class.name', Request::get('class_id'));
        }
        if (!empty(Request::get('subject_name'))) {
            $result = $result->where('subject.name', Request::get('subject_id'));
        }
        if (!empty(Request::get('date'))) {
            $result = $result->whereDate('class_subject.created_at', Request::get('date'));
        }

        $result = $result->orderBy('class_subject.id', 'ASC')->get();

        return $result;
    }
    static public function getAlreadyFirst($class_id, $subject_id){
        return self::where('class_id', $class_id)->where('subject_id', $subject_id)->first();
    }
    static public function getAssignsubjectID($class_id){
        return self::where('class_id', $class_id)->where('is_deleted', '=',  0)->get();
    }
    static public function deleteSubject($class_id){
        return self::where('class_id', $class_id)->delete();
    }
}
