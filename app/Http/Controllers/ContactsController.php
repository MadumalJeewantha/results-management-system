<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\DB;

use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use View;

use App\Jobs\sendReplyToContactsJob;

class ContactsController extends Controller
{
    public function __construct(){
        $this->middleware('config');
        $this->middleware('deansonly',['except' => ['create','store']]);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(15);

        // $contacts = DB::table('contacts')->orderBy('created_at', 'desc')->paginate(15);
        return view('contacts.index')->with('contacts',$contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ContactClass = 'active';
        return view('pages.contact')->with('ContactClass',$ContactClass);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation rules
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            
        ]);

        //Create new message
        $contact = new Contact;
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->message = $request->input('message');
        //Save new message
        $contact->save();

        //Return location with notification
        return redirect('/contact/create')->with('success', "Thank you for your valued feedback.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('contacts.view')->with('contact',$contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
        //Send reply email
        sendReplyToContactsJob::dispatch($request->all());

        //If success make response as 1   
        $contact = Contact::findOrFail($id);
        $contact->response = '1';
        $contact->reply = $request->reply;
        $contact->save();

        return redirect()->back()->with('success','Your reply has been sent to ' . $request->email );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json($contact);
    }
}
