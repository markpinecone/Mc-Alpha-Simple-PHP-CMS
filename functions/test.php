<?php
require INCLUDE_DIR . '/dbh.inc.php';
require __DIR__ . '/edit_records.php';

$getAllRecordsQuery = "SELECT * FROM Users";
$result = $conn->query($getAllRecordsQuery);



if ($result->num_rows > 0) {
    echo '<table>';
    echo '
            <tr>
            <th>ID</th>
            <th>E-Mail</th>
            <th>Name</th>
            <th>Last name</th>
            <th>Role</th>
            <th>Registered at</th>
            <th>Edit</th>
            </tr>
            ';
    while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        echo
            "<tr>".
            '<td>' . $row["id"] . '</td>' .
            '<td>' . $row["email"] . '</td>' .
            '<td>' . $row["name"] . '</td>' .
            '<td>' . $row["lastname"] . '</td>' .
            '<td>' . $row["role"] . '</td>' .
            '<td>' . $row["registered"] . '</td>' .
            '<td>' . '<a  href="<?php editRecords({$id}) ?>">Edit</a></td>' .
            "</tr>";
    }
    echo '</table>';
} else {
    echo 'No results found!';

}
$conn->close();


