<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded shadow w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">
        Login Admin Klinik
    </h1>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="/login" method="POST">
        @csrf

        <label>Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded mb-4" required>

        <label>Password</label>
        <input type="password" name="password" class="w-full border p-2 rounded mb-4" required>

        <button class="bg-blue-600 text-white w-full py-2 rounded">
            Login
        </button>
    </form>
</div>

</body>
</html>