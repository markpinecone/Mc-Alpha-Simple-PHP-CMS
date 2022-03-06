<?php
if (isset($_POST["Send"])) {
    $sender = $_SESSION["id"];
    $receiver = $_POST["receiver"];
    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $sql = "INSERT INTO Messages (from_id, to_id, subject, message)
	VALUES ('$sender', '$receiver', '$subject', '$content')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success text-center" role="alert">
                Message sent successfully!
              </div>';
    } else {
        echo '<div class="alert alert-danger text-center">Error while sending message: ' . $sql . "<br>" . $conn->error . "</div>";
    }

}

if(isset($_GET["msg"]))
{
    $msg = (int) $_GET["msg"];
    $sql = "UPDATE Messages SET has_been_read=1 WHERE id={$msg};";
    $conn->query($sql);
}

if(isset($_GET["msg"]) && $_GET["delete"] && $_GET["type"] == 'inbox')
{
    $msg = (int) $_GET["msg"];
    $sql = "UPDATE Messages SET deleted_to=1 WHERE id={$msg};";
    $conn->query($sql);
}

if(isset($_GET["msg"]) && $_GET["delete"] && $_GET["type"] == 'sent')
{
    $msg = (int) $_GET["msg"];
    $sql = "UPDATE Messages SET deleted_from=1 WHERE id={$msg};";
    $conn->query($sql);
}
