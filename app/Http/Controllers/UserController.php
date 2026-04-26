<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\SendWelcomeMailJob;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // show all users
    public function index()
    {
        $users = User::withTrashed()->paginate(10); // 10 per page
        return view('users.index', compact('users'));
    }

    // send mail to specific user
    public function sendMail($id)
    {
        $user = User::findOrFail($id);
        

        // Dispatch the job with the user id so the queued job can build
        // the latest PDF and QR code from the current database record.
        SendWelcomeMailJob::dispatch($user->id);

        return redirect()->back()->with('success', "Mail sent to {$user->name} successfully!");
    }

    // soft delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', "{$user->name} moved to trash successfully!");
    }

    // restore soft deleted user
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->back()->with('success', "{$user->name} restored successfully!");
    }
}
