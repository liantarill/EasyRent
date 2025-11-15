@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div>
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.vehicles.store') }}" method="POST">
        @csrf

        <label>Brand</label>
        <input type="text" name="brand"><br>

        <label>Year</label>
        <input type="number" name="year"><br>

        <label>Plate Number</label>
        <input type="text" name="plate_number"><br>

        <label>Transmission</label>
        <select name="transmission">
            @foreach (['manual', 'automatic'] as $transmission)
                <option value="{{ $transmission }}">
                    {{ ucfirst($transmission) }}
                </option>
            @endforeach
        </select><br>

        <label>Fuel Type</label>
        <select name="fuel_type">
            @foreach (['gasoline', 'diesel', 'electric'] as $fuel_type)
                <option value="{{ $fuel_type }}">
                    {{ ucfirst($fuel_type) }}
                </option>
            @endforeach
        </select><br>

        <label>Capacity</label>
        <input type="number" name="capacity"><br>


        <label>Price Per Day</label>
        <input type="number" name="price_per_day"><br>

        <label>Description</label>
        <input type="text" name="description"><br>e


        <label>Photo</label>
        <input type="file" name="photo" accept="image/*"><br>


        <label>Vehicle Type</label>
        <select name="vehicle_type">
            @foreach (['car', 'motorcycle'] as $vehicle_type)
                <option value="{{ $vehicle_type }}">
                    {{ ucfirst($vehicle_type) }}
                </option>
            @endforeach
        </select><br>

        <label>Status</label>
        <select name="status">
            @foreach (['Available', 'Rented', 'Maintenance'] as $status)
                <option value="{{ $status }}">
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select><br>


        <button type="submit">
            Simpan
        </button>
        <a href="{{ route('admin.vehicles.index') }}">
            Batal
        </a>

    </form>
@endsection
