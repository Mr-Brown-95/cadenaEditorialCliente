@extends('layouts.plantillabase')

@section('contenido')
    <h1>Editar Sucursal</h1>

    <form action="/branches/{{}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <!-- <label for=id"" class="form-label">Código</label> -->
            <input id="id" name="id" type="hidden" class="form-control" value="{{}}" tabindex="1" required>
        </div>
        <div class="mb-3">
            <label for="codigo_sucursal_id" class="form-label">Dirección</label>
            <input id="codigo_sucursal_id" name="codigo_sucursal_id" type="text" class="form-control" value="{{}}" tabindex="2" required>
        </div>
        <div class="mb-3">
            <label for="numero_registro_id" class="form-label">Ciudad</label>
            <input id="numero_registro_id" name="numero_registro_id" type="text" class="form-control" value="{{}}" tabindex="3" required>
        </div>
        <a href="/branche_magazines" class="btn btn-secondary" tabindex="7">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="8">Guardar</button>
    </form>
@endsection
