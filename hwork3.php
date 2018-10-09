<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, descripcion, marca, tiene_rtv FROM vehiculos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo "Id" . "," . "Descripcion" . "," . "Marca" . "," . "Rtv" . "<br>";

 	$file2 = "tabla.csv";
    $headers = file_get_contents($file2);
    $headers .= "Id" . "," . "Descripcion" . "," . "Marca" . "," . "Rtv" . PHP_EOL ;
    file_put_contents($file2, $headers);

    while($row = $result->fetch_assoc()){
        echo $row["id"] . "," . $row["descripcion"] . "," . $row["marca"] . "," . $row["tiene_rtv"] . "<br>";

        $file = "tabla.csv";
        // Open the file to get existing content
        $current = file_get_contents($file);
        // Append a new person to the file
        $current .= $row["id"] . "," . $row["descripcion"] . "," . $row["marca"] . "," . $row["tiene_rtv"] . PHP_EOL;
        // Write the contents back to the file
        file_put_contents($file, $current);  
    }
} else {
    echo "0 results";
}
$conn->close();
?>