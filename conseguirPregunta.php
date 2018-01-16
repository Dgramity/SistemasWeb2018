<?php
$Pregunta=$_GET['Pregunta'];

	 $BD = mysqli_connect("localhost", "id3061678_danelopez", "mibasededatos","id3061678_quiz")or die("Error: No se pudo conectar");
	 $buscarPregunta = "SELECT * FROM preguntas WHERE pregunta='$Pregunta'"; 
	 $result = mysqli_query($BD,$buscarPregunta); 
	

	while ($row = mysqli_fetch_array( $result )) {	
	echo '<tr><td>' . $row[1] . '</td><td>' . $row[2] . '</td><td>' . $row[3] . '</td><td>' . $row[7] . '</td><td>' . $row[8] . '</td></tr>';
	}
mysqli_close($BD);
?>
