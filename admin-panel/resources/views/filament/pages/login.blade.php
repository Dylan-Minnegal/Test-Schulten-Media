<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css">
</head>

<body class="bg-white font-roboto">

    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-sm bg-white p-8 shadow-md rounded-md border border-gray-300">
            <h2 class="text-center text-2xl font-semibold text-gray-800 mb-4">Log In</h2>

            @if ($error)
                <div class="text-red-500 text-sm mb-4">{{ $error }}</div>
            @endif

            <form wire:submit.prevent="submit">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" wire:model="email" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" wire:model="password" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    @error('password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
