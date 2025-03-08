<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;
use App\Mail\ContactFormMail;
use App\Models\PropertyListingType; // Asegúrate de que la ruta del modelo sea correcta
use App\Models\ContactAgent;

class HomelandController extends Controller
{
    public function index()
    {
        $properties = Property::all();

        return view('homeland.index', compact('properties'));

    }

    public function property_details(Request $request, $property_id)
    {
        if($request->isMethod('post'))
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:50',
                'phone' => 'required|max:20|regex:/^[0-9+\-() ]+$/',
                'message' => 'required|string|max:1000',
            ],[
                'name.required' => 'The name field is required.',
                'email.required' => 'The email field is required.',
                'email.email' => 'The email must be a valid email address.',
                'phone.regex' => 'The phone number format is invalid.',
                'message.required' => 'The message field is required.',

            ]);

            $contact = new ContactAgent();
            $contact->name = $request->input("name");
            $contact->email = $request->input("email");
            $contact->phone = $request->input("phone");
            $contact->message = $request->input("message");
            $contact->save();
            session()->now('message', 'Message sent successfully');
        }

        $property = Property::find($property_id);

        return view('homeland.property_details', compact('property'));
    }

    public function buy()
    {
        $properties = Property::where("offer_type", "For Sale") -> get();
        return view('homeland.buy', compact('properties'));

    }

    public function rent()
    {
        $properties = Property::where("offer_type", "For Rent") -> get();
        return view('homeland.rent', compact('properties'));

    }

    public function properties_listing_type($property_listing_type_id)
    {
        //$properties = Property::where("property_listing_type") -> get();
        $properties = PropertyListingType::find($property_listing_type_id)->properties;
        //dd($properties);
        return view('homeland.index', compact('properties'));

    }

    public function propieties($property_type_id)
    {
        return view('homeland.propieties', ['property_type_id' => $property_type_id]);

    }

    public function about()
    {
        return view('homeland.about');

    }

    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'fullname' => 'required|string|max:255',
                'email' => 'required|email|max:50',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:1000',
            ]);


            $contact = new ContactMessage();
            $contact->fullname = $request->input("fullname");
            $contact->email = $request->input("email");
            $contact->subject = $request->input("subject");
            $contact->message = $request->input("message");
            $contact->save();


            Mail::to('20031398@itcelaya.edu.mx')->send(new ContactFormMail($contact));

            return back()->with('success', 'Your message has been sent successfully!');
        }

        return view('homeland.contact');
    }

    public function login()
    {
        return view('homeland.login');

    }

    public function register()
    {
        return view('homeland.register');

    }
}
