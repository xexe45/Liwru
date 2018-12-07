@extends('layouts.admin')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/token-input-facebook.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
@endpush
@section('content_header')
    
        <div class="no-image">
            <img id="clickImage" src="{{ asset('imgs/no_image.png') }}" width="100px" class="img-fluid img-thumbnail ima" alt="">
            <input type="file" id="file" name="file" class="elegir">
        </div>
        <div class="datos">
            <h2>Título del libro</h2>
            <input type="text" name="title" id="title" class="input-material" autofocus>
        </div>
    
    
@endsection
@section('content')
    <div class="informacion">
        <p class="parrafo-info">Escribe la información básica de tu libro</p>
    </div>
    <div class="formulario-subir">
            
                    <div class="col-md-6">
                            <div class="form-group row">
                                    <label for="autor" class="col-sm-3 col-form-label lable">Liwru Code*:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="liwru_code" name="liwru_code" placeholder="Código Liwru">
                                            <span class="input-group-btn">
                                                <button id="buscar" class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                                            </span>
                                           
                                        </div>
                                        <small>Si el libro que tienes para intercambiar contiene su liwru code, ingrésalo aquí!</small>
                                    </div>
                                </div>
                            <div class="form-group row">
                                <label for="autor" class="col-sm-3 col-form-label lable">Autor *:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="autor" name="autor" placeholder="Nombre del Autor">
                                    <small>¿No encuentras algún autor de tu libro? <a id="newA" href="#">Agrégalo aquí</a></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="isbn" class="col-sm-3 col-form-label lable">ISBN *:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN del libro">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="autor" class="col-sm-3 col-form-label lable">Categorías *:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="category" name="category" placeholder="Categoría">
                                        <small>¿No encuentras alguna categoría de tu libro? <a id="newC" href="#">Agrégala aquí</a></small>
                                    </div>
                                </div>
                            <div class="form-group row">
                                <label for="condicion" class="col-sm-3 col-form-label lable2">Condición *:</label>
                                <div class="col-sm-9">           
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" checked type="radio" name="condicion" value="NUEVO">
                                            <label class="form-check-label lable3" for="inlineRadio1">Nuevo</label>
                                                
                                            <input class="form-check-input" type="radio" name="condicion" value="SEMINUEVO">
                                            <label class="form-check-label lable3" for="inlineRadio1">Seminuevo</label>
                                                
                                            <input class="form-check-input" type="radio" name="condicion" value="VIEJO">
                                            <label class="form-check-label lable3" for="inlineRadio1">Viejo</label>
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción que te ayudará a conseguir un intercambio más rápido"></textarea>
                            </div>
                            <div class="form-group text-right">
                                <i id="cargando" class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                                <button type="button" class="boton hecho" id="guardar">Continuar</button>
                            </div>
       
                    </div>
            
            
    </div>
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header fondo">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Libro encontrado</h4>
      </div>
      <div class="modal-body text-center">
        <h3 id="titulo-encontrado"></h3>
        <img id="imagen-encontrado" src="" alt="">
        <p>ISBN: <span id="isbn-encontrado"></span></p>
        <form action="{{ route('books.user.new') }}" id="frm-encontrado">
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="frm-encontrado" class="btn fondo">Guardar!</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/jquery.tokeninput.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script>

        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Referencias
            const botonGuardar = $('#guardar');
            const liwru_code = $('#liwru_code')
            $('#cargando').hide();

            //Buscar liwru code
            $('#buscar').on('click', function(){
                const code = liwru_code.val();
                
                if(code == ''){
                    swal("Ooops","Ingrese el código liwru a buscar", 'warning');
                    return;
                }

                $.get(`/search/codes/${code}`, function(response){
                    if(!response.ok){
                        swal("Ooops","No se encontró un libro con ese código :(",'warning');
                        return;
                    }
                    console.log(response);
                    $('#titulo-encontrado').text(response['book']['title']);
                    $('#imagen-encontrado').attr('src',response['book']['pathUrl']);
                    $('#isbn-encontrado').text(response['book']['isbn']);
                    $('#id_encontrado').val(response['book']['id']);
                    $('#myModal').modal();
                }, 'json')

            });

            //Registrar libro encontrado
            $('#frm-encontrado').on('submit', function(e){
                e.preventDefault();
                let action = $(this).attr('action')
                let data = $(this).serialize();
                $.ajax({
                    url:  action,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                        
                        if(!response['ok']){
                            if(response['estado'] == 1){
                                swal('Oooops!', `${response['message']}, puede que el lector haya olvidado actualizar el estado del libro, le notificaremos para que realice esta acción, lo sentimos!`,'warning')
                                return;
                            }else{
                                swal('Oooops!', response['message'],'danger')
                                return;
                            }
                        }

                        swal('Liwru Informa', response['message'],'success');
                        $('#myModal').modal('hide');

                    },
                    error: function(xhr, textStatus, errorThrown ){
                        let errors = xhr.responseJSON.errors;
                        console.log(errors);
                        let r = [];
                        if(errors.id_encontrado){
                            r.push(errors.id_encontrado[0]);
                        }
                        if(errors.condicion_encontrado){
                            r.push(errors.condicion_encontrado[0]);
                        }
                        if(errors.descripcion_encontrado){
                            r.push(errors.descripcion_encontrado[0]);
                        }
                        let mensaje = r.join("<p></p>");
                        swal('Ooops', mensaje, 'error');
                    }

                });
            });
            
            //Nuevos Elementos
            $('#newA').on('click', function(e){
                e.preventDefault();
                swal({
                    title: 'Ingresa el nombre del autor',
                    input: 'text',
                    inputAttributes: {
                      autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        const author = {
                            name: login
                        };
                        return fetch("{{ route('authors.new') }}",{
                            method : 'post',
                            body: JSON.stringify(author),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                              }
                            return response.json()
                        })
                        .catch(error => {
                            console.log(error);
                            swal.showValidationMessage(
                            `No se pudo registrar el autor`
                            )
                        })
                    },
                    allowOutsideClick: () => !swal.isLoading()
                  }).then((result) => {
                    if (result.value) {
                        swal({
                            title: `${result.value.name} se registró correctamente`,
                          })
                    }
                  })
            });

            $('#newC').on('click', function(e){
                e.preventDefault();
                swal({
                    title: 'Ingresa el nombre de la categoría',
                    input: 'text',
                    inputAttributes: {
                      autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        const category = {
                            name: login
                        };
                        return fetch("{{ route('categories.new') }}",{
                            method : 'post',
                            body: JSON.stringify(category),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                              }
                            return response.json()
                        })
                        .catch(error => {
                            console.log(error);
                            swal.showValidationMessage(
                            `No se pudo registrar la categoría`
                            )
                        })
                    },
                    allowOutsideClick: () => !swal.isLoading()
                  }).then((result) => {
                    if (result.value) {
                        swal({
                            title: `${result.value.name} se registró correctamente`,
                          })
                    }
                  })
            });

            //TokenInput
            $("#autor").tokenInput("{{ route('books.search') }}",{
                theme: "facebook"
            });

            $("#category").tokenInput("{{ route('categories.search') }}",{
                theme: "facebook"
            });

            

            //Acciones
            botonGuardar.on('click', function(){
                const formData = new FormData();
                formData.append('autor_id',$('#autor').val());
                formData.append('isbn', $('#isbn').val());
                formData.append('title', $('#title').val());
                formData.append('category_id', $('#category').val());
                formData.append('condicion', $('input[name="condicion"]:checked').val());
                formData.append('imagen', $('input[type=file]')[0].files[0]);
                formData.append('descripcion', $('#descripcion').val());
                
                $.ajax({
                    url:  "{{ route('books.new') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function(){
                        $('#cargando').show();
                    },
                    success: function(data){
                        console.log(data);
                        $('#cargando').hide();
                        swal('Correcto', `${data['title']} registrado correctamente`, 'success' );
                        reset();
                        
                    },
                    error: function(xhr, textStatus, errorThrown ){
                        $('#cargando').hide();
                        let errors = xhr.responseJSON.errors;
                        console.log(errors);
                        let r = [];
                        if(errors.autor_id){
                            r.push(errors.autor_id[0]);
                        }
                        if(errors.category_id){
                            r.push(errors.category_id[0]);
                        }
                        if(errors.descripcion){
                            r.push(errors.descripcion[0]);
                        }
                        if(errors.imagen){
                            r.push(errors.imagen[0]);
                        }
                        if(errors.isbn){
                            r.push(errors.isbn[0]);
                        }
                        if(errors.title){
                            r.push(errors.title[0]);
                        }
                        if(errors.condicion){
                            r.push(errors.condicion[0]);
                        }
                        let mensaje = r.join("<p></p>");
                        swal('Ooops', mensaje, 'error');
                    }
                });
            })

            /*Evento click imagen*/
            document.getElementById("clickImage").addEventListener("click", function(){
                document.getElementById('file').click();
            });
            
            /*Cambiar imagen al seleccionar*/
            document.getElementById('file').addEventListener('change', function(){
                console.log(this.files[0]);
                var reader = new FileReader();
                reader.readAsDataURL(this.files[0]);
                reader.onload = function () {
                    document.getElementById("clickImage").src = reader.result;
                };
                
            })
        })

        function reset(){
            $("#autor").tokenInput("clear");
            $("#category").tokenInput("clear");
            $('#isbn').val("");
            $('#title').val("");
            $('#category').val("");
            $('input[name="condicion"]').prop({checked: false});
            $('#file').val("");
            $('#descripcion').val("");
            document.getElementById("clickImage").src = "{{ asset('imgs/no_image.png') }}";
        }
        

</script>
@endpush