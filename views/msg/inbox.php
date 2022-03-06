<?php
$id = (int) $_SESSION["id"];
?>
<h3 class="mb-3">
    Inbox
</h3>
<div class="container">
    <div class="row fw-bold bg-dark text-light">
        <div class="col">
            Date
        </div>
        <div class="col">
            From
        </div>
        <div class="col">
            Subject
        </div>
        <div class="col">
            Delete
        </div>
    </div>
    <?php
        $messages = getRecievedMessages($conn, $id);
        if($messages) {
            foreach ($messages as $message) {
                if ($message["has_been_read"] == 0) {
                    echo '<div class="row fw-bold" onclick="location.href='."'/index.php?action=messages&type=read&msg=".$message["id"]."'".'" style="cursor: pointer;">';
                } else {
                    echo '<div class="row" onclick="location.href='."'/index.php?action=messages&type=read&msg=".$message["id"]."'".'" style="cursor: pointer;">';
                }
                echo '<div class="col">';
                echo $message["timestamp"];
                echo '</div>';
                echo '<div class="col">';
                echo getDisplayName($conn, $message["from_id"]);
                echo "</div>";
                echo '<div class="col">';
                echo $message["subject"];
                echo "</div>";
                echo '<div class="col">';
                echo '<a href="/index.php?action=messages&type=inbox&msg='.$message["id"].'&delete=true"><i class="bi bi-trash-fill text-danger"></i></a>';
                echo "</div>";
                echo "</div>";
            }
        }
    ?>
</div>