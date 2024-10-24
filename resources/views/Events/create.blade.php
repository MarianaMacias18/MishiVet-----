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
        <x-edit-component 
            :title="isset($event) ? 'Editar Evento' : 'Crear Evento'" 
            :action="isset($event) ? route('events.update', $event) : route('events.store')" 
            :method="isset($event) ? 'PUT' : 'POST'" 
            :submitText="isset($event) ? 'Actualizar' : 'Crear'" 
            :backRoute="route('events.index')"
            :deleteAction="isset($event) ? route('events.destroy', $event) : null">

            <div class="form-group">
                <label for="nombre">Nombre del Evento</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" value="{{ old('nombre', $event->nombre ?? '') }}" required>
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="datetime-local" class="form-control @error('fecha') is-invalid @enderror" name="fecha" id="fecha" value="{{ old('fecha', isset($event) ? $event->fecha->format('Y-m-d\TH:i') : '') }}" required>
                @error('fecha')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion" required>{{ old('descripcion', $event->descripcion ?? '') }}</textarea>
                @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="shelters">Refugios Asociados</label>
                <select multiple class="form-control @error('shelters') is-invalid @enderror" name="shelters[]" id="shelters">
                    @foreach($shelters as $shelter)
                        <option value="{{ $shelter->id }}" 
                            {{ isset($event) && $event->shelters->contains($shelter->id) ? 'selected' : ($loop->first ? 'selected' : '') }}>
                            {{ $shelter->nombre }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Nota: Puedes seleccionar a más de un refugio para participar en el evento.</small>
                @error('shelters')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="ubicacion">Ubicación del Evento</label>
                <input type="text" class="form-control @error('ubicacion') is-invalid @enderror" required name="ubicacion" id="ubicacion" value="{{ old('ubicacion', $event->pivot->ubicacion ?? '') }}">
                @error('ubicacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="participantes">Número de Participantes</label>
                <input type="number" class="form-control @error('participantes') is-invalid @enderror" required name="participantes" id="participantes" value="{{ old('participantes', $event->pivot->participantes ?? '') }}">
                <small class="form-text text-muted">Para crear un evento, debe haber un mínimo de 20 participantes.</small>
                @error('participantes')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </x-edit-component>
@endsection
