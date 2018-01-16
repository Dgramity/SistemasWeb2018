<?php
session_start();
if(isset($_SESSION['correo'])){
?>
<!DOCTYPE html>
<script>
function vista_previa(input) {
 if (input.files && input.files[0]) {
	var reader = new FileReader();
	reader.readAsDataURL(input.files[0]);
	reader.onload = function (e) {
		$('#prev_imagen').append('<img src="'+e.target.result+'" width="150" height="150"/>');
		}
	}
}
function insertarPregunta(){
xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState==4){
				document.getElementById("insertar").innerHTML=xmlhttp.responseText;
			}
		}
			xmlhttp.open("POST","InsertarPregunta.php",true);
			xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	
			xmlhttp.send('&correo='+document.getElementById('correo').value 
			+ '&pregunta='+document.getElementById('pregunta').value 
			+ '&correcta='+document.getElementById('correcta').value 
			+ '&incorrecta1='+document.getElementById('incorrecta1').value 
			+ '&incorrecta2='+document.getElementById('incorrecta2').value 
			+ '&incorrecta3='+document.getElementById('incorrecta3').value 
			+ '&tema='+document.getElementById('tema').value 
			+ '&complejidad='+document.getElementById('complejidad').value 
			+ '&archivo='+document.getElementById('archivo').value);
		}
		
function verPreguntas() {
	var tabla;
	var tabla = document.getElementById("ver");
	if (tabla.style.display != "none") {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				crearTabla(xhttp);
			}
		};
	xhttp.open("GET", "preguntas.xml", true);
	xhttp.send();
	} else {
		tabla.style.display = "";
	}  
}
function crearTabla(xml) {
  var i;
  var xmlDoc = xml.responseXML;
  var table="<tr><th>enunciado</th><th>tema</th><th>complejidad</th></tr>";
  var tema_compl = xmlDoc.getElementsByTagName("assessmentItems");
  var xml = xmlDoc.getElementsByTagName("assessmentItem");
  for (i = 0; i < xml.length; i++) { 
    table += "<tr><td>" +
    tema_compl[0].getElementsByTagName("p")[i].childNodes[0].nodeValue +
    "</td><td>" +
    tema_compl[0].getElementsByTagName("assessmentItem")[i].getAttribute("subject") +
    "</td><td>" +
    tema_compl[0].getElementsByTagName("assessmentItem")[i].getAttribute("complexity") +
    "</td></tr>";
  }
  document.getElementById("ver").innerHTML = table;
}
function ocultar(){
var tabla;
var tabla = document.getElementById("ver");
if (tabla.style.display != "none") {
	tabla.style.display = "none";
	} else {
	tabla.style.display = "none";
	}  
}
</script>
<html>
<head>
  <style>
table,th,td {
  border : 1px solid black;
  border-collapse: collapse;
}
th,td {
  padding: 5px;
}
table#ver {
    width: 100%;    
    background-color: #f1f1c1;
}
</style>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
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
		<span><a href='layout_usu.php'>Inicio</a></spam>
	</nav>
    <section class="main" id="s1">
    <div class="alert-danger"   id="alerta" style="display:none";>
    <strong>Error!</strong> Complete todas las casillas marcadas con *. </div>
	<div class="alert-danger"   id="alerta1" style="display:none";>
    <strong>Error!</strong> Pregunta demasiado breve (min 20). </div>
	<div class="alert-danger"   id="alerta2" style="display:none";>
    <strong>Error!</strong> El formato del correo es incorrecto. </div>
	
	<div>
	
	<form  method='post' id='registro' name='registro' action='InsertarPregunta.php' enctype="multipart/form-data" >

    <div>
        Direccion de correo(*):<br><input type="text" name="correo" id="correo"/>
    </div>
    <div>
        Pregunta(*):<br><input type="text" name="pregunta" id="pregunta"/>
    </div>
    <div>
        Respuesta correcta(*):<br><input type="text" name="correcta" id="correcta"/>
    </div>
    <div>
        Respuesta incorrecta 1(*):<br><input type="text" name="incorrecta1" id="incorrecta1"/>
    </div>
	<div>
        Respuesta incorrecta 2(*):<br><input type="text" name="incorrecta2" id="incorrecta2"/>
    </div>
	<div>
        Respuesta incorrecta 3(*):<br><input type="text" name="incorrecta3" id="incorrecta3"/>
    </div>
	<div>
        Tema de la pregunta (*):<br><input type="text" name="tema" id="tema"/>
    </div>
	<div>
		
		Complejidad:<select id="complejidad" name="complejidad">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select>
	</div>

	<input type="file" name="archivo" id="archivo"/><br />
	<div id="prev_imagen"> 
	</div>
	<div>
		<br /><input type="button" value="Registrar pregunta" id="boton_insertar" onClick="insertarPregunta()">
	</div>
	</form>
	<div  id="insertar">
      
    </div>
	<br /><br />
	 <div>
       <input type="button" value="Ver preguntas" id="boton_ver" onClick="verPreguntas()">
	   <table id="ver"></table>
	   <input type="button" value="Ocultar preguntas" id="boton_ocultar" onClick="ocultar()">
    </div>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
<script> 

$('#botonX').click(function() { 
    //valores de los input 
var correo=$('#correo').val(); 
var pregunta=$('#pregunta').val();
var correcta=$('#correcta').val();
var incorrecta1=$('#incorrecta1').val();
var incorrecta2=$('#incorrecta2').val();
var incorrecta3=$('#incorrecta3').val();
var tema=$('#tema').val();
var complejidad=$('#complejidad').val();
	//expresiones regulares 
var val_no_vacio=/^\s*$/ //para campos obligatorios
var val_pregunta=/^[\s\S]{10,50}$/ //pregunta minimo 20
var val_correo=/^[a-z]+\d{3}@ikasle\.ehu\.(es|eus)$/; 
 
    if (correo.match(val_no_vacio) || pregunta.match(val_no_vacio) || correcta.match(val_no_vacio)  
	|| incorrecta1.match(val_no_vacio)  || incorrecta2.match(val_no_vacio)  || incorrecta3.match(val_no_vacio)) { 
	document.getElementById("alerta").style.display = 'block';
	return false;	
    }
	else document.getElementById("alerta").style.display = 'none';
	
	if (!correo.match(val_correo)) 
	{ 
	document.getElementById("alerta2").style.display = 'block';	
	return false;
    } 
	else 
	document.getElementById("alerta2").style.display = 'none';
	
	
	if (!pregunta.match(val_pregunta)) 
	{ 
	document.getElementById("alerta1").style.display = 'block';
	return false;
		
    }
	else document.getElementById("alerta1").style.display = 'none'; 

	return true;
}); 
$("#archivo").change(function () {
 vista_previa(this);
});

</script>
</script> 
</body>
</html>
<?php
}
?>