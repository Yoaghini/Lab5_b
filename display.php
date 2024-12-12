<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_5b";  


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT matric, name, level FROM users";  
$result = $conn->query($sql);


echo "<h2>The User List</h2>";
echo "<table border='1'>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th> 
        </tr>";


if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        echo "<tr>
                <td>" . $row['matric'] ."</td>
                <td>" . $row['name'] ."</td>
                <td>" . $row['level'] ."</td>  
              </tr>";
    }
    echo "</table>";
} else 
{
    echo "No records found.";
}


$conn->close();
?>
