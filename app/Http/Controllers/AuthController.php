<?php
namespace App\Http\Controllers;

use App\Jobs\SendWelcomeMailJob;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Dispatch the user id so attachments are generated from the saved model.
        SendWelcomeMailJob::dispatch($user->id);

        // user gets instant response, no waiting!
        return response()->json(['message' => 'Registered successfully!']);
    }
}
