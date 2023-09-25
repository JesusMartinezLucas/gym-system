@extends('layout')
@section('title', 'Registro')
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
        <form action="{{route('registration.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Edad</label>
                <input type="number" class="form-control" name="age" value="{{ old('age') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Género</label>
                <select name="gender" class="form-select" required>
                    <option value="">Seleccionar género</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection