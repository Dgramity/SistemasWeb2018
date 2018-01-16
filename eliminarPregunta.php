<?php
$Pregunta=$_GET['Pregunta'];

	 $BD = mysqli_connect("localhost", "id3061678_danelopez", "mibasededatos","id3061678_quiz")or die("Error: No se pudo conectar");
	 $buscarPregunta = "DELETE FROM preguntas WHERE pregunta='$Pregunta'"; 
	 if(mysqli_query($BD,$buscarPregunta)){
      echo "Pregunta eliminada";
   } else {
      echo "Error al eliminar la pregunta";
   }
 
mysqli_close($BD);

?>