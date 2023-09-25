@extends('layout')

@section('title', 'Editar cita')

@section('content')

<main>
    <div class="container py-4">
        <h2>Editar cita</h2>

        @if ($errors->any())

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        <form action="{{ url('appointments/'.$appointment->id) }}" method="post">

            @method("PUT")
            @csrf

            <div class="mb-3 row">
                <label for="date" class="col-sm-2 col-form-label">Fecha de cita</label>
                <div class="col-sm-5">
                    <input type="datetime-local" class="form-control" name="date" id="date" min="{{$now}}" value="{{ $appointment->date }}" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="duration" class="col-sm-2 col-form-label">Duración:</label>
                <div class="col-sm-5">
                    <select name="duration" id="duration" class="form-select" required>
                        <option value="">Seleccionar duración</option>
                        <option value="1" @if($appointment->duration == 1) {{'selected'}} @endif>1 hora</option>
                        <option value="2" @if($appointment->duration == 2) {{'selected'}} @endif>2 horas</option>
                    </select>
                </div>
            </div>
            <a href="{{ url('appointments') }}" class="btn btn-secondary">Regresar</a>

            <button type="submit" class="btn btn-success">Guardar</button>

        </form>
    </div>
</main>
@endsection