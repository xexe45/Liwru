@extends('layouts.admin')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
@endpush
@section('content_header')
    <div class="no-image">
        <img id="clickImage" src="{{ asset('imgs/user.png') }}" width="100px" class="img-fluid img-thumbnail ima" alt="">
        <input type="file" id="file" name="file" class="elegir">
    </div>
    <div class="datos-usuario">
        <h2>Perfil de Usuario</h2>
        <div class="nombre-usuario">
            <input type="text" name="name" class="input-material" autofocus value="Nombre de Usuario">
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
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="isbn" class="col-sm-3 col-form-label lable">Número de Teléfono *:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="967088183">
                        
                    </div>
                </div>
                
                <div class="form-group text-right">
                    <button class="boton hecho">Guardar</button>
                </div>
                
            </form>
        </div>
</div>

@endsection
@push('scripts')
<script>
        document.getElementById("clickImage").addEventListener("click", function(){
            document.getElementById('file').click();
        });

        document.getElementById('file').addEventListener('change', function(){
            console.log(this.files[0]);
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function () {
                document.getElementById("clickImage").src = reader.result;
            };
            
        })

</script>
@endpush