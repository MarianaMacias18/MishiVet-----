@extends('layout')

@section('title', 'Donaciones')

@section('content')
<div class="container mt-5">
    @if ($donations->isEmpty())
        <div class="alert alert-info text-center shadow-sm p-3" role="alert">
            <strong>No has recibido alguna donación aún.</strong>
        </div>
    @else
        <div class="card border-0 shadow-lg mb-5">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="card-title m-0">DONACIONES RECIBIDAS</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered bg-white">
                    <thead class="thead-dark text-uppercase">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Monto</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Refugio Beneficiario</th>
                            <th class="text-center">Terminación Tarjeta</th>
                            <th class="text-center">Método de Pago</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donations as $donation)
                            <tr>
                                <td class="font-weight-bold text-center text-danger"><strong>{{ $donation->id }}</strong></td>
                                
                                <td class="text-center text-success font-weight-bold">
                                    <strong>${{ number_format($donation->amount, 2) }}</strong>
                                </td>
                                
                                <td class="text-center">{{ $donation->date->format('d/m/Y') }}</td>
                                <td class="text-center">{{ optional($donation->beneficiaryShelter)->nombre }}</td>
                                <td class="text-center text-dark font-weight-bold">
                                    **** **** **** <strong>{{ $donation->numero_tarjeta }}</strong>
                                </td>
                                <td class="text-center text-primary"><strong>{{ $donation->payment_method }}</strong></td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-success p-2 text-success">
                                        <strong> Completada</strong>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="text-center mt-5">
        <img src="{{ asset('img/donation.gif') }}" alt="Donaciones" 
             class="img-fluid rounded shadow-sm">
    </div>
</div>
@endsection
