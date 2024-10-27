@extends('layout')

@section('title', 'Donaciones')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Mis Donaciones</h2>

    @if ($donations->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No has recibido alguna donación aún.
        </div>
    @else
        <h3>Donaciones Realizadas</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Refugio Beneficiario</th>
                    <th>Terminación/Tarjeta</th>
                    <th>Método/Pago</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $donation)
                    <tr>
                        <td>{{ $donation->id }}</td>
                        <td>${{ number_format($donation->amount, 2) }}</td>
                        <td>{{ $donation->date->format('d/m/Y') }}</td>
                        <td>{{ optional($donation->beneficiaryShelter)->nombre }}</td>
                        <td>**** **** **** {{ $donation->numero_tarjeta }}</td>
                        <td>{{ $donation->payment_method }}</td>
                        <td>Completada</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <div class="col-md-6">
        <img src="{{ asset('img/donation.gif') }}" alt="Donaciones" >
    </div>
</div>
@endsection
