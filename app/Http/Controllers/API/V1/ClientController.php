<?php

namespace App\Http\Controllers\API\V1;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller
{
    use CoreJsonResponse;


    public function login(Request $request)
    {

        $request->validate([
            "email" => ["required", "email"],
            "password" => ["required", "min:8"]
        ]);

        $client = Client::where('email', $request->email)->first();

        if (!$client || !Hash::check($request->password, $client->password) || ($client == null)) {
            throw ValidationException::withMessages([
                'error' => ['Incorrect Email or Password'],
            ]);
        }
        $token = $client->createToken('Auth Token')->plainTextToken;
        return $this->ok(['token' => $token, 'client' => $client]);
    }
}
