<?php
session_start();
if(isset($_SESSION['correo']) ){
$BD = mysqli_connect("localhost", "id3061678_danelopez", "mibasededatos","id3061678_quiz")or die("Error: No se pudo conectar");
$pregunta = "SELECT * from preguntas"; 
$result= mysqli_query($BD,$pregunta); 
mysqli_close($BD);
$Correo=$_SESSION['correo'];
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title> Insertar Pregunta </title>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
		<script>
function verPreguntas(str) {
	ocultar(str);
	var tabla;
	var tabla = document.getElementById("ver");
	if (tabla.style.display != "none") {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				var table= xhttp.responseText;
				document.getElementById("ver").innerHTML = table;
			}
		};
	xhttp.open("GET", "conseguirPregunta.php?Pregunta="+str, true);
	xhttp.send();
	} else {
		tabla.style.display = "";
	}  
}

function eliminarPregunta() {
		var str = document.getElementById("id").value;
		$.ajax({
                url:   'eliminarPregunta.php?Pregunta='+str,
                type:  'get',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
						document.getElementById("id").options.length = 0;
                        $("#resultado").html(response);
						location.href="layout_prof.php";
                }
        });
}
function ocultar(str){

	var boton = document.getElementById("eliminar");
	
	if (boton.style.display == "none") {
		boton.style.display = "block";
		}  
}
		</script>
		</head>
		<body>
		<form method="Post" action="validarPregunta.php">
			<div id='login'> 
				<p> Seleccionar pregunta:
					<SELECT NAME="id" id="id" SIZE=1 onchange="verPreguntas(this.value)"> 
						<option>Selecciona una pregunta... </option>
							<?php while ($fila=$result->fetch_object()){ ?>
								<option value="<?php echo $fila->pregunta?>">
									<?php echo $fila->pregunta?>
								</option>
							<?php }?>
					</SELECT> 
				</p>
				<table>
				<table border=1> <tr> <th> Correo </th> <th> Pregunta </th> <th> Respuesta </th> <th> Tema </th> <th> Complejidad </th></tr>
				<tr  id="ver"></tr>
				<tr>
				<td> Correo: <input type="text" id="Correo" name="Correo" disabled></p>
				</td>
				<td>Pregunta:<input type="text" id="Pregunta" name="Pregunta"></p>
				</td>
				<td>Respuesta: <input type="text" id="Respuesta" name="Respuesta"></p>
				</td>
				<td>Tema: <input type="text" id="Tema" name="Tema"></p>
				</td>
				<td>Complejidad: <input type="text" id="Complejidad" name="Complejidad"></p>
				<tr>
				</table>
				<input type="submit" id="boton" value="Actualizar"></p>
				
			</div>
		</form>
		<input type="button" id="eliminar" value="eliminar" onclick="eliminarPregunta()" style="display: none"></p>
	<span><a href='layout_prof.php'>Inicio</a></spam>
	<span id="resultado"></span>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>

	</body>
</html>
<?php }else{
header("Location:layout_prof.php");
}?>
