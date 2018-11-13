@extends('layouts.admin')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
@endpush
@section('content_header')
    
@endsection
@section('content')
    <users-component 
        :img="'{{ asset('imgs/icono_libro.png') }}'"
        :roles="{{ json_encode($roles) }}"
        :labels="{{ json_encode([
            'name' => __("Nombre"),
            'phone' => __("Teléfono"),
            'email' => __("Correo Electrónico"),
            'role' => __("Rol"),
            'picture' => __("Imagen"),
            'created_at' => __("Fecha de Registro")
        ]) }}"
        route="{{ route('users.json') }}">
    </users-component>
@endsection