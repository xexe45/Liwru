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
    <div class="container-fluid coleccion">
        @forelse ($books->chunk(3) as $chunk)
            <div class="row coleccion-fila">
                @foreach ($chunk as $book)
                    <div class="col-md-4 fila-item">
                        <a href="{{ route('books.show', ['book' => $book->id]) }}">
                            <img src="{{ $book->path }}" alt="" class="img-fluid">
                        </a>
                        <div class="texto">
                            <p for=""><b>Título:</b></p>
                            <p class="tp">{{ $book->title }}</p>
                            <p for=""><b>Autores:</b></p>
                            @foreach($book->authors as $author)
                                <p class="tp">{{ $author->name }}</p>
                            @endforeach
                            
                            @foreach($book->categories as $category)
                                <span class="label label-default">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @empty
            <p>No se han publicado libros</p>
        @endforelse
        
        <div class="text-center">
            {{ $books->links() }}
        </div>
        
    </div>
    <!--<div class="lista-libros">
                    @forelse($books as $book)
                    <div class="libro">
                        
                        <a href="#"><img src="{{ $book->path }}" alt="" class="img-fluid"></a>
                        
                        <div class="texto">
                            <p for=""><b>Título:</b></p>
                            <p class="tp">{{ $book->title }}</p>
                            <p for=""><b>Autores:</b></p>
                            @foreach($book->authors as $author)
                                <p class="tp">{{ $author->name }}</p>
                            @endforeach
                            
                        </div> 
                    </div>
                    @empty
                        <p class="text-center">No se han registrado libros.</p>
                    @endforelse
    </div>-->
    
    
    
    
@endsection