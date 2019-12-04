@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-6">
    <h1 class="mt-1 ml-5">Pendientes</h1>
    <p class="ml-5">Registro de todos los cargos pendientes de retiro.</p>
  </div>
  <div class="col-4">
  <form role="search" action="{{url('/buscar')}}">
      <div class="form-group">
        <input type="text" placeholder="Buscar por N° Lote" class="form-control-md" name="search">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
      </div>
    </form>
  </div>
  <div class="col-2">
    <a href="{{route('exportar-pendientes')}}" class="btn btn-success">Descargar en Excel</a>
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
      <th scope="col">Fecha Salida</th>
      <th scope="col">Correo</th>
      <th scope="col">Observación</th>
      <th scope="col"></th>
      
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
        <td>{{$cargo->fecha_salida}}</td>
        <td>{{$cargo->correo}}</td>
        <td>{{$cargo->observacion}}</td>
        <td>
            @if(Auth::user()->role == 'ADMIN')
            <a href="#eliminarCargo{{$cargo->id}}" role="button" data-toggle="modal">
                <img src="{{ asset('img/delete.png') }}" height="25px">
            </a>
            @endif
            <!-- MODAL ELIMINAR CARGO  -->
            <div id="eliminarCargo{{$cargo->id}}" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                           <h4 class="modal-title">¿Estás seguro?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>¿Seguro quieres eliminar este cargo?</p>
                            <small>¡La información no podra recuperarse!</small>
                        <p class="text-danger">Lote n°:<small> {{$cargo->lote}}</small></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <a href="{{url('/delete-cargo/'.$cargo->id)}}" type="button" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN MODAL ELIMINAR CARGO  -->
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<div class="row">
  <div class="ml-5">
    {{$cargos->links()}}
  </div>
</div>



    


@endsection