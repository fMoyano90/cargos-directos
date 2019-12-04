@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Usuarios del sistema</h2>
    <p>Listado de usuarios activos en el sistema.</p>
    <table class="table">      
      <thead class="thead-light">
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Correo</th>
          <th scope="col">Rol</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      @foreach($usuarios as $usuario)
      <tbody>
        <tr>
          <td>{{$usuario->name}}</td>
          <td>{{$usuario->surname}}</td>
          <td>{{$usuario->email}}</td>

          <td>  
            <form method="post" action="{{route('actualizar-usuario', ['id' => $usuario->id])}}">
               @csrf
                <select id="role" name="role" >
                  <option class="text-light disabled">{{$usuario->role}}</option>
                  <option value="USER">USER</option>
                  <option value="ADMIN">ADMIN</option>
                </select>
                <button type="submit">
                  <img src="{{ asset('img/save.png') }}" height="25px">
                </button>
              </td>
              <td>
              </td>
          </form>
          <td>
            @if(Auth::user()->role == 'ADMIN')
            <a href="#eliminarUsuario{{$usuario->id}}" role="button" data-toggle="modal">
              <img src="{{ asset('img/delete.png') }}" height="25px">
            </a>
            @endif
            <!-- MODAL ELIMINAR USUARIO  -->
            <div id="eliminarUsuario{{$usuario->id}}" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                           <h4 class="modal-title">¿Estás seguro?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>¿Seguro quieres eliminar este usuario?</p>
                        <p class="text-danger"><small>{{$usuario->name}} {{$usuario->surname}}</small></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <a href="{{url('/delete-usuario/'.$usuario->id)}}" type="button" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN MODAL ELIMINAR USUARIO  -->
          </td>
        </tr>
      </tbody>
      @endforeach
    </table>
</div>

@endsection