<h1>Ini Dashboard Admin</h1>

@if (session('success'))
    <div class="">
        {{ session('success') }}
    </div>
@endif
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
