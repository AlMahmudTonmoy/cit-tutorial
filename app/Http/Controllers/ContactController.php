<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Storage;

class ContactController extends Controller
{
    function contactmessages(){
      $contacts =  Contact::all();
      return view('contact.index', compact('contacts'));
    }
    function contactuploaddownload($file_name) {
      return Storage::download('contacts_uploads/'.$file_name);
    }
}
