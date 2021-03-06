@extends('layouts.admin')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
@endpush
@section('content_header')
    
@endsection
@section('content')
<categories-component
:img="'{{ asset('imgs/icono_libro.png') }}'"
:labels="{{ json_encode([
    'name' => __("Nombre"),
    'created_at' => __("Fecha de Registro"),
    'options' => __("Opciones"),
    'edit' => __("Editar"),
]) }}"
route="{{ route('categories.json') }}"></categories-component>
@endsection