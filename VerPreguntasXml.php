<?php
if(!$xml = simplexml_load_file('preguntas.xml')){
    echo "No se ha podido cargar el archivo";
} else {
	$num = 1;
    foreach ($xml as $assessmentItem){
		echo 'Pregunta numero: '.$num.'<br>';
        echo 'Enunciado: '.$assessmentItem->itemBody->p.'<br>';
		echo 'Tema: '.$assessmentItem['subject'] . "<br>";
		echo 'Complejidad: '.$assessmentItem['complexity'] . "<br>";
		echo '------------------<br> ';
		$num++;
    }
}

?>
