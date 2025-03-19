<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css">
</head>

<body class="bg-gray-100 font-sans">

    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Projects</h1>

        @if(count($projects) > 0)
            <div class="bg-white shadow-lg rounded-lg p-6">
                <ul class="space-y-4">
                    @foreach ($projects as $project)
                        <li class="flex justify-between items-center p-4 bg-gray-50 rounded-md shadow-sm hover:bg-indigo-50">
                            <span class="text-xl text-gray-800">{{ $project['name'] }}</span>
                            <span class="text-sm text-gray-600">{{ $project['created_at'] ?? 'Fecha desconocida' }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="bg-white p-6 shadow-lg rounded-lg text-center">
                <p class="text-lg text-gray-600">No hay proyectos disponibles.</p>
            </div>
        @endif
    </div>

</body>

</html>
