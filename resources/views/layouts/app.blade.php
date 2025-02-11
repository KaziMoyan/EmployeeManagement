<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="{{ route('welcome') }}">Employee Management</a>
            <div>
                <a href="{{ route('employees.index') }}" class="btn btn-outline-light me-2">👨‍💼 Employees</a>
                <a href="{{ route('attendances.index') }}" class="btn btn-outline-light">📋 Attendances</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
