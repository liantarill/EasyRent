<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileCompletionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $showKtp = session('show_ktp', false);
        $showProfilePicture = session('show_profilePicture', true);

        return view('auth.profile-completion', compact('showKtp', 'showProfilePicture', 'user'));
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile', 'public');

            $user->profile_picture = $path;
            $user->save();
        }

        // redirect back and set session flag to show KTP step
        return redirect()
            ->route('profile-completion')
            ->with('success', 'Profile picture uploaded.');
    }

    public function nextPage()
    {
        return redirect()
            ->route('profile-completion') // halaman utama profile completion
            ->with('show_ktp', true)
            ->with('show_profilePicture', false);
    }

    public function uploadIdCard(Request $request)
    {
        $request->validate([
            'id_card_photo' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $user = Auth::user();

        if ($request->hasFile('id_card_photo')) {
            if ($user->id_card_photo && Storage::disk('public')->exists($user->id_card_photo)) {
                Storage::disk('public')->delete($user->id_card_photo);
            }
            $path = $request->file('id_card_photo')->store('id_card', 'public');
            $user->id_card_photo = $path;
            $user->save();
        }

        return redirect()
            ->route('profile-completion')
            ->with('show_ktp', true)
            ->with('show_profilePicture', false)
            ->with('success', 'ID card picture uploaded.');
    }

    public function complete()
    {
        return redirect()->intended('dashboard')->with('success', 'Selamat datang, ' . Auth::user()->username . '!');
    }
}
