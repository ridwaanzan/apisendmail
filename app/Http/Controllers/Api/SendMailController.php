<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Mail;
use App\Mail\NotifyMail;

class SendMailController extends Controller
{
    public function sendMail(Request $req)
    {
        Mail::to($req->email)->send(new NotifyMail($req));

        if (Mail::failures()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email!'
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengirim email!'
            ], 201);
        }
    }
}
