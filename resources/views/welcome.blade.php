<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Liwru</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    </head>
    <body>
        <main class="container-fluid">
            <div class="row">
                <div class="col-md-7 fondo">
                    <!-- Just an image -->
                    <nav class="navbar navegacion">
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('imgs/logo_biblioteca2.png') }}" width="50" height="50" alt="">
                            <span>BIBLIOTECA PÚBLICA IGNACIO ESCUDERO</span>    
                        </a>
                    </nav>
                    <div class="title">
                        <div class="titulo">
                            <h2>La forma más fácil de intercambiar tus libros</h2>
                            <p>Encuentra miles de títulos y sube tus favoritos</p>
                            <img src="{{ asset('imgs/open-book.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>
                   
                    
                </div>
                <div class="col-md-5 liwru">
                    <img src="{{ asset('imgs/logo.png') }}" class="img-fluid" alt="">
                    <ul class="pasos">
                        <li class="paso">
                            <div class="number">1 </div> 
                            <div class="texto">
                                Selecciona "Subir Libro"
                            </div> 
                        </li>
                        <li class="paso">
                            <div class="number">2 </div> 
                            <div class="texto">
                                Escribe la información requerida
                            </div>
                            
                        </li>
                        <li class="paso">
                            <div class="number">3 </div> 
                            <div class="texto">
                                Click en continuar y ¡listo!
                            </div> 
                        </li>
                        <li class="paso">
                            <a href="{{ route('login') }}" class="boton hecho bloque">Ingresar</a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </main>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        
    </body>
</html>
