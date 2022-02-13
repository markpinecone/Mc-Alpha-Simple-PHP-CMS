<?php
if (isset($_GET["page"]))
{
    $comments = getComments($conn, $postid, $limit, $offset, False);
    echo '<h6 class=" text-info mb-3 mt-3">Comments<h6>';
    if (empty($comments)) {
        echo '<p class=" h6 lead mb-3">No comments found</p>';
    } else {
        for ($x = 0; $x <= sizeof($comments) - 1; $x++) {
            echo '<h6 class="d-inline p-1 border border-3 border-primary bg-dark rounded text-white">' . $comments[$x]["display_name"] . '</h6>';
            echo '<h7 class="d-inline p-1 text-info">' . $comments[$x]["timestamp"] . '</h7>';
            echo '<p class="mt-3 mb-3">' . $comments[$x]["content"] . '<p>';
        }
    }
}
