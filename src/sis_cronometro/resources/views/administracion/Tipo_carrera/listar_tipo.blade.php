@extends('principal')
@section('titulo')
    TIPO DE CARRERAS
@endsection
@section('contenido')
<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Listado Tipo</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive " style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listar_tipo as $lis)
                                            @if (strtotime($fecha_actual) <= strtotime($lis->fecha_realizacion))
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $lis->descripcion }}</td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ route('cc_carrera', ['id'=>encryp_rodry($lis->id)]) }}" class="btn btn-primary btn-sm shadow btn-xs sharp me-1" >
                                                                <i class="fa fa-eye"></i> Ingresar
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


