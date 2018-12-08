@extends('layouts.admin')
@section('title', 'Libros Subidos')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pinterest.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.dataTables.min.css') }}">
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
                    <table id="myTable" class="display responsive no-wrap">
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>TÍTULO</th>
                                <th>IMAGEN</th>
                                <th>LIWRU CODE</th>
                                <th>DESCRIPCIÓN</th>
                                <th>CONDICIÓN</th>
                                <th>ESTADO</th>
                                <th>OPCIONES</th>     
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
                                    <td>{{ $libro->pivot->description }}</td>
                                    <td>{{ $libro->pivot->condicion }}</td>
                                    <td>
                                        @if( $libro->pivot->status == 1 )
                                            <span class="label label-success">Disponible</span>
                                        @elseif ( $libro->pivot->status == 0 )
                                            <span class="label label-warning">Con solicitud de intercambio</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $libro->pivot->status == 1 )
                                            <button class="btn btn-info btn-sm" onclick="actualizar({{ $libro->pivot->id }})">Editar</button>
                                            <a class="btn btn-danger btn-sm mt-1" href="{{ route('books.pivot.delete', ['id' => $libro->pivot->id]) }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('form-delete').submit();"
                                         >
                                            <i class="fa fa-sign-out"></i>
                                             <span>{{ __("Borrar") }}</span>
                                         </a>
                                    
                                         <form id="form-delete" action="{{ route('books.pivot.delete', ['id' => $libro->pivot->id]) }}" method="POST" style="display: none;">
                                            @method('DELETE') 
                                            @csrf
                                         </form>
                                            
                                        @elseif ( $libro->pivot->status == 0 )
                                            <button class="btn btn-warning btn-sm">Ver solicitud de intercambio</button>
                                        @endif
                                        
                                        
                                    </td>
                                    
                                       
                                    
                                </tr>
                            @empty
                                            
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        @endif
  
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header fondo">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body text-center">
                  <h3 id="titulo-encontrado"></h3>
                  <img id="imagen-encontrado" src="" alt="">
                  <p>ISBN: <span id="isbn-encontrado"></span></p>
                  <form id="frm-encontrado">
                      <input type="hidden" id="id_encontrado" name="id_encontrado">
                      <div class="form-group">
                          <textarea placeholder="Descripción de te ayudará a conseguir un intercambio más rápido" name="descripcion_encontrado" class="form-control" id="descripcion_encontrado"></textarea>
                      </div>
                      <div class="form-group">    
                          <div class="form-check form-check-inline">
                              <input class="form-check-input" checked type="radio" name="condicion_encontrado" value="NUEVO">
                              <label class="form-check-label" for="inlineRadio1">Nuevo</label>
                                              
                              <input class="form-check-input" type="radio" name="condicion_encontrado" value="SEMINUEVO">
                              <label class="form-check-label" for="inlineRadio1">Seminuevo</label>
                                              
                              <input class="form-check-input" type="radio" name="condicion_encontrado" value="VIEJO">
                              <label class="form-check-label" for="inlineRadio1">Viejo</label>
                          </div>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-cancel">Cancelar</button>
                  <button type="submit" form="frm-encontrado" class="btn fondo">Guardar!</button>
                </div>
              </div>
            </div>
          </div>
@endsection
@push('scripts')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script>
    $(document).ready( function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#myTable').DataTable({
            responsive: true
        });

        $('#frm-encontrado').on('submit', function(e){
            e.preventDefault();
            const id = $('#id_encontrado').val();
            const url = `/books-pivot/${id}`;
            const data = $(this).serialize();
            $.ajax({
                url: url,
                data: data,
                type: 'PUT',
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    if(!response.ok){
                        swal("Ooops", reponse['message'] ,'warning');
                        return;
                    }

                    swal('Liwru Informa', response['message'], 'success');
                    location.reload();
                }
            });
        });


        $('#btn-cancel').on('click',function(){
            $('#myModalLabel').text("");
            $('#imagen-encontrado').attr('src',"");
            $('#isbn-encontrado').text("");
            $('#id_encontrado').val("");
            $('#descripcion_encontrado').val("");
        });
    });

    function actualizar(id)
    {
        $.ajax({
            url: `/books-pivot/${id}`,
            type: 'GET',
            data: {},
            dataType: 'json',
            success: function(response){
                console.log(response);
                $('#myModalLabel').text(response.title);
                $('#imagen-encontrado').attr('src',`/images/books/${response.picture}`);
                $('#isbn-encontrado').text(response.isbn);
                $('#id_encontrado').val(response.pivot.id);
                $('#descripcion_encontrado').val(response.pivot.description);
                $('input[value = "'+response.pivot.condicion+'" ]').prop("checked", true);
            }
        });
        $('#myModal').modal();
    }
</script>
@endpush