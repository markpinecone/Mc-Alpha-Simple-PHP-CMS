<?php

function createComment($conn, $postID, $authorID, $content): void
{
    $post = (int) $_GET["postid"];
    $page = (int) $_GET["page"];
    $createCommentQuery = "INSERT INTO Comments (post_id, author_id, content) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $createCommentQuery)) {
        header("location: /index.php?action=post&postid{$post}error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "iis", $postID, $authorID, $content);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /index.php?action=post&postid={$post}&page={$page}&notify=commentsuccess");
    exit();
}


function createPost($conn, $title, $content): void
{
    $createPostQuery = "INSERT INTO Posts (title, content) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $createPostQuery)) {
        header("location: /admin/index.php?action=posts&error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $title, $content);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /admin/index.php?action=posts&notify=pagesuccess");
    exit();
}

function updatePost($conn, $title, $content, $id): void
{
    $postQuery = "UPDATE Posts SET title=?, content=? WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $postQuery)) {
        header("location: /admin/index.php?action=posts&edit={$id}&error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /admin/index.php?action=posts&edit={$id}&notify=updatesuccess");
    exit();
}

function totalNumberOfPosts($conn): int
{
    $contentQuery = "SELECT COUNT(*) FROM Posts;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $contentQuery)) {
        header("location: /index.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return (int) mysqli_fetch_array($result)[0];
}

function getPosts($conn, $limit, $offset): void
{
    $postsQuery = "SELECT id, title, content, timestamp FROM Posts ORDER BY timestamp DESC LIMIT {$offset},{$limit};";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $postsQuery)) {
        header("location: /index.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($stmtResult) == 0) {
        echo "Didn't find any posts..";
    } else {
        while ($row = mysqli_fetch_assoc($stmtResult)) {
            $title = $row["title"];
            $content = $row["content"];
            echo '<a class="text-decoration-none" href="/index.php?action=post&postid='.$row["id"].'&page=1"><h4 class="text-dark"><strong>'.$title.'</strong></h4></a>';
            echo '<h6 class=text-info>'.$row["timestamp"]. '<h6>';
            echo '<p class="">'.substr($content, 0, 20).'...</p>';
        }
    }
    mysqli_stmt_close($stmt);
}


function getSinglePost($conn, $id): void
{
    $id = (int) $id;
    $postsQuery = "SELECT id, title, content, timestamp FROM Posts WHERE id= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $postsQuery)) {
        header("location: /index.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($stmtResult) == 0) {
        echo "Post Not Found!";
    } else {
        $row = mysqli_fetch_assoc($stmtResult);
        // $num = (int) $row["id"];
        echo '<h3 class="text-dark mt-3"><strong>'.$row["title"].'</strong></h3>';
        echo '<h6 class=text-info>'.$row["timestamp"]. '<h6>';
        echo '<p class="mb-3">'.$row["content"].'<p>';
    }
    mysqli_stmt_close($stmt);
}

function getComments($conn, $postID, $limit, $offset, $countRows)
{
    $id = (int) $postID;
    if (!$countRows) {
        $commentsQuery = "SELECT Comments.content, Comments.timestamp, Users.display_name, Users.avatar FROM Comments INNER JOIN Users ON Comments.author_id=Users.id WHERE post_id=? and status='active' ORDER by Comments.timestamp DESC LIMIT {$offset},{$limit}";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $commentsQuery)) {
            header("location: /index.php?error=stmtfailure");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $stmtResult = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($stmtResult) > 0)
        {
            while($row = mysqli_fetch_array($stmtResult))
            {
                $comments[] = $row;

            }
            return $comments;

        }

    } else {
        $commentsQuery = "SELECT COUNT(*) id FROM Comments WHERE post_id= ? and status='active'";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $commentsQuery)) {
            header("location: /index.php?error=stmtfailure");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return (int)mysqli_fetch_array($result)["id"];
    }
}