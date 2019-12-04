@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-6">
    <h1 class="mt-1 ml-5">Cargos fuera de plazo</h1>
    <p class="ml-5">Registro de todos los cargos que están fuera de plazo. !Favor tomar acción!</p>
  </div>
  <div class="offset-4 col-2">
      <a href="{{route('exportar-vencidos')}}" class="btn btn-success">Descargar en Excel</a>
  </div>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Lote</th>
      <th scope="col">Fecha de ingreso</th>
      <th scope="col">Detalle</th>
      <th scope="col">Número Contable</th>
      <th scope="col">Ubicación</th>
      <th scope="col">Stock Inicial</th>
      <th scope="col">Cantidad Salida</th>
      <th scope="col">Stock Actual</th>
      <th scope="col">Vencimiento</th>
      <th scope="col">Correo</th>
      <th scope="col">Observación</th>
      
    </tr>
  </thead>
  <tbody>
    @foreach ($cargos as $cargo)
      <tr>
        <td>{{$cargo->lote}}</td>
        <td>{{$cargo->created_at}}</td>
        <td>{{$cargo->detalle}}</td>
        <td>{{$cargo->nro_contable}}</td>
        <td>{{$cargo->ubicacion}}</td>
        <td>{{$cargo->cantidad_stock}}</td>
        <td>{{$cargo->cantidad_salida}}</td>
        <td>{{$cargo->stock_actual}}</td>
        <td>{{$cargo->vencimiento}}</td>
        <td>{{$cargo->correo}}</td>
        <td>{{$cargo->observacion}}</td>
      </tr>
    @endforeach
  </tbody>
</table>




    


@endsection