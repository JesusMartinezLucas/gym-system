@extends('layout')

@section('title', 'Citas')

@section('content')

<main>
    <div class="container py-4">
        <h2>Listado de citas</h2>

        @if(!$isAdmin)
            <a href="{{ url('appointments/create') }}" class="btn btn-primary btn-sm">Nuevo registro</a>
        @endif

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Género</th>
                    <th>Fecha</th>
                    <th>Fin</th>
                    <th>Duración</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>   
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->id }}</td> 
                        <td>{{ $appointment->user->name }}</td> 
                        <td>{{ $appointment->user->last_name }}</td> 
                        <td>{{ $appointment->user->age }}</td> 
                        <td>{{ $appointment->user->gender }}</td> 
                        <td>{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y h:i A') }}</td> 
                        <td>{{ \Carbon\Carbon::parse($appointment->end_date)->format('d/m/Y h:i A') }}</td> 
                        <td>{{ $appointment->duration }}</td> 
                        <td><a href="{{ url('appointments/'.$appointment->id.'/edit') }}" class="btn btn-warning btn-sm">Editar</a></td> 
                        <td>
                            <form action="{{ url('appointments/'.$appointment->id) }}" method="post">
                                @method("DELETE")
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estás segur@?')">Eliminar</button>
                            </form>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $appointments->links() !!}
        </div>
    </div>
</main>
@endsection