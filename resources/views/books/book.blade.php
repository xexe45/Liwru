@extends('layouts.admin')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
@endpush
@section('content_header')
    <div class="no-image">
        <img src="{{ $data['book']->path }}" class="img-fluid img-thumbnail ima" alt="">
    </div>
    <div class="datos-usuario">
        <h2>{{ $data['book']->title }}</h2>
        <div class="nombre-usuario">
            <h4 class="quien-sube">{{ $data['user']->name }}</h4>
        </div>
        
    </div>
@endsection
@section('content')
    <div class="informacion">
        <p class="parrafo-info">Información Detallada por el lector</p>
    </div>
    <div class="row informacion-cambio">
        <div class="col-xs-4 col-md-4 text-center cambio">
            <img src="{{ asset('imgs/pen.png') }}" class="img-fluid" alt="">
            <h4>Autores</h4>
            @foreach ($data['book']->authors as $author)
                <span class="label label-default">{{ $author->name }}</span>
            @endforeach
        </div>
        <div class="col-xs-4 col-md-4 text-center cambio">
            <img src="{{ asset('imgs/bookshelf.png') }}" class="img-fluid" alt="">
            <h4>Categorías</h4>
            @foreach ($data['book']->categories as $category)
                <span class="label label-default">{{ $category->name }}</span>
            @endforeach
        </div>
        <div class="col-xs-4 col-md-4 text-center cambio">
            <img src="{{ asset('imgs/shield.png') }}" class="img-fluid" alt="">
            <h4>Estado</h4>
            @if($data['book_user']->condicion == 'NUEVO')
                <span class="label label-success">{{ $data['book_user']->condicion }}</span>
            @elseif($data['book_user']->condicion == 'SEMINUEVO')
                <span class="label label-warning">{{ $data['book_user']->condicion }}</span>
            @elseif($data['book_user']->condicion == 'VIEJO')
                <span class="label label-danger">{{ $data['book_user']->condicion }}</span>
            @endif
            
        </div>
        
    </div>
    <div class="row informacion-cambio">
        <div class="col-md-12 text-center">
            <div class="cambio">
                <img src="{{ asset('imgs/wishlist.png') }}" class="img-fluid" alt="">
                <h4>Condiciones del Lector</h4>
                <hr>
                <p>{{ $data['book_user']->description }}</p>
            </div>
                    
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group cambio">
                    <i id="cargando" class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                    <button type="button" class="boton hecho btn-block" id="guardar">
                        <i class="fa fa-exchange" aria-hidden="true"></i> Intercambiar
                    </button>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script>
        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $('#cargando').hide();

            $('#clickImage').on('click',function(){
                $('#file').click();
            });

            $('#file').on('change', function(){
                var reader = new FileReader();
                reader.readAsDataURL(this.files[0]);
                reader.onload = function () {
                    document.getElementById("clickImage").src = reader.result;
                };
            });
            
            $('#frm-user').on('click', function(){
                
               
                let formData = new FormData();
                
                formData.append('name',$('#name').val());
                formData.append('phone', $('#phone').val());
                formData.append('email', $('#email').val());
                formData.append('birthday', $('#birthday').val());
                formData.append('photo', $('input[type=file]')[0].files[0]);
                
               
                $.ajax({
                    url:  "{{ route('profile.update') }}",
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
                        swal('Correcto', `${data.message}`, 'success' );
                        reset(data.user);
                    },
                    error: function(xhr, textStatus, errorThrown ){
                        $('#cargando').hide();
                        let errors = xhr.responseJSON.errors;
                        console.log(errors);
                        let r = [];
                        if(errors.name){
                            r.push(errors.name[0]);
                        }
                        if(errors.phone){
                            r.push(errors.phone[0]);
                        }
                        if(errors.bithday){
                            r.push(errors.bithday[0]);
                        }
                        if(errors.email){
                            r.push(errors.email[0]);
                        }
                        if(errors.photo){
                            r.push(errors.photo[0]);
                        }
                        let mensaje = r.join("<p></p>");
                        swal('Ooops', mensaje, 'error');
                        
                    }
                });
                
            });
            
        });

        function reset(user){
            $("#name").val(user.name);
            $("#phone").val(user.phone);
            $('#email').val(user.email);
            $('#birthday').val(user.birthday);
            $('#file').val("");
            document.getElementById("clickImage").src = `/images/users/${user.picture}`;
        }
        /*
        document.getElementById("clickImage").addEventListener("click", function(){
            document.getElementById('file').click();
        });
        */
        /*
        document.getElementById('file').addEventListener('change', function(){
            console.log(this.files[0]);
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function () {
                document.getElementById("clickImage").src = reader.result;
            };
            
        })
        */

</script>
@endpush