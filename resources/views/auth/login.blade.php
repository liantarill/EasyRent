<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>

    @if (session('failed'))
        <div class="">
            {{ session('failed') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.authenticate') }}">
        @csrf
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" autofocus required>
        @error('email')
            <small>{{ $message }} </small>
        @enderror
        <br>

        <label>Password:</label><br>
        <input type="password" name="password" required>
        @error('password')
            <small>{{ $message }}</small>
        @enderror
        <br>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
</body>

</html>
