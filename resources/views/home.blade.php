@extends('layouts.admin')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
@endpush
@section('content_header')
    
    <div class="input-container">
        <i class="fa fa-search icon"></i>
        <input class="input-field" type="text" placeholder="Título, autor, usuario" name="buscar">
    </div>
    <div class="input-container">
        <i class="fa fa-user icon"></i>
        <select name="categoria" class="input-field" id="">
            <option value="1">Seleccionar Categoría</option>
        </select>
    </div>
@endsection
@section('content')
    <div class="descubrir">
        <h3><img src="{{ asset('imgs/icono_libro.png') }}"  class="img-fluid" alt="">DESCUBRIR CONTENIDO</h3>
        <a href="#" class="parrafo active">Libros de Usuarios</a>
        <a href="#" class="parrafo">Libros de la Biblioteca</a>
    </div>
    <div class="lista-libros">
        <div class="libro">
            <div class="imagen text-right">
                <img src="{{ asset('imgs/leer.jpg') }}"  width="50%" alt="" class="img-fluid">
            </div>
            <div class="texto">
                <p for=""><b>Título:</b></p>
                <p class="tp">Harry Potter</p>
                <p for=""><b>Autor:</b></p>
                <p class="tp">Juan Perez</p>
            </div> 
        </div>
        <div class="libro">
            <div class="imagen text-right">
                <img src="{{ asset('imgs/leer.jpg') }}" alt="" width="50%" class="img-fluid">
            </div>
            <div class="texto">
                <p for=""><b>Título:</b></p>
                <p class="tp">Harry Potter</p>
                <p for=""><b>Autor:</b></p>
                <p class="tp">Juan Perez</p>
            </div>
        </div>
        <div class="libro">
            <div class="imagen text-right">
                <img src="{{ asset('imgs/leer.jpg') }}" width="50%" alt="" class="img-fluid">
            </div>
            <div class="texto">
                <p for=""><b>Título:</b></p>
                <p class="tp">Harry Potter</p>
                <p for=""><b>Autor:</b></p>
                <p class="tp">Juan Perez</p>
            </div>
        </div>
        <div class="libro">
            <div class="imagen text-right">
                <img src="{{ asset('imgs/leer.jpg') }}" width="50%" alt="" class="img-fluid">
            </div>
            <div class="texto">
                <p for=""><b>Título:</b></p>
                <p class="tp">Harry Potter</p>
                <p for=""><b>Autor:</b></p>
                <p class="tp">Juan Perez</p>
            </div> 
        </div>
        <div class="libro">
            <div class="imagen text-right">
                <img src="{{ asset('imgs/leer.jpg') }}" width="50%" alt="" class="img-fluid">
            </div>
            <div class="texto">
                <p for=""><b>Título:</b></p>
                <p class="tp">Harry Potter</p>
                <p for=""><b>Autor:</b></p>
                <p class="tp">Juan Perez</p>
            </div> 
        </div>
        <div class="libro">
                <div class="imagen text-right">
                    <img src="{{ asset('imgs/leer.jpg') }}" width="50%" alt="" class="img-fluid">
                </div>
                <div class="texto">
                    <p for=""><b>Título:</b></p>
                    <p class="tp">Harry Potter</p>
                    <p for=""><b>Autor:</b></p>
                    <p class="tp">Juan Perez</p>
                </div> 
        </div>
    </div>
    <div class="paginacion">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
    </div>
    
@endsection