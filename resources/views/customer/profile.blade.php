@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')

    <div style="max-width: 960px; margin: 120px auto 60px; padding: 0 16px;">
        <h1 style="margin-bottom: 8px;">Profil Saya</h1>
        <p style="margin-bottom: 24px; color: #555;">Lengkapi informasi berikut agar proses peminjaman dapat dilakukan.</p>

        @if (session('success'))
            <div style="padding: 12px; border: 1px solid #9acd32; margin-bottom: 16px; background: #f6ffed;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="padding: 12px; border: 1px solid #ff6961; margin-bottom: 16px; background: #fff5f5;">
                <p style="font-weight: 600; margin-bottom: 8px;">Terjadi kesalahan:</p>
                <ul style="margin-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="border: 1px solid #ddd; padding: 16px; margin-bottom: 24px;">
            <h2 style="margin-bottom: 8px;">Status Peminjaman</h2>
            @if ($isProfileComplete)
                <p style="color: #2f855a; margin: 0;">Data lengkap, Anda bisa melakukan peminjaman.</p>
            @else
                <p style="color: #b7791f; margin: 0 0 8px;">Profil belum lengkap. Lengkapi data berikut:</p>
                <ul style="margin-left: 18px;">
                    @foreach ($missingFields as $field)
                        <li>{{ $field }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div style="display: flex; gap: 16px; align-items: center; border: 1px solid #ddd; padding: 16px; margin-bottom: 24px;">
            <div>
                <img src="{{ asset('storage/' . ($user->profile_picture ?? 'profile/profile.png')) }}" alt="Foto profil"
                    style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
            </div>
            <div>
                <p style="margin: 0; font-weight: 600;">{{ $user->name }}</p>
                <p style="margin: 4px 0;">{{ $user->email }}</p>
                <p style="margin: 0;">{{ $user->phone_number ?? 'Nomor telepon belum diisi' }}</p>
            </div>
        </div>

        <section style="border: 1px solid #ddd; padding: 16px; margin-bottom: 24px;">
            <h2 style="margin-bottom: 12px;">Informasi Pribadi</h2>
            <form action="{{ route('customer.profile.update') }}" method="POST" style="display: grid; gap: 12px;">
                @csrf
                @method('PUT')

                <label>
                    <span>Username</span>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                        style="width: 100%; padding: 8px; border: 1px solid #ccc;">
                </label>

                <label>
                    <span>Nama Lengkap</span>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        style="width: 100%; padding: 8px; border: 1px solid #ccc;">
                </label>

                <label>
                    <span>Email</span>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        style="width: 100%; padding: 8px; border: 1px solid #ccc;">
                </label>

                <label>
                    <span>Nomor Telepon</span>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc;">
                </label>

                <div>
                    <button type="submit" style="padding: 10px 16px; border: 1px solid #222; background: #222; color: #fff;">
                        Simpan
                    </button>
                </div>
            </form>
        </section>

        <div style="display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
            <section style="border: 1px solid #ddd; padding: 16px;">
                <h3 style="margin-bottom: 12px;">Foto Profil</h3>
                <img src="{{ asset('storage/' . ($user->profile_picture ?? 'profile/profile.png')) }}" alt="Foto profil"
                    style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc; margin-bottom: 12px;">
                <form action="{{ route('customer.profile.picture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="profile_picture" accept="image/*" required style="margin-bottom: 8px;">
                    <p style="font-size: 12px; color: #555;">Format jpg/jpeg/png, maks 2MB.</p>
                    <button type="submit" style="padding: 8px 12px; border: 1px solid #222; background: #fff;">Unggah Foto</button>
                </form>
            </section>

            <section style="border: 1px solid #ddd; padding: 16px;">
                <h3 style="margin-bottom: 12px;">Foto Identitas</h3>
                <div style="border: 1px dashed #bbb; padding: 12px; margin-bottom: 12px; min-height: 120px;">
                    @if ($user->id_card_photo)
                        @if (str_ends_with($user->id_card_photo, '.enc'))
                            <img src="{{ route('customer.profile.id_card.view') }}" alt="Foto identitas"
                                style="max-width: 100%; max-height: 200px;">
                        @else
                            <img src="{{ asset('storage/' . $user->id_card_photo) }}" alt="Foto identitas"
                                style="max-width: 100%; max-height: 200px;">
                        @endif
                    @else
                        <p style="color: #666; margin: 0;">Belum ada foto identitas.</p>
                    @endif
                </div>

                <form action="{{ route('customer.profile.id_card') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="id_card_photo" accept="image/*" required style="margin-bottom: 8px;">
                    <p style="font-size: 12px; color: #555;">Format jpg/jpeg/png, maks 4MB.</p>
                    <button type="submit" style="padding: 8px 12px; border: 1px solid #222; background: #fff;">Unggah Identitas</button>
                </form>
            </section>
        </div>
    </div>
@endsection
