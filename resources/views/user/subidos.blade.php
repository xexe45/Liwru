@extends('layouts.admin')
@section('title', 'Libros Subidos')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pinterest.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
@endpush
@section('content_header')
    <div class="no-image">
        <img src="{{ asset('imgs/user.png') }}" width="100px" class="img-fluid img-thumbnail ima" alt="">
    </div>
    <div class="datos-usuario">
        <h4 class="perfil-h3">Perfil de Usuario</h4>
        <div class="nombre-usuario">
            <h2>{{ auth()->user()->name }}</h2>
        </div>
        
    </div>
@endsection
@section('content')
<div class="informacion-subida">
    <p class="parrafo-info">LIBROS SUBIDOS</p>
    
    <div class="btn-group" role="group" aria-label="...">
        <a href="/perfil/libros-subidos" class="btn btn-default"><i class="fa fa-image" aria-hidden="true"></i></a>
        <a href="/perfil/libros-subidos?type=tabla" class="btn btn-default"><i class="fa fa-table" aria-hidden="true"></i></a>
    </div>
    
</div>
<div class="container-fluid coleccion">
        
        @if ($type == 'image')
            <div class="row">
                <div class="col-md-5 col-md-offset-3">
                        @forelse ($libros->chunk(3) as $chunk)
                        <div class="row coleccion-fila">
                            @foreach ($chunk as $book)
                                <div class="col-md-4 text-center mb-2">
                                    <img src="{{ $book->path }}" alt="" class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                        @empty
                            <p>No se han publicado libros</p>
                        @endforelse
                </div>
            </div>
            
        @elseif ($type == 'tabla')
            <div class="row">
                <div class="col-md-12">
                        
                                <table id="myTable" class="display compact responsive ">
                                    <thead>
                                        <tr>
                                            <th>ISBN</th>
                                            <th>TÍTULO</th>
                                            <th>IMAGEN</th>
                                            <th>LIWRU CODE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($libros as $libro)
                                            <tr>
                                                <td>{{ $libro->isbn }}</td>
                                                <td>{{ $libro->title }}</td>
                                                <td>
                                                    <img src="{{ $libro->path }}" alt="" class="img-fluid">
                                                </td>
                                                <td>{{ $libro->liwru_code }}</td>
                                            </tr>
                                        @empty
                                            
                                        @endforelse
                                    </tbody>
                                </table>
                            
                </div>
            </div>
            
        @endif
  
    </div>

@endsection
@push('scripts')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                responsive: true
            });
        } );
</script>
@endpush