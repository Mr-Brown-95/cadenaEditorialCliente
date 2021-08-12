@extends('layouts.plantillabase')

@section('contenido')
    <h1>Editar Registros</h1>

    <form action="/magazines/{{$magazines->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <!-- <label for=id"" class="form-label">Código</label> -->
            <input id="id" name="id" type="hidden" class="form-control" value="{{$magazines->id}}" maxlength="50" tabindex="1" required>
        </div>
        <div class="mb-3">
            <label for="titulo" class="form-label">Titulo</label>
            <input id="titulo" name="titulo" type="text" class="form-control" value="{{$magazines->titulo}}" maxlength="50" tabindex="2" required>
        </div>
        <div class="mb-3">
            <label for="periodicidad" class="form-label">Periodicidad</label>
            <select class="form-select" id=periodicidad" name="periodicidad" value="{{$magazines->periodicidad}}" tabindex="3" required>
                <option selected>semanal</option>
                <option>mensual</option>
                <option>anual</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input id="tipo" name="tipo" type="text" class="form-control" value="{{$magazines->tipo}}" maxlength="100" tabindex="4" required>
        </div>
        <a href="/magazines" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
    </form>
@endsection
