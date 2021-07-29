<?php

namespace App\Http\Controllers;

use App\Models\TransactionModel;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    function TransactionList(){
        $result=  TransactionModel::orderBy('id','desc')->get();
        return  $result;
    }

    function TransactionListByDate(Request $request){
        
        $result=  TransactionModel::orderBy('id','desc')->get();
        return  $result;
    }




}
