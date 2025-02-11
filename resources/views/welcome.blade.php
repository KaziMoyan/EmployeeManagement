<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="text-center">
            <h1 class="mb-4">Welcome to Employee Management System</h1>
            <a href="{{ route('employees.index') }}" class="btn btn-primary btn-lg me-3">👨‍💼 Employees</a>
            <a href="{{ route('attendances.index') }}" class="btn btn-success btn-lg">📋 Attendances</a>
        </div>
    </div>
</body>
</html>
