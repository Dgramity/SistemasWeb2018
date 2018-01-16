<?php
session_start();
if($_SESSION['tipo']=='1'){
	
	$original=$_POST['id'];
	$Correo=$_SESSION['correo'];
	$Pregunta=$_POST['Pregunta'];
	$Complejidad=$_POST['Complejidad'];
	$Respuesta=$_POST['Respuesta'];
	$Tema=$_POST['Tema'];
	
	
	 $BD = mysqli_connect("localhost", "id3061678_danelopez", "mibasededatos","id3061678_quiz")or die("Error: No se pudo conectar");
	 $buscarPregunta = "SELECT * FROM preguntas WHERE  pregunta='$original' "; 
	 $result = mysqli_query($BD,$buscarPregunta); 
	 $count = mysqli_num_rows($result);  

	if($count==0){
		?>
				<script> alert("Pregunta no actualizada"); location.href="RevisarPreguntas.php"</script> 
			<?php
	}else{
if($Complejidad > 0 && $Complejidad < 6){
		$update="UPDATE preguntas SET pregunta='$Pregunta',respuesta='$Respuesta' , Tema='$Tema', Complejidad='$Complejidad'  WHERE  pregunta='$original'";
		$result = mysqli_query($BD,$update); 
	
	if(!$xml = simplexml_load_file('preguntas.xml')){
		echo "No se ha podido cargar el archivo";
	} else {
		$xml = simplexml_load_file('preguntas.xml');
        foreach($xml as $assessmentItem){
           if($assessmentItem->itemBody->p == $original){
              $assessmentItem->itemBody->p=$Pregunta;
              $assessmentItem->correctResponse->value=$Respuesta;
              $assessmentItem['subject'] = $Tema;
			  $assessmentItem['complexity'] =$Complejidad;
           }
        }
	}	
	
	if (!$xml->asXML('preguntas.xml'))
	{
		throw new Exception($error);
	}
                        ?>
				<script> alert("Pregunta actualizada correctamente"); location.href="RevisarPreguntas.php"</script> 
			<?php
}else{
 ?>
				<script> alert("La complejidad tiene que ser un numero entre 1 y 5"); location.href="RevisarPreguntas.php"</script> 
			<?php
}
	}	
	mysqli_close($BD);	
	
}
?>