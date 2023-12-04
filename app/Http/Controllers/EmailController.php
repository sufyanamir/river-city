<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class EmailController extends Controller
{
    protected $userDetails;

    public function __construct()
    {
        // Retrieve user details from session and store it in $userDetails
        $this->userDetails = Session::get('user_details');
    }

    // ================================================== email =====================================================================
    // get emails
    public function deleteEmail($id)
    {
        try {
            $email = Email::find($id);

            if (!$email) {
                return response()->json(['success' => false, 'message' => 'email not found!'], 404);   
            }

            $email->delete();

            return response()->json(['success' => true, 'message' => 'email deleted!'], 200);


        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // get emails

    // get emails
    public function getEmails()
    {
        $emails = Email::get();

        return view('email-templates', ['emailTemplates' => $emails, 'user_details' => $this->userDetails]);
    
    }
    // get emails
    // add mail
    public function addMailTemplate(Request  $request)
    {
        try {
            $validatedData = $request->validate([
                'email_name' => 'required|string',
                'email_type'  => 'required|string',
                'email_to' => 'nullable|string',
                'email_subject' => 'required|string',
                'email_body' => 'nullable|string',
                'email_format' => 'required|string',
                'email_attachments' => 'nullable|file|mimes:pdf,gif',
            ]);

            $email = Email::create([
                'email_name' => $validatedData['email_name'],
                'email_type' => $validatedData['email_type'],
                'email_to' => $validatedData['email_to'],
                'email_subject' => $validatedData['email_subject'],
                'email_format' => $validatedData['email_format'],
                'email_body' => $validatedData['email_body'],
            ]);

            if ($request->hasFile('email_attachments')) {
                $file = $request->file('email_attachments');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/email_files', $fileName); // Adjust storage path as needed
                $email->email_attachments = 'storage/email_files/' . $fileName;
            }

            $email->save();

            return response()->json(['success' => true, 'message' => 'Email added successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add mail
    // ================================================== email =====================================================================
}
