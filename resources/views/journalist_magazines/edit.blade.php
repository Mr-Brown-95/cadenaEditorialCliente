@extends('layouts.plantillabase')

@section('contenido')
    <h1>Editar autor</h1>

    <form action="/journalist_magazines/{{}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <!-- <label for=id"" class="form-label">Código</label> -->
            <input id="id" name="id" type="hidden" class="form-control" value="{{}}" tabindex="1" required>
        </div>
        <div class="mb-3">
            <label for="numero_registro_id" class="form-label">Numero de Registro</label>
            <input id="numero_registro_id" name="numero_registro_id" type="text" class="form-control" value="{{}}" tabindex="2" required>
        </div>
        <div class="mb-3">
            <label for="periodista_id" class="form-label">Periodista</label>
            <input id="periodista_id" name="periodista_id" type="text" class="form-control" value="{{}}" tabindex="3" required>
        </div>
        <a href="/journalist_magazines" class="btn btn-secondary" tabindex="7">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="8">Guardar</button>
    </form>
@endsection
