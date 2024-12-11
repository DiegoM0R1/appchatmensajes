<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid p-0">
            <div class="d-flex flex-column flex-md-row vh-100">
                <!-- Sidebar de usuarios -->
                <div class="sidebar bg-dark text-white p-3 flex-shrink-0" style="width: 100%; max-width: 300px;">
                    <h2>Usuarios</h2>
                    <ul class="list-group list-group-flush">
                        @foreach($users as $user)
                            <li class="list-group-item bg-dark d-flex align-items-center justify-content-between hover-effect">
                                <a href="{{ route('chat.show', $user->id) }}" class="text-white">
                                    {{ $user->name }}
                                </a>
                                @if($user->unreadMessagesCount > 0)
                                    <span class="badge bg-danger rounded-pill">{{ $user->unreadMessagesCount }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Ventana de chat -->
                <div class="chat-window flex-grow-1 d-flex flex-column p-3">
                    <div class="chat-header bg-light p-3 flex-shrink-0">
                        <h3>Selecciona un usuario para chatear</h3>
                    </div>
                    <div class="chat-body flex-grow-1 mt-3">
                        <!-- Aquí se cargará el contenido del chat -->
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>





