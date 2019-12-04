@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CARGAR INFORMACIÓN A BASE DE DATOS | <small>Sube un archivo CSV valido</small></div>

                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success" role="alert">
                         {{ session('message') }}
                        </div>
                    @endif
        

               
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-success">Importar Cargos</button>
                    <a href="{{route('enviar-correos')}}" class="btn btn-primary">Enviar Correo a Nuevos Destinatarios</a>
                    </form>
                 


                </div>
            </div>

            
        </div>
    </div>
    @if($vencidos != 0)
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="alert alert-danger" role="alert">
            Existen <b>{{$vencidos}}</b> cargos fuera de plazo, favor tomar acción.
            <a href="{{route('vencidos')}}" class="btn btn-danger float-right"><b>TOMAR ACCIÓN </b></a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
