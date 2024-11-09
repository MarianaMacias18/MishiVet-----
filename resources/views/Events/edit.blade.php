@extends('layout')

@section('title', isset($event) ? 'Editar Evento' : 'Crear Evento')

@section('content')
    <div class="background-image" style="background-image: url('{{ asset('img/event1.jpg') }}');">
        <div class="container mt-5">
            <!-- Contenedor del formulario con fondo semi-transparente -->
            <div class="bg-dark bg-opacity-50 p-5 rounded-3 shadow-sm">
                <x-edit-component 
                    :action="isset($event) ? route('events.update', $event) : route('events.store')"
                    :method="isset($event) ? 'PUT' : 'POST'"
                    :title="isset($event) ? 'Editar Evento' : 'Crear Evento'"
                    :submitText="isset($event) ? 'Actualizar' : 'Crear'"
                    :backRoute="route('events.index')"
                    :deleteAction="isset($event) ? route('events.destroy', $event) : null"
                >

                    <!-- Nombre del Evento -->
                    <div class="form-group">
                        <label for="nombre" class="form-label fw-semibold text-white"><strong>Nombre del Evento</strong></label>
                        <input type="text" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('nombre') is-invalid border-warning @enderror" 
                               name="nombre" id="nombre" value="{{ old('nombre', $event->nombre ?? '') }}" required>
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
                                  name="descripcion" id="descripcion" required>{{ old('descripcion', $event->descripcion ?? '') }}</textarea>
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
                                    {{ isset($event) && $event->shelters->contains($shelter->id) ? 'selected' : '' }}>
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
                               name="ubicacion" id="ubicacion" value="{{ old('ubicacion', isset($event) && $event->shelters->isNotEmpty() ? $event->shelters->first()->pivot->ubicacion : '') }}" required>
                        @error('ubicacion')
                            <div class="invalid-feedback text-warning fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Número de Participantes -->
                    <div class="form-group">
                        <label for="participantes" class="form-label fw-semibold text-white"><strong>Número de Participantes</strong></label>
                        <input type="number" class="form-control bg-white text-dark opacity-75 border-dark rounded-3 shadow-sm fw-bold @error('participantes') is-invalid border-warning @enderror" 
                               name="participantes" id="participantes" value="{{ old('participantes', isset($event) && $event->shelters->isNotEmpty() ? $event->shelters->first()->pivot->participantes : 0) }}" required>
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
