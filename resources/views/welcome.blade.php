<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plants Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="text-center">
            <h1 class="display-4 mb-4">Welcome to Plants Store</h1>
            <p class="lead mb-5">Your one-stop shop for beautiful plants</p>
            
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('plants.index') }}" class="btn btn-primary btn-lg">
                    Browse Plants
                </a>
                @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                    Login
                </a>
                @endguest
            </div>
        </div>
    </div>
</body>
</html>