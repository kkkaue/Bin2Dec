<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ConvertController extends Controller
{
    public function convert(Request $request)
    {
        $validatedData = [
            'binaryNumber' => 'regex:/^[0-1]+$/',
        ];

        $mensagem = [
            'binaryNumber.regex' => 'Um número binário é composto apenas por números 0 e 1.',
        ];

        $request->validate($validatedData, $mensagem);

        $binary = $request->input('binaryNumber');
        $decimal = bindec($binary);
        
        return redirect()->back()->with('decimalNumber', $decimal);
    }
}
