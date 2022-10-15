<?php
require_once "actions/db_connect.php";

$sql = "SELECT * FROM animals WHERE hobbies LIKE '%".$_POST['name']."%'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    while ($row=mysqli_fetch_assoc($result)) {
        echo "  <tr>
                  <td>".$row['name']."</td>
                  <td>".$row['description']."</td>
                  <td>".$row['hobbies']."</td>
                  <td>".$row['size']."</td>
                </tr>";
    }
}

?>