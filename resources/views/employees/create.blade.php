@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Employee</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <label>Salary:</label>
        <input type="text" name="salary" value="{{ old('salary') }}" class="form-control @error('salary') is-invalid @enderror">
        @error('salary')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <label>Joining Date:</label>
        <input type="date" name="joining_date" value="{{ old('joining_date') }}" class="form-control @error('joining_date') is-invalid @enderror">
        @error('joining_date')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <label>Phone:</label>
        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">
        @error('phone')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <label>RFID:</label>
        <input type="text" name="RFID" value="{{ old('RFID') }}" class="form-control @error('RFID') is-invalid @enderror">
        @error('RFID')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        <br>
        <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>
</div>
@endsection
