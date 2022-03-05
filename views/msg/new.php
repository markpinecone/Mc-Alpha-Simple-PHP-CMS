<h3 class="mb-3">New Message</h3>
<form action="" method="post">
    To:
    <select name="receiver">
        <?php
        $selected_receiver = 0;
        if (isset($_GET["receiver"])) {
            $selected_receiver = $_GET["receiver"];
        }
        $sql = "SELECT id, display_name FROM Users;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $displayName = $row["display_name"];
                if ($id != $_SESSION["id"]) {
                    echo "<option value='$id'";
                    if ($id == $selected_receiver) {
                        echo " selected";
                    }
                    echo ">$displayName</option>";
                }
            }
        }
        ?>
    </select><br><br>
    <input type="text" name="subject" placeholder="Subject" size="40" required><br><br>
    <textarea rows="10" cols="40" name="content" placeholder="Enter message here.." required></textarea><br><br>
    <input class="btn btn-primary" type="submit" name="Send" value="Send">
</form>