<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;


class PropertiesAPIController extends Controller
{
    public function properties ()
    {
        //return response()->json( Property::all() );
        $properties = Property::with('city')->with('list_type')->get();
        return response()->json($properties);
    }

    public function saveContactAgents()
    {
        $contact = new ContactAgent();
        if($request->isMethod('POST')){
            $contact = new ContactAgent();
            $contact->name = $request->input("name");
            $contact->email = $request->input("email");
            $contact->phone = $request->input("phone");
            $contact->message = $request->input("message");
            $contact->save();
        }
        return response()->json(['message' => 'Message sent successfully']);
    }
}
