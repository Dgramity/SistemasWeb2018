<?php
session_start();
if(isset($_SESSION['correo'])){
?>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right">
		<img src="<?php echo $_SESSION['imagen']?>" width="50" height="50">
		Bienvenido : <?php echo $_SESSION['nick']?> !!
		<br>
		<a href="logout.php">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout_prof.php'>Inicio</a></spam>
		<span><a href='revisarPreguntas.php'>Revisar pregunta</a></spam>
		<span><a href='VerPreguntasXml.php'>Ver preguntas XML</a></spam>
		<span><a href='VerPreguntas.php'>Ver preguntas BD</a></spam>
	</nav>
    <section class="main" id="s1">
    
	<div>
	<?php
	$iden = mysqli_connect("localhost", "id3061678_danelopez", "mibasededatos","id3061678_quiz")or die("Error: No se pudo conectar");

	
	$buscarPregunta = "SELECT * FROM preguntas"; 
	$result = mysqli_query($iden,$buscarPregunta);  

	echo '<table border=1> <tr> <th> Numero </th> <th> Autor </th> <th> Pregunta </th> <th> Respuesta </th> <th> Respuesta_1 </th> <th> Respuesta_2 </th> <th> Respuesta_3 </th> <th> Tema </th> <th> Complejidad </th>  <th> Imagen </th>
	</tr>';
	while ($row = mysqli_fetch_array( $result )) {	
	echo '<tr><td>' . $row[0] . '</td> <td>' . $row[1] . '</td> <td>' . $row[2] . '</td> <td>' . $row[3] . '</td> <td>' . $row[4] . '</td> <td>' . $row[5] . '</td> <td>' . $row[6] . '</td> <td>' . $row[7] . '</td> 
	<td>' . $row[8] . '</td> <td> <img src="'.$row[9].'" width="100" heigth="100"> </td> 
	</tr>';
	}
echo '</table>';
mysqli_close($iden);

?>

	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
<?php
}
?>