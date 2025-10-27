<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <div>
        <h1>Register</h1>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}">
            </div>
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <div>
                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
            </div>

            <div>
                <label for="profile_picture">Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            </div>

            <div>
                <label for="id_card_photo">ID Card Photo</label>
                <input type="file" id="id_card_photo" name="id_card_photo" accept="image/*">
            </div>

            <div>
                <button type="submit">Register</button>
            </div>
        </form>

        <div>
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>
</body>

</html>
