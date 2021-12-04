<?php
require INCLUDE_DIR . '/dbh.inc.php';

$sql = "SELECT * FROM Users";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo
            "<br>".
            $row["email"] . " " .
            $row["name"] . " " .
            $row["lastname"] . " " .
            $row["role"] . " " .
            $row["registered"] . "<br>";
    }
} else {
    echo 'No results found!';

}
$conn->close();


