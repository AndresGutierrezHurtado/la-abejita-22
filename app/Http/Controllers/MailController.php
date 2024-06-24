<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\CustomMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request)    {

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'user_full_name' => 'required|string|max:255',
            'user_email' => 'required|email',
            'email_subject' => 'required|string|max:255',
            'email_message' => 'required|string'
        ]);

        // Obtener los datos validados
        $details = [
            'title' => $validatedData['email_subject'],
            'body' => $validatedData['email_message'],
            'user_full_name' => $validatedData['user_full_name'],
            'user_email' => $validatedData['user_email']
        ];

        Mail::to('laabejita22.uni@gmail.com')->send(new CustomMail($details));

        return back()->with('status', 'Correo enviado con éxito');

    }

}
