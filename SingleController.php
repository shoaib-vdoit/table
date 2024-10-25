<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SingleModel;   //using model 'SinleModel' here to connect with controller 'SingleController'

class SingleController extends Controller
{
    //function used to receive all the data from SingleModel
    function getdata()
    {
        //return all the data from table and set id in a order of descending
        return SingleModel::orderBy('id','desc')->get();  //database table data receive in descending ordey through get()
    }

    //function used to save data on table through model
    function savedata(Request $req)   //$req variable has all the information which ccoming through POST from Route
    {
        //maiking object of model to insert data under database table
        $emp = new SingleModel;   //through obj we insert all the information under table column
        parse_str($req->input('data'), $formData);  //Data come in seralize form which decode and stored in $formData

        //storing form data on table field
        //if you increase form field the increase column here also
        $emp->employee_name = $formData['employee_name'];  //table_obj->table_col=$Array['form_col']
        $emp->email = $formData['email'];

        if(empty($formData['id']) || ($formData['id']==""))
        {
            $emp->save();
        }
        else
        {
            $emp=SingleModel::find($formData['id']);
            $emp->employee_name=$formData['employee_name'];
            $emp->email = $formData['email'];
            $emp->update();
        }
        

        //Table is saved after data insert and send response
        $emp->save();   //when all data insert completely, table will save
        echo "Data Successfully Inserted";   //send response to Ajax in blade file
    }

    function editdata(Request $req)
    {
        return SingleModel::find($req->id);

    }
}
