@extends('layouts.admin')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
@endpush
@section('content_header')
    <div class="no-image">
        <img id="clickImage" src="{{ $user->pathAttachment() }}" width="100px" class="img-fluid img-thumbnail ima" alt="">
        <input type="file" id="file" name="file" class="elegir">
    </div>
    <div class="datos-usuario">
        <h2>Perfil de Usuario</h2>
        <div class="nombre-usuario">
            <input type="text" id="name" name="name" class="input-material" autofocus value="{{ $user->name }}">
            <div class="pencil"><i class="fa fa-pencil"></i></div>
        </div>
        
    </div>
@endsection
@section('content')
<div class="formulario-perfil">
        <div class="col-md-6">
            <form>
                <div class="form-group row">
                    <label for="autor" class="col-sm-3 col-form-label lable">Correo Electrónico *:</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="isbn" class="col-sm-3 col-form-label lable">Número de Teléfono *:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="isbn" class="col-sm-3 col-form-label lable">Fecha de Nacimiento *:</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $user->birthday }}">
                    </div>
                </div>
                
                <div class="form-group text-right">
                    <i id="cargando" class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                    <button type="button" id="frm-user" class="boton hecho">Guardar</button>
                </div>
                
            </form>
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
                
               
                const formData = new FormData();
                
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