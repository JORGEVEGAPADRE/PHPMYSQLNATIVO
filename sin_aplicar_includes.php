<!--INICIO CABECERA -->
<?php #require_once 'conexion.php'; ?>
<?php
// Conexión
$servidor = 'localhost';
$usuario = 'root';
$password = '';
$basededatos = 'blog_master';
$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf8'");

// Iniciar la sesión
if(!isset($_SESSION)){
	session_start();
}
?>
<?php #require_once 'includes/helpers.php'; ?>
<?php

function mostrarError($errores, $campo){
	$alerta = '';
	if(isset($errores[$campo]) && !empty($campo)){
		$alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
	}
	
	return $alerta;
}

function borrarErrores(){
	$borrado = false;
	
	if(isset($_SESSION['errores'])){
		$_SESSION['errores'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['errores_entrada'])){
		$_SESSION['errores_entrada'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['completado'])){
		$_SESSION['completado'] = null;
		$borrado = true;
	}
	
	return $borrado;
}

function conseguirCategorias($conexion){
	$sql = "SELECT * FROM categorias ORDER BY id ASC;";
	$categorias = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($categorias && mysqli_num_rows($categorias) >= 1){
		$resultado = $categorias;
	}
	
	return $resultado;
}

function conseguirCategoria($conexion, $id){
	$sql = "SELECT * FROM categorias WHERE id = $id;";
	$categorias = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($categorias && mysqli_num_rows($categorias) >= 1){
		$resultado = mysqli_fetch_assoc($categorias);
	}
	
	return $resultado;
}

function conseguirEntrada($conexion, $id){
	$sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario"
		  . " FROM entradas e ".
		   "INNER JOIN categorias c ON e.categoria_id = c.id ".
		   "INNER JOIN usuarios u ON e.usuario_id = u.id ".
		   "WHERE e.id = $id";
	$entrada = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($entrada && mysqli_num_rows($entrada) >= 1){
		$resultado = mysqli_fetch_assoc($entrada);
	}
	
	return $resultado;
}

function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null){
	$sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
		 "INNER JOIN categorias c ON e.categoria_id = c.id ";
	
	if(!empty($categoria)){
		$sql .= "WHERE e.categoria_id = $categoria ";
	}
	
	if(!empty($busqueda)){
		$sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
	}
	
	$sql .= "ORDER BY e.id DESC ";
	
	if($limit){
		// $sql = $sql." LIMIT 4";
		$sql .= "LIMIT 4";
	}
	
	$entradas = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($entradas && mysqli_num_rows($entradas) >= 1){
		$resultado = $entradas;
	}
	
	return $entradas;
} ?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Blog de Videojuegos</title>
		<link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
	</head>
	<body>
		<!-- CABECERA -->
		<header id="cabecera">
			<!-- LOGO -->
			<div id="logo">
				<a href="index.php">
					Blog de Videojuegos
				</a>
			</div>
			
			<!-- MENU -->
			<nav id="menu">
				<ul>
					<li>
						<a href="index.php">Inicio</a>
					</li>
					<?php 
						$categorias = conseguirCategorias($db);
						if(!empty($categorias)):
							while($categoria = mysqli_fetch_assoc($categorias)): 
					?>
								<li>
									<a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a>
								</li>
					<?php
							endwhile;
						endif;
					?>
					<li>
						<a href="index.php">Sobre mí</a>
					</li>
					<li>
						<a href="index.php">Contacto</a>
					</li>
				</ul>
			</nav>
			
			<div class="clearfix"></div>
		</header>
		
		<div id="contenedor">  
            <div class="clearfix"></div>
		</div> <!-- fin contenedor -->
<!-- FIN CABECERA -->   

<!-- INICIO BARRA LATERAL SIDEBAR-->
<aside id="sidebar">
	
	<div id="buscador" class="bloque">
		<h3>Buscar</h3>

		<form action="buscar.php" method="POST"> 
			<input type="text" name="busqueda" />
			<input type="submit" value="Buscar" />
		</form>
	</div>
	
	<?php if(isset($_SESSION['usuario'])): ?>
		<div id="usuario-logueado" class="bloque">
			<h3>Bienvenido, <?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];?></h3>
			<!--botones-->
			<a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
			<a href="crear-categoria.php" class="boton">Crear categoria</a>
			<a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
			<a href="cerrar.php" class="boton boton-rojo">Cerrar sesión</a>
		</div>
	<?php endif; ?>
	
	<?php if(!isset($_SESSION['usuario'])): ?>
	<div id="login" class="bloque">
		<h3>Identificate</h3>
		
		<?php if(isset($_SESSION['error_login'])): ?>
			<div class="alerta alerta-error">
				<?=$_SESSION['error_login'];?>
			</div>
		<?php endif; ?>
		
		<form action="login.php" method="POST"> 
			<label for="email">Email</label>
			<input type="email" name="email" />

			<label for="password">Contraseña</label>
			<input type="password" name="password" />

			<input type="submit" value="Entrar" />
		</form>
	</div>

	<div id="register" class="bloque">
		<h3>Registrate</h3>
		
		<!-- Mostrar errores -->
		<?php if(isset($_SESSION['completado'])): ?>
			<div class="alerta alerta-exito">
				<?=$_SESSION['completado']?>
			</div>
		<?php elseif(isset($_SESSION['errores']['general'])): ?>
			<div class="alerta alerta-error">
				<?=$_SESSION['errores']['general']?>
			</div>
		<?php endif; ?>
		
		<form action="registro.php" method="POST"> 
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" />
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

			<label for="apellidos">Apellidos</label>
			<input type="text" name="apellidos" />
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

			<label for="email">Email</label>
			<input type="email" name="email" />
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

			<label for="password">Contraseña</label>
			<input type="password" name="password" />
			<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

			<input type="submit" name="submit" value="Registrar" />
		</form>
		<?php borrarErrores(); ?>
	</div>
	<?php endif; ?>
</aside>
<!-- FIN BARRA LATERAL SIDEBAR -->

<!-- INICIO CAJA PRINCIPAL -->
<div id="principal">
	<h1>Ultimas entradas</h1>
	
	<?php 
		$entradas = conseguirEntradas($db, true);
		if(!empty($entradas)):
			while($entrada = mysqli_fetch_assoc($entradas)):
	?>
				<article class="entrada">
					<a href="entrada.php?id=<?=$entrada['id']?>">
						<h2><?=$entrada['titulo']?></h2>						
						<span class="fecha"><?=$entrada['categoria'].' | '. date('d/m/Y', strtotime($entrada['fecha']))?></span>						
						<p>
							<?=substr($entrada['descripcion'], 0, 180)."..."?>
						</p>
					</a>
				</article>
	<?php
			endwhile;
		endif;
	?>

	<div id="ver-todas">
		<a href="entradas.php">Ver todas las entradas</a>
	</div>
</div> 
<!--FIN CAJA PRINCIPAL-->

<!-- INICIO PIE DE PÁGINA -->
		<footer id="pie">
			<p>Desarrollado por Ing. Jorge Vega &copy; 2018</p>
		</footer>
		
	</body>
</html>
<!-- FIN PIE DE PÁGINA -->

