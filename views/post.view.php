<?php
if(!isset($_GET["postid"])) {
    header('Location: /index.php');
    exit();
}

$page = (int) $_GET["page"];
$postid = (int) $_GET["postid"];
$limit = 5;
$numberOfPages = ceil(getComments($conn, $postid, $limit, 0, True) / $limit);
$offset = $page*$limit-$limit;

getSinglePost($conn, $postid);
require INCLUDE_DIR . '/comments.inc.php';
?>

<ul class="pagination">
    <li class="page-item"><a class="page-link text-dark" href="?action=post&postid=<?php echo $postid; ?>&page=1">First</a></li>
    <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
        <a class="page-link text-dark" href="<?php if($page <= 1){ echo '#'; } else { echo "?action=post&postid=".$postid."&page=".($page - 1); } ?>">Prev</a>
    </li>
    <li class="page-item <?php if($page >= $numberOfPages){ echo 'disabled'; } ?>">
        <a class="page-link text-dark" href="<?php if($page >= $numberOfPages){ echo '#'; } else { echo "?action=post&postid=".$postid."&page=".($page + 1); } ?>">Next</a>
    </li>
    <li class="page-item"><a class="page-link text-dark" href="?action=post&postid=<?php echo $postid; ?>&page=<?php echo $numberOfPages; ?>">Last</a></li>
</ul>


<?php
if (isLoggedIn()) {
    include FORMS_DIR . '/comments.form.php';
}
?>