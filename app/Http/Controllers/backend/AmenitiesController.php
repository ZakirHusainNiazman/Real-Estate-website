<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenities;

class AmenitiesController extends Controller
{
    // amenities functions
    public function allAmenities(){
        $amenities = Amenities::all();
        return view('backend.amenities.all_amenities',compact('amenities'));
    }

    public function addAmenities(Request $request){
        return view('backend.amenities.add_amenities');
    }

    public function storeAmenities(Request $request){
        Amenities::insert([
            'name'=>$request->amenity_name
        ]);

        $notification = array(
            'message'=>'Amenity Added Successfully',
            'alert-type'=>'success'
       );

        return redirect()->route('all.amenities')->with($notification);
    }

    public function editAmenities($id){
        $amenity = Amenities::findOrFail($id);
        return view('backend.amenities.edit_amenities',compact('amenity'));
    }

    public function updateAmenities(Request $request,$id){
        Amenities::find($id)->update([
            'name'=>$request->amenity_name,
        ]);


        $notification = array(
            'message'=>'Amenity Updated Successfully',
            'alert-type'=>'success',
        );

        return redirect()->route('all.amenities')->with($notification);
    }

    public function deleteAmenities($id){
        Amenities::find($id)->delete();

        $notification = array(
            'message'=>'Amenity Updated Successfully',
            'alert-type'=>'success',
        );

        return redirect()->route('all.amenities')->with($notification);
    }
}
