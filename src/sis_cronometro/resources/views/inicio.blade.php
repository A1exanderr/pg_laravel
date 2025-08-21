@extends('principal')
@section('titulo')
    INICIO
@endsection
@section('contenido')
    <div class="container">
        <h3>Bievenido {{ Auth::user()->nombres }}</h3>
    </div>
@endsection
