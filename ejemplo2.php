<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$Numero=$_GET['Numero'];

	 $BD = mysqli_connect("localhost", "root", "","Quiz")or die("Error: No se pudo conectar");
	 $buscarPregunta = "SELECT * FROM preguntas WHERE Numero='$Numero'"; 
	 $result = mysqli_query($BD,$buscarPregunta); 
	 $count = mysqli_num_rows($result);  

echo "<table>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['Numero'] . "</td>";
    echo "<td>" . $row['correo'] . "</td>";
    echo "<td>" . $row['pregunta'] . "</td>";
    echo "<td>" . $row['respuesta'] . "</td>";
    echo "<td>" . $row['Tema'] . "</td>";
	echo "<td>" . $row['Complejidad'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($BD);
?>
</body>
</html>