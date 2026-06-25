<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin Klinik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-sky-100 via-blue-50 to-white flex items-center justify-center px-4">

<div class="w-full max-w-md">
    <div class="bg-white/90 backdrop-blur rounded-3xl shadow-xl border border-sky-100 p-8">

        <div class="text-center mb-8">
            <div class="w-20 h-20 mx-auto bg-gradient-to-br from-sky-400 to-blue-600 rounded-3xl flex items-center justify-center text-4xl shadow-lg mb-4">
                🏥
            </div>

            <h1 class="text-3xl font-bold text-slate-800">
                Login Admin
            </h1>

            <p class="text-slate-500 mt-2">
                Masuk ke Dashboard Klinik
            </p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-600 border border-red-100 p-4 rounded-2xl mb-5 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Email
                </label>
                <input 
                    type="email" 
                    name="email" 
                    class="w-full border border-sky-100 bg-sky-50/50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition" 
                    placeholder="Masukkan email admin"
                    required
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Password
                </label>
                <input 
                    type="password" 
                    name="password" 
                    class="w-full border border-sky-100 bg-sky-50/50 px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition" 
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button class="w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white py-3 rounded-2xl font-semibold shadow-lg shadow-sky-200 transition">
                Login
            </button>
        </form>

    </div>

    <p class="text-center text-slate-400 text-sm mt-6">
        Sistem Informasi Antrian Klinik
    </p>
</div>

</body>
</html>