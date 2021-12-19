<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Loan;


class loanController extends Controller
{
    //
    function rqstsubmit(Request $request)
    {

        $image = $request->file('document');
        $image_name=$image->getClientOriginalName();
        $image_ext=$image->getClientOriginalExtension();
        $image_new_name =strtoupper(Str::random(6));
        $image_full_name=$image_new_name.'.'.$image_ext;
        $upload_path='storage/employee/';
        $image_url=$upload_path.$image_full_name;
        $success=$image->move($upload_path,$image_full_name);
        $imageData='storage/employee/'.$image_full_name;

        $loan=new Loan();
        $loan->loantype=$request->loantype;
        $loan->loanamount=$request->loan;
        $loan->loaninterestrate=$request->irate;
        $loan->amountpaid=$request->apaid;
        $loan->loanapprovedate=$request->aprvdate;
        $loan->loandocument=$imageData;
        $loan->save();
        return "Loan Create Done";
    }
    function loanList()
    {
        return Loan::all();
    }
    function loandetails(Request $request)
    {
        $id=$request->id;
        return Loan::where('id',$id)->limit(1)->get();

    }
}
