<?php
// TODO Refactor This!!!
function displayUsersTable($conn) {
    $query = "SELECT * FROM Users";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        //pass
    } else {
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
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
        while ($row = mysqli_fetch_assoc($stmtResult)) {
            echo
                "<tr>" .
                '<td>' . $row["id"] . '</td>' .
                '<td>' . $row["email"] . '</td>' .
                '<td>' . $row["name"] . '</td>' .
                '<td>' . $row["lastname"] . '</td>' .
                '<td>' . $row["role"] . '</td>' .
                '<td>' . $row["registered"] . '</td>' .
                '<td>' . '<label class="notalink"><input type="submit" value="{$id}" class="invisibutton">
                        Edit</label>' .
                "</tr>";
        }
        echo '</table>';
        }
    mysqli_stmt_close($stmt);
}

function displayPagesTable($conn) {
    $query = "SELECT * FROM Pages";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        //pass
    } else {
        mysqli_stmt_execute($stmt);
        $stmtResult = mysqli_stmt_get_result($stmt);
        echo '<table>';
        echo '
            <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Priority</th>
            <th>Last update</th>
            <th>Edit</th>
            </tr>
            ';
        while ($row = mysqli_fetch_assoc($stmtResult)) {
            echo
                "<tr>" .
                '<td>' . $row["id"] . '</td>' .
                '<td>' . $row["title"] . '</td>' .
                '<td>' . $row["orderby"] . '</td>' .
                '<td>' . $row["edited"] . '</td>' .
                '<td>' . '<label class="notalink"><input type="submit" value="{$id}" class="invisibutton">
                        Edit</label>' .
                "</tr>";
        }
        echo '</table>';
    }
    mysqli_stmt_close($stmt);
}