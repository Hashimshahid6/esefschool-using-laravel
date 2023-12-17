<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class SubjectModel extends Model
{
    use HasFactory;
    protected $table = 'subject';
    static public function getRecord(){
        $record = SubjectModel::select('subject.*', 'users.name as created_by_name')
        ->join('users', 'users.id', 'subject.created_by');
        if(!empty(Request::get('name'))){
            $record = $record->where('subject.name', 'LIKE', '%' . Request::get('name') . '%');
        }
        if(!empty(Request::get('subject_type'))){
            $record = $record->where('subject.subject_type', '=', Request::get('subject_type'));
        }
        if(!empty(Request::get('date'))){
            $record = $record->where('subject.created_at', '=' , Request::get('date'));
        }
        $record = $record->where('subject.is_deleted', '=', 0)
        ->orderBy('subject.id', 'DESC')
        ->paginate(10);
        return $record;
    }

    static public function getSubject(){
        $record = SubjectModel::select('subject.*')
        ->join('users', 'users.id', 'subject.created_by')
        ->where('subject.is_deleted', 0)
        ->where('subject.status', 0 )
        ->orderBy('subject.name', 'ASC')
        ->get();
        return $record;
    }
}
