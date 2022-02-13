<?php
if(!isset($_GET["page"]))
{
    $_GET["page"] = 1;
}
$limit = 3;
$numberOfPages = ceil(totalNumberOfPosts($conn) / $limit);
?>

<ul class="pagination">
    <li class="page-item"><a class="page-link text-dark" href="?id=1&page=1">First</a></li>
    <li class="page-item <?php if($_GET["page"] <= 1){ echo 'disabled'; } ?>">
        <a class="page-link text-dark" href="<?php if($_GET["page"] <= 1){ echo '#'; } else { echo "?id=1&page=".($_GET["page"] - 1); } ?>">Prev</a>
    </li>
    <li class="page-item <?php if($_GET["page"] >= $numberOfPages){ echo 'disabled'; } ?>">
        <a class="page-link text-dark" href="<?php if($_GET["page"] >= $numberOfPages){ echo '#'; } else { echo "?id=1&page=".($_GET["page"] + 1); } ?>">Next</a>
    </li>
    <li class="page-item"><a class="page-link text-dark" href="?id=1&page=<?php echo $numberOfPages; ?>">Last</a></li>
</ul>