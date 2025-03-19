{{-- resources/views/login.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-roboto">

    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-sm bg-white p-8 shadow-md rounded-md">
            <h2 class="text-center text-2xl font-semibold text-gray-800 mb-4">Iniciar sesión</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 p-2 w-full border rounded-md @error('email') border-red-500 @enderror">
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="password" type="password" name="password" required class="mt-1 p-2 w-full border rounded-md @error('password') border-red-500 @enderror">
                    @error('password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-4">
                    <label for="remember" class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="form-checkbox text-indigo-600">
                        <span class="ml-2 text-sm text-gray-600">Recuérdame</span>
                    </label>
                    <a href="#" class="text-sm text-indigo-600">¿Olvidaste tu contraseña?</a>
                </div>

                <div>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">
                        Iniciar sesión
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
