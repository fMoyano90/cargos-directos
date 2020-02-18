@extends('layouts.app')

@section('content')

<div id="historial" class="row">
        <div class="col-6">
          <h1 class="mt-1 ml-5">Historial</h1>
          <p class="ml-5">Registro de todos los cargos ingresados en el sistema.</p>
        </div>
        <div class="col-6">
          <form role="search" action="{{url('/buscar')}}">
            <div class="form-group">
              <input type="text" placeholder="Buscar por N° Lote" class="form-control-md" name="search">
              <button type="submit" class="btn btn-primary">
                  <i class="fas fa-search"></i>
              </button>
            </div>
          </form>
        </div>
        <div class="col-12">
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
               <tr v-for="cargo in cargos" v-bind:class="[cargo.stock_actual == 0 ? 'bg-success text-white' : cargo.vencimiento <= fecha_actual && cargo.stock_actual != 0 ? 'bg-danger text-white' : por_vencer >= cargo.vencimiento && fecha_actual < cargo.vencimiento ? 'bg-warning' : '']">
                <td>@{{cargo.lote}}</td>
                <td>@{{cargo.created_at}}</td>
                <td>@{{cargo.detalle}}</td>
                <td>@{{cargo.nro_contable}}</td>
                <td>@{{cargo.ubicacion}}</td>
                <td>@{{cargo.cantidad_stock}}</td>
                <td>@{{cargo.cantidad_salida}}</td>
                <td>@{{cargo.stock_actual}}</td>
                <td>@{{cargo.fecha_salida}}</td>
                <td>@{{cargo.correo}}</td>
                <td>@{{cargo.observacion}}</td>
                <td>
                    @if(Auth::user()->role == 'ADMIN')
                    <a v-bind:href="'#eliminarCargo'+cargo.id" role="button" data-toggle="modal">
                      <img src="{{ asset('img/delete.png') }}" height="25px">
                    </a>
                    @endif
                        <!-- MODAL ELIMINAR USUARIO  -->
                        <div v-bind:id="'eliminarCargo'+cargo.id" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                       <h4 class="modal-title">¿Estás seguro?</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Seguro quieres eliminar este cargo?</p>
                                    <p class="text-danger">Número de lote:<small> @{{cargo.lote}}</small></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <a v-bind:href="'delete-cargo/'+cargo.id" type="button" class="btn btn-danger">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FIN MODAL ELIMINAR USUARIO  -->
                    </td>
              </tr>
          </tbody>
        </table>
        </div>
  
        <div class="offset-4 col-4 align-items-center">
          <nav>
              <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                  <a class="page-link" href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Anterior</span>
                  </a>
                </li>
      
                <li v-for="page in pagesNumber" class="page-item" v-bind:class="[ page == isActived ? 'active' : '']" v-bind:key="page">
                  <a class="page-link" href="#" @click.prevent="changePage(page)">
                     @{{page}}
                  </a>
                </li>
           
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                  <a class="page-link" href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Siguiente</span>
                  </a>
                </li>
              </ul>
            </nav>
        </div>
        {{-- 
        <div class="offset-3 col-6 card">
            <pre>
                @{{$data}}
            </pre>
        </div>
        --}}
      </div>

@endsection