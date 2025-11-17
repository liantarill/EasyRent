<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $missingFields = collect([
            'phone_number' => 'Nomor telepon',
            'profile_picture' => 'Foto profil',
            'id_card_photo' => 'Foto identitas',
        ])->filter(fn ($label, $field) => blank($user->{$field}))->values()->all();

        return view('customer.profile', [
            'user' => $user,
            'isProfileComplete' => $user->hasCompletedProfile(),
            'missingFields' => $missingFields,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone_number' => ['nullable', 'string', 'max:20'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile', 'public');
            $user->update(['profile_picture' => $path]);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function updateIdCard(Request $request)
    {
        $request->validate([
            'id_card_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $user = Auth::user();

        if ($request->hasFile('id_card_photo')) {
            $this->deleteExistingIdCard($user->id_card_photo);

            $contents = file_get_contents($request->file('id_card_photo')->getRealPath());
            $encrypted = encrypt($contents);
            $path = 'secure/id_cards/' . Str::uuid() . '.enc';

            Storage::disk('local')->put($path, $encrypted);
            $user->update(['id_card_photo' => $path]);
        }

        return back()->with('success', 'Foto identitas berhasil diperbarui.');
    }

    public function viewIdCard()
    {
        $user = Auth::user();
        $path = $user->id_card_photo;

        if (! $path) {
            abort(404);
        }

        if (str_ends_with($path, '.enc')) {
            if (! Storage::disk('local')->exists($path)) {
                abort(404);
            }

            $encrypted = Storage::disk('local')->get($path);
            $contents = decrypt($encrypted);
            $mime = $this->determineMimeType($contents);

            return response($contents, Response::HTTP_OK, ['Content-Type' => $mime]);
        }

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->response($path);
        }

        abort(404);
    }

    protected function deleteExistingIdCard(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (str_ends_with($path, '.enc')) {
            Storage::disk('local')->delete($path);
        } else {
            Storage::disk('public')->delete($path);
        }
    }

    protected function determineMimeType(string $contents): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_buffer($finfo, $contents);
        finfo_close($finfo);

        return $mime ?: 'image/jpeg';
    }
}
