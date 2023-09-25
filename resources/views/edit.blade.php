@extends('layout')
@section('title', 'Editar usuario')
@section('content')
    <div class="container">
        <div class="mt-5">
            @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
        </div>
        <form action="{{ url('update/') }}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
            @method("PUT")
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Edad</label>
                <input type="number" class="form-control" name="age" value="{{ $user->age }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Género</label>
                <select name="gender" class="form-select" required>
                    <option value="">Seleccionar género</option>
                    <option value="Masculino" @if($user->gender == 'Masculino') {{'selected'}} @endif>Masculino</option>
                    <option value="Femenino" @if($user->gender == 'Femenino') {{'selected'}} @endif>Femenino</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password">
            </div>
            <a href="{{ url('appointments') }}" class="btn btn-secondary">Regresar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection