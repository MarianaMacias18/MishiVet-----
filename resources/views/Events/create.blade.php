@extends('layout')

@section('title', isset($event) ? 'Editar Evento' : 'Crear Evento')

@section('content')
    @if ($shelters->isEmpty())
        <x-aviso-component 
            titulo="Aviso sin Refugios disponibles" 
            mensaje="¡Vaya! Parece que aún no has creado un refugio en donde poder organizar tus eventos. Por favor, crea uno antes de organizar un nuevo evento."
            botonTexto="Cerrar" 
        />
    @endif

    <div class="background-image" style="background-image: url('{{ asset('img/event3.jpg') }}');">
        <div class="container mt-5">
            <!-- Contenedor del formulario con fondo semi-transparente -->
            <div class="bg-dark bg-opacity-50 p-5 rounded-3 shadow-sm">
                <x-edit-component 
                    :title="isset($event) ? 'Editar Evento' : 'Crear Evento'" 
                    :action="isset($event) ? route('events.update', $event) : route('events.store')" 
                    :method="isset($event) ? 'PUT' : 'POST'" 
                    :submitText="isset($event) ? 'Actualizar' : 'Crear'" 
                    :backRoute="route('events.index')"
                    :deleteAction="isset($event) ? route('events.destroy', $event) : null">

                    <!-- Nombre del Evento -->
                    <div class="form-group">
                        <label for="nombre" class="form-label fw-semibold text-white"><strong>Nombre del Evento</strong></label>
                        <input type="text" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('nombre') is-invalid border-warning @enderror" 
                               name="nombre" id="nombre" placeholder="Ingresa nombre" value="{{ old('nombre', $event->nombre ?? '') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Fecha del Evento -->
                    <div class="form-group">
                        <label for="fecha" class="form-label fw-semibold text-white"><strong>Fecha</strong></label>
                        <input type="datetime-local" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('fecha') is-invalid border-warning @enderror" 
                               name="fecha" id="fecha" value="{{ old('fecha', isset($event) ? $event->fecha->format('Y-m-d\TH:i') : '') }}" required>
                        @error('fecha')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Descripción del Evento -->
                    <div class="form-group">
                        <label for="descripcion" class="form-label fw-semibold text-white"><strong>Descripción</strong></label>
                        <textarea class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('descripcion') is-invalid border-warning @enderror" 
                                  name="descripcion" id="descripcion" placeholder="Ingresa descripción" required>{{ old('descripcion', $event->descripcion ?? '') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Refugios Asociados -->
                    <div class="form-group">
                        <label for="shelters" class="form-label fw-semibold text-white"><strong>Refugios Asociados</strong></label>
                        <select multiple class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('shelters') is-invalid border-warning @enderror" 
                                name="shelters[]" id="shelters">
                            @foreach($shelters as $shelter)
                                <option value="{{ $shelter->id }}" 
                                    {{ isset($event) && $event->shelters->contains($shelter->id)  ? 'selected' : ($loop->first ? 'selected' : '') }}>
                                    {{ $shelter->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-white">Nota: Puedes seleccionar a más de un refugio para participar en el evento.</small>
                        @error('shelters')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Ubicación del Evento -->
                    <div class="form-group">
                        <label for="ubicacion" class="form-label fw-semibold text-white"><strong>Ubicación del Evento</strong></label>
                        <input type="text" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('ubicacion') is-invalid border-warning @enderror" 
                               required name="ubicacion" id="ubicacion" placeholder="Ej: México, Jal, GDL" value="{{ old('ubicacion', $event->pivot->ubicacion ?? '') }}">
                        @error('ubicacion')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Número de Participantes -->
                    <div class="form-group">
                        <label for="participantes" class="form-label fw-semibold text-white"><strong>Número de Participantes</strong></label>
                        <input type="number" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('participantes') is-invalid border-warning @enderror" 
                               required name="participantes" id="participantes" placeholder="Ingresa cantidad" value="{{ old('participantes', $event->pivot->participantes ?? '') }}">
                        <small class="form-text text-white">Para crear un evento, debe haber un mínimo de 20 participantes.</small>
                        @error('participantes')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                </x-edit-component>
            </div>
        </div>
    </div>
@endsection
