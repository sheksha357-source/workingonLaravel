<?php
namespace App\Http\Controllers;

use App\Jobs\SendWelcomeMailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        SendWelcomeMailJob::dispatch($user->id);

        return response()->json([
            'status' => true,
            'message' => 'Registered successfully!',
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid email or password.',
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Logged in successfully!',
            'token' => Str::random(80),
            'has_other_devices' => false,
            'user' => $user,
        ]);
    }

    public function logoutOtherDevices()
    {
        return response()->json([
            'status' => true,
            'message' => 'Other devices logged out successfully!',
        ]);
    }
    public function  userData(Request $request){
        print_r($request->all());exit;  
    }
}
