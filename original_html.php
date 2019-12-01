<!DOCTYPE HTML>
<html lang="es">

<head>
    <title>Blog de Video Juegos</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>
    <!-- CABECERA -->
    <header id="cabecera">
        <!-- LOGO -->
        <div id="logo">
            <a href="index.php">
                Blog de Videos Juegos
            </a>
        </div>
        <!-- MENU DE NAVEGACION -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <li>
                    <a href="index.php">Categoria 1</a>
                </li>
                <li>
                    <a href="index.php">Categoria 2</a>
                </li>
                <li>
                    <a href="index.php">Categoria 3</a>
                </li>
                <li>
                    <a href="index.php">Categoria 4</a>
                </li>
                <li>
                    <a href="index.php">Sobre mi</a>
                </li>
                <li>
                    <a href="index.php">Contacto</a>
                </li>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>
    <div id="contenedor">
        <!-- BARRA LATERAL O SIDEBAR -->
        <aside id="sidebar">
            <div id="login" class="bloque">
                <h3>Identificate</h3>
                <form action="login.php"method="POST">
                    <label for="email">Email</label>
			        <input type="email" name="email" />

			        <label for="password">Contraseña</label>
			        <input type="password" name="password" />

			        <input type="submit" value="Entrar" />
                </form>
            <div>
            <div id="register" class="bloque">
                <h3>Registrate</h3>
                <form action="registro.php"method="POST">
                    <label for="nombre">Nombre</label>
			        <input type="text" name="nombre" />
			

			        <label for="apellidos">Apellidos</label>
			        <input type="text" name="apellidos" />
			

			        <label for="email">Email</label>
			        <input type="email" name="email" />
			

			        <label for="password">Contraseña</label>
			        <input type="password" name="password" />
			
			        <input type="submit" name="submit" value="Registrar" />
                </form>
            <div>
        </aside>

        <!-- CAJA PRINCIPAL -->
        <div id="principal">
            <h1>Ultimas Entradas</h1>
            <article class="entrada">
                <h2>Titulo de mi entrada</h2>
                <a href="">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pulvinar lorem eu magna scelerisque, sed porttitor lacus elementum.
                 Quisque bibendum, ante vel ornare vestibulum, tortor mi ultrices orci, vel consequat diam risus non nisl. 
                 </p>
                 </a>
            </article>      
            <article class="entrada">
                <h2>Titulo de mi entrada</h2>
                <a href="">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pulvinar lorem eu magna scelerisque, sed porttitor lacus elementum.
                 Quisque bibendum, ante vel ornare vestibulum, tortor mi ultrices orci, vel consequat diam risus non nisl. 
                 </p>
                 </a>
            </article>
            <article class="entrada">
                <h2>Titulo de mi entrada</h2>
                <a href="">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pulvinar lorem eu magna scelerisque, sed porttitor lacus elementum.
                 Quisque bibendum, ante vel ornare vestibulum, tortor mi ultrices orci, vel consequat diam risus non nisl. 
                 </p>
                 </a>
            </article>
            <article class="entrada">
                <h2>Titulo de mi entrada</h2>
                <a href="">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse pulvinar lorem eu magna scelerisque, sed porttitor lacus elementum.
                 Quisque bibendum, ante vel ornare vestibulum, tortor mi ultrices orci, vel consequat diam risus non nisl. 
                 </p>
                 </a>
            </article>

            <div id="ver-todas">
                <a href="">Ver Todas las Entradas</a>
            </div>            
                       
        </div> <!-- FIN  PRINCIPAL -->
        
        <div class="clearfix"></div>
    </div>

    <!-- PIE DE PAGINA O FOOTER -->
    <footer id="pie">
        <p>Desarrollado por Ing. Jorge Vega &copy; 2018</p>
    </footer>

</body>

</html>