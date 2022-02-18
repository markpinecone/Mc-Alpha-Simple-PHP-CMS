<?php
if (isset($_GET["page"]))
{
    $comments = getComments($conn, $postid, $limit, $offset, False);
    echo '<h6 class=" text-info mb-3 mt-3">Comments</h6>';
    if (empty($comments)) {
        echo '<p class=" h6 lead mb-3">No comments found</p>';
    } else {
        for ($x = 0; $x <= sizeof($comments) - 1; $x++) {
            echo '<div class="container d-inline-flex mb-3">';
            echo '<div class="d-inline-flex float-start flex-column">';
            echo '<img style="max-width:50px !important;" class="img-fluid mb-1 img-thumbnail rounded-circle" src="/static/avatars/'. $comments[$x]["avatar"] .'">';
            echo '<h6 class="d-inline border border-3 border-primary bg-dark rounded text-white">' . $comments[$x]["display_name"] . '</h6>';
            echo '</div>';
            echo '<div class="d-flex flex-column w-50 px-3">';
            echo '<div class="flex-fill">';
            echo '<p>' . $comments[$x]["content"] . '<p>';
            echo '</div>';
            echo '<div>';
            echo '<h7 class="text-info">' . $comments[$x]["timestamp"] . '</h7>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
}
