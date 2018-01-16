
	<?php  

	//expresiones regulares 
	$no_vacio ="/^\s*$/"; //para campos obligatorios
	$form_pregunta ="/^[\s\S]{10,50}$/"; //pregunta minimo 20
	$form_correo ="/^[a-z]+\d{3}@ikasle\.ehu\.(es|eus)$/"; 
 
	if(preg_match($no_vacio,$_POST['correo']) || preg_match($no_vacio,$_POST['pregunta']) || preg_match($no_vacio,$_POST['correcta']) 
	|| preg_match($no_vacio,$_POST['incorrecta1'])  || preg_match($no_vacio,$_POST['incorrecta2'])  || preg_match($no_vacio,$_POST['incorrecta3']) || preg_match($no_vacio,$_POST['incorrecta3']) || preg_match($no_vacio,$_POST['tema']) || preg_match($no_vacio,$_POST['complejidad'])) 
	{ 
		echo "Error en los datos"; 	

    }
	else if (!preg_match($form_correo,$_POST['correo']) || !preg_match($form_pregunta,$_POST['pregunta'])) 
	{ 
		echo "Error en los datos"; 	

    } 
	else{
	
		// Se conecta al SGBD 
		$iden = mysqli_connect("localhost", "id3061678_danelopez", "mibasededatos","id3061678_quiz")or die("Error: No se pudo conectar");
  		echo '<script language="javascript">alert("juas");</script>'; 
		//comprobamos que hayamos pasado la imagen
		if (!isset($_FILES["archivo"]) || $_FILES["archivo"]["error"] > 0)
		{
			
		$destino="fotos/image_not_found.png";
		}else
			
		{
		$foto=$_FILES["archivo"]["name"];
		$ruta=$_FILES["archivo"]["tmp_name"];
		$destino="fotos/".$foto;
		copy($ruta,$destino);
		
		}
			
		$tabla="SELECT * FROM preguntas";
		$Numero = mysqli_num_rows(mysqli_query($iden,$tabla));
		$Numero=$Numero +1;
			//sentencia a ejecutar
			$sql="INSERT INTO preguntas VALUES ('$Numero','$_POST[correo]','$_POST[pregunta]','$_POST[correcta]','$_POST[incorrecta1]','$_POST[incorrecta2]','$_POST[incorrecta3]','$_POST[tema]','$_POST[complejidad]','$destino')";
				if (!mysqli_query($iden ,$sql))
					{
					die('Error: ' . mysqli_error($iden));
					}
					
	mysqli_close($iden);
		
	$xml = simplexml_load_file('preguntas.xml');
		$assessmentItem=$xml->addChild('assessmentItem');
		$assessmentItem->addAttribute('complexity',$_POST['complejidad']);
		$assessmentItem->addAttribute('subject',$_POST['tema']);
		$assessmentItem->addAttribute('author',$_POST['correo']);
		
		$itemBody=$assessmentItem->addChild('itemBody');
		$p=$itemBody->addChild('p',$_POST['pregunta']);
		
		$correctResponse=$assessmentItem->addChild('correctResponse'); 
		$value=$correctResponse->addChild('value',$_POST['correcta']); 
		
		$incorrectResponses=$assessmentItem->addChild('incorrectResponses'); 
		$value=$incorrectResponses->addChild('value',$_POST['incorrecta1']); 
		$value=$incorrectResponses->addChild('value',$_POST['incorrecta2']); 
		$value=$incorrectResponses->addChild('value',$_POST['incorrecta3']); 
		
		$xml->asXML('preguntas.xml');

		echo "Pregunta añadida";
		//}
	?>

