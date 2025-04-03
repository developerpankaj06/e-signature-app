<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signature;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
class SignatureController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'signature' => 'required',
        ]);

        $signature = new Signature();
        $signature->user_id = Auth::id();
        $signature->signature_image = $request->signature; // Base64 encoded image
        $signature->save();

        return response()->json(['message' => 'Signature saved successfully']);
    }

    public function show($id)
    {
        $signature = Signature::findOrFail($id);
        return view('show-signature', compact('signature'));
    }
    public function downloadPdf($id)
{
    $signature = Signature::findOrFail($id);
    $pdf = Pdf::loadView('pdf.signature', compact('signature'));
    return $pdf->download('signature.pdf');
}
}
