@extends('layouts.admin')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
@endpush
@section('content_header')
    <div class="no-image">
        <img id="clickImage" src="{{ asset('imgs/no_image.png') }}" width="100px" class="img-fluid img-thumbnail ima" alt="">
        <input type="file" id="file" name="file" class="elegir">
    </div>
    <div class="datos">
        <h2>Título del libro</h2>
        <input type="text" name="name" class="input-material" autofocus>
    </div>
@endsection
@section('content')
    <div class="informacion">
        <p class="parrafo-info">Escribe la información básica de tu libro</p>
    </div>
    <div class="formulario-subir">
            <div class="col-md-6">
                <form>
                    <div class="form-group row">
                        <label for="autor" class="col-sm-3 col-form-label lable">Autor *:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="autor" name="autor" placeholder="Nombre del Autor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="isbn" class="col-sm-3 col-form-label lable">ISBN *:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN del libro">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="condicion" class="col-sm-3 col-form-label lable2">Condición *:</label>
                        <div class="col-sm-9">           
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label lable3" for="inlineRadio1">Nuevo</label>
                                        
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label lable3" for="inlineRadio1">Seminuevo</label>
                                        
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label lable3" for="inlineRadio1">Viejo</label>
                                </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción que te ayudará a conseguir un intercambio más rápido"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="boton hecho">Continuar</button>
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