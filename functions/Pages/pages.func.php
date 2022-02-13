<?php

function updatePage($conn, $title, $order, $content, $id): void
{
    $userQuery = "UPDATE Pages SET title=?, `order`=?, content=? WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $userQuery)) {
        header("location: /admin/index.php?action=pages&edit={$id}&error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssi", $title, $order, $content, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /admin/index.php?action=pages&edit={$id}&notify=updatesuccess");
    exit();
}

function createPage($conn, $title, $content, $order): void
{
    $createPageQuery = "INSERT INTO Pages (title, content, `order`) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $createPageQuery)) {
        header("location: /admin/pages.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $order);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /admin/index.php?action=pages&notify=pagesuccess");
    exit();
}

function getAllPages($conn): void
{
    //Fetches all pages to be used in navbar.
    $home = getSetPage($conn, 'ID of Home page');
    $pagesQuery = "SELECT id, title FROM pages ORDER BY `order` ASC";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $pagesQuery)) {
        header("location: /index.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($stmtResult)) {
        $num = (int)$row["id"];
        $title = $row["title"];
        if ($num != $home) {
            echo '<li class="nav-item"><a class="nav-link" href="index.php?id=' . $num . '">' . $title . '</a></li>';
        }

    }
    mysqli_stmt_close($stmt);
}

function getContent($conn, $id): void
{
    $home = getSetPage($conn, 'ID of Home page');
    $blog = getSetPage($conn, 'ID of Blog page');
    $contentQuery = "SELECT * FROM pages WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $contentQuery)) {
        header("location: /index.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($stmtResult) == 1) {
        $row = mysqli_fetch_assoc($stmtResult);
        // TODO Refactor this shortcut.
        if ($row["id"] != $blog) {
            echo "<h2>" . $row["title"] . "</h2>";
            echo '<p>' . $row["content"] . '</p>';
        } elseif($row["id"] != $home) {
            echo '<h2>'.$row["title"].'</h2>';
            if(!isset($_GET["page"]))
            {
                $_GET["page"] = 1;
            }
            getPosts($conn, 3, (int) $_GET["page"]*3-3);
            include VIEWS_DIR . '/pagination.view.php';
        }
    } else {
        require_once '../config/config.php';
        include VIEWS_DIR . '/404.view.php';
        exit();
    }
    mysqli_stmt_close($stmt);
}

function getSetPage ($conn, $setting): int
{
    $setPageQuery = "SELECT value FROM Settings WHERE name = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $setPageQuery)) {
        header("location: /index.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $setting);
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return mysqli_fetch_array($stmtResult)["value"];
}