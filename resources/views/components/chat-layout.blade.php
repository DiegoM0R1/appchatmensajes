<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container-fluid d-flex flex-row">
        <!-- Sidebar -->
        <div class="sidebar bg-dark text-white p-3">
            <h2>Usuarios</h2>
            <ul class="list-group list-group-flush">
                @foreach($users as $user)
                    <li class="list-group-item bg-dark">
                        <a href="{{ route('chat.show', $user->id) }}" class="text-white">{{ $user->name }}</a>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cerrar sesión</a>
        </div>

        <!-- Chat Window -->
        <div class="chat-window flex-grow-1 p-3">
            <div class="chat-header bg-light">
                <h3>Selecciona un usuario para chatear</h3>
            </div>
            <div class="chat-body mt-3">
                <!-- Aquí se cargará el contenido del chat -->
                {{ $slot }}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

