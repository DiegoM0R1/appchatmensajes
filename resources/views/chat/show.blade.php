<x-app-layout>
    <x-slot name="header">

        <div class="container-fluid p-0">
            <div class="d-flex flex-column flex-md-row vh-100">
                <!-- Sidebar -->
                <div class="sidebar bg-dark text-white p-3 flex-shrink-0 d-none d-md-block" style="width: 100%; max-width: 300px;">
                    <h2>Usuarios</h2>
                    <ul class="list-group list-group-flush">
                        @foreach($users as $u)
                            <li class="list-group-item bg-dark">
                                <a href="{{ route('chat.show', $u->id) }}" class="text-white">{{ $u->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Chat Window -->
                <div class="chat-window flex-grow-1 d-flex flex-column p-3">
                    <div class="chat-header bg-light p-3 d-flex justify-content-between align-items-center">
                        <h3>Chat con {{ $user->name }}</h3>
                        <a href="{{ route('chat.index') }}" class="btn btn-secondary d-md-none">Volver</a>
                    </div>
                    <div class="chat-body flex-grow-1 overflow-auto p-3">
                        <ul class="list-unstyled">
                            @foreach($messages as $message)
                                <li class="message-container {{ $message->user_id == Auth::id() ? 'message-sender' : 'message-receiver' }}">
                                    <div class="message p-2 mb-2 {{ $message->user_id == Auth::id() ? 'bg-primary text-white' : 'bg-secondary text-white' }}">
                                        <strong>{{ $message->user_id == Auth::id() ? 'Tú' : $message->user->name }}:</strong>
                                        <p>{{ $message->message }}</p>
                                        @if($message->file_path)
                                            @php
                                                $fileType = pathinfo($message->file_path, PATHINFO_EXTENSION);
                                            @endphp
                                            @if(in_array($fileType, ['jpg', 'jpeg', 'png', 'gif']))
                                                <!-- Mostrar imagen -->
                                                <img src="{{ asset('storage/' . $message->file_path) }}" class="img-thumbnail" style="max-width: 200px; max-height: 200px; cursor: pointer;" data-toggle="modal" data-target="#mediaModal-{{ $message->id }}">
                                                <!-- Modal para imagen -->
                                                <div class="modal fade" id="mediaModal-{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel-{{ $message->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="mediaModalLabel-{{ $message->id }}">Imagen</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img src="{{ asset('storage/' . $message->file_path) }}" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif(in_array($fileType, ['mp4', 'webm', 'ogg']))
                                                <!-- Mostrar video -->
                                                <video controls style="max-width: 200px; max-height: 200px;" data-toggle="modal" data-target="#mediaModal-{{ $message->id }}">
                                                    <source src="{{ asset('storage/' . $message->file_path) }}" type="video/{{ $fileType }}">
                                                    Tu navegador no soporta la etiqueta de video.
                                                </video>
                                                <!-- Modal para video -->
                                                <div class="modal fade" id="mediaModal-{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel-{{ $message->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="mediaModalLabel-{{ $message->id }}">Video</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <video controls style="width: 100%;">
                                                                    <source src="{{ asset('storage/' . $message->file_path) }}" type="video/{{ $fileType }}">
                                                                    Tu navegador no soporta la etiqueta de video.
                                                                </video>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <!-- Mostrar enlace de descarga -->
                                                <a href="{{ asset('storage/' . $message->file_path) }}" target="_blank" class="text-white">Descargar archivo</a>
                                            @endif
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="chat-footer p-3 bg-light">
                        <form action="{{ route('chat.send') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                            <div class="form-group flex-grow-1 mr-2">
                                <textarea name="message" class="form-control" placeholder="Escribe un mensaje..." rows="1"></textarea>
                            </div>
                            <div class="form-group mr-2">
                                <input type="file" name="file" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    

    <!-- Incluir Bootstrap CSS y JS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</x-app-layout>
