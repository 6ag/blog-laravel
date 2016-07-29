<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class BaseController extends Controller
{
    // 上传图片
    public function upload()
    {
        $file = Input::file('Filedata');
        if($file->isValid()){
            $entension = $file->getClientOriginalExtension(); //上传文件的后缀.
            $newName = date('YmdHis').mt_rand(100, 999).'.'.$entension;
            $file->move(base_path('public/uploads/'), $newName);
            $filepath = 'uploads/'.$newName;
            return $filepath;
        }
    }
}
