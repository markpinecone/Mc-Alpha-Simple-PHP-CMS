<?php
$userID = (int) $_SESSION["id"];
$msgID = (int) $_GET["msg"];
$message = getSingleMessage($conn, $msgID);
if ($userID != $message["from_id"] && $userID != $message["to_id"])
{
    header('HTTP/1.0 403 Forbidden');
    exit();
}
?>

<h5 class="mt-3">From: <span class="fw-bold text-info"><?php echo getDisplayName($conn, $message["from_id"]);?><span></h5>
<h5>To: <span class="fw-bold text-info"><?php echo getDisplayName($conn, $message["to_id"]);?></span></h5>
<h5 class="mb-3">Message:</h5>
<?php
echo $message["message"];
