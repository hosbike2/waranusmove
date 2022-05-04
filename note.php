<!--  sql select code -->
<?php
                    $sql = "SELECT model_id, FROM MyGuests";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                      echo '<option value="'.$row["model_id"].'">'.$.
                    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                      }
                    } else {
                        echo "0 results";
                    }

                    mysqli_close($conn);
?>