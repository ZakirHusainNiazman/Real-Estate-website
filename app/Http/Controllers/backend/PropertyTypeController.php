<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;

class PropertyTypeController extends Controller
{
    public function allType(){
        $types = PropertyType::latest()->get();

        return view('backend.type.all_type',compact('types'));
    }

    public function addType(){
        return view('backend.type.add_type');
    }

    public function storeType(Request $request){
        $request->validate([
            'type_name'=>'required|unique:property_types|max:200',
            'type_icon'=>'required',
        ]);

        PropertyType::insert([
            'type_name'=>$request->type_name,
            'type_icon'=>$request->type_icon,
        ]);

        $notification = array(
            'message'=>'Property Type Created Successfully',
            'alert-type'=>'success',
        );

        return redirect()->route('all.type')->with($notification);
    }

    public function editType($id){

        $type = PropertyType::findOrFail($id);

        return view('backend.type.edit_type',compact('type'));
    }

    public function updateType(Request $request,$id){

        $request->validate([
            'type_name'=>'required|max:200',
            'type_icon'=>'required',
        ]);


        $type = PropertyType::find($id);

        $type->type_name = $request->type_name;
        $type->type_icon = $request->type_icon;
        $type->save();

        $notification = array(
            'message'=>'Property Type Updated Successfully',
            'alert-type'=>'success',
        );

        return redirect()->route('all.type')->with($notification);

    }

    public function deleteType($id){
        $notification = array(
            'message'=>'Property Type Deleted Successfully',
            'alert-type'=>'success',
        );

        PropertyType::findOrFail($id)->delete();
        return redirect()->back()->with($notification);
    }
}
