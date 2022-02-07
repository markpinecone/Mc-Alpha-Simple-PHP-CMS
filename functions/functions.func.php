<?php

function isLoggedIn()
{
    if (isset($_SESSION["login-status"])) {
        return true;
    } elseif (isset($_COOKIE["logged-in"])) {
        $_SESSION["login-status"] = true;
        $_SESSION["id"] = $_COOKIE["logged-in"];
        return true;
    }
    return false;
}

function isAdmin()
{
    if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
        return false;
    }
    return true;
}

function emptyInput($email, $name, $lastname, $password, $repeatPassword, $display_name)
{
    if (empty($email) || empty($name) || empty($lastname) || empty($password) || empty($repeatPassword) || empty($display_name)) {
        $empty = true;
    } else {
        $empty = false;
    }
    return $empty;
}

function emptyLoginInput($user, $password)
{
    if (empty($user) || empty($password)) {
        $empty = true;
    } else {
        $empty = false;
    }
    return $empty;
}

function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalid = true;
    } else {
        $invalid = false;
    }
    return $invalid;
}

function invalidName($name, $lastname)
{
    $regex = '/^[a-zA-Z]*$/';
    if (!preg_match($regex, $name) || !preg_match($regex, $lastname)) {
        $invalid = true;
    } else {
        $invalid = false;
    }
    return $invalid;
}

function passwordMatch($password, $repeat)
{
    if ($password === $repeat) {
        $match = true;
    } else {
        $match = false;
    }
    return $match;
}

function userExist($conn, $user)
{
    $emailQuery = "SELECT * FROM users WHERE email = ? OR display_name = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $emailQuery)) {
        header("location: /signup.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $user, $user);
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($stmtResult)) {
        mysqli_stmt_close($stmt);
        return $row;
    } else {
        $result = false;
        mysqli_stmt_close($stmt);
        return $result;
    }
}

function createUser($conn, $email, $pass, $name, $lastname, $display_name, $role)
{
    $userQuery = "INSERT INTO users (email, pass, name, lastname, display_name, role) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $userQuery)) {
        header("location: /signup.php?error=stmtfailure");
        exit();
    }
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssss", $email, $hashedPassword, $name, $lastname, $display_name, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /index.php?action=login&notify=usersuccess");
    exit();
}

function userLogin($conn, $user, $password, $remember)
{
    $userExists = userExist($conn, $user);
    if ($userExists === false) {
        header("location: /login.php?error=incorrect");
        exit();
    }
    $hashedPass = $userExists["pass"];
    $role = $userExists["role"];
    $id = $userExists["id"];
    $checkPass = password_verify($password, $hashedPass);
    if ($checkPass === false) {
        header("location: /login.php?error=incorrect");
        exit();
    }
    $_SESSION["id"] = $userExists["id"];
    $_SESSION["login-status"] = true;
    $_SESSION["role"] = $role;
    if ($remember) {
        setcookie("logged-in", $id, time() + (86400 * 30), "/");
    }
    header("location: /index.php");
    exit();
}

function getPages($conn)
{
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
        echo '<li class="nav-item"><a class="nav-link" href="index.php?id=' . $num . '">' . $title . '</a></li>';
    }
    mysqli_stmt_close($stmt);
}

function getContent($conn, $id)
{
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
        if ($row["title"] !== 'Blog') {
            echo "<h2>" . $row["title"] . "</h2>";
            echo '<p>' . $row["content"] . '</p>';
        } else {
            echo '<h2>'.$row["title"].'</h2>';
            getPosts($conn);
        }
    } else {
        require_once '../config/config.php';
        include VIEWS_DIR . '/404.view.php';
        exit();
    }
    mysqli_stmt_close($stmt);
}

function getPosts($conn) {
    $postsQuery = "SELECT id, title, content, timestamp FROM Posts ORDER BY timestamp DESC";
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
             // $num = (int)$row["id"];
            $title = $row["title"];
            $content = $row["content"];
            echo '<a class="text-decoration-none" href="/index.php?action=post&postid='.$row["id"].'"><h4 class="text-dark"><strong>'.$title.'</strong></h4></a>';
            echo '<h6 class=text-info>'.$row["timestamp"]. '<h6>';    
            echo '<p class="">'.substr($content, 0, 20).'...<p>';
        }
    }
    mysqli_stmt_close($stmt);
}


function getSinglePost($conn, $id) {
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

function getComments($conn, $postID)
{
    $id = (int) $postID;
    $commentsQuery = "SELECT Comments.content, Comments.timestamp, Users.display_name FROM Comments INNER JOIN Users ON Comments.author_id=Users.id WHERE post_id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $commentsQuery)) {
        header("location: /index.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($stmtResult) > 0) {
        while($row = mysqli_fetch_assoc($stmtResult)) {
            // $num = (int) $row["id"];
            echo '<h6 class="d-inline p-1 border border-3 border-primary bg-dark rounded text-white">'.$row["display_name"].'</h6>';
            echo '<h7 class="d-inline p-1 text-info">'.$row["timestamp"].'</h7>';    
            echo '<p class="mt-3 mb-3">'.$row["content"].'<p>';
        }
    }
    mysqli_stmt_close($stmt);
 
}


function createPage($conn, $title, $content, $order)
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

function createPost($conn, $title, $content)
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

function createComment($conn, $postID, $authorID, $content)
{
    $post = (int) $_GET["postid"];
    $createCommentQuery = "INSERT INTO Comments (post_id, author_id, content) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $createCommentQuery)) {
        header("location: /index.php?action=post&postid{$post}error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "iis", $postID, $authorID, $content);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /index.php?action=post&postid={$post}&notify=commentsuccess");
    exit();
}



function checkTableExists($conn, $table)
{
    $query = "SHOW TABLES LIKE '{$table}'";
    $stmt = mysqli_stmt_init($conn);
    $result = false;
    if (!mysqli_stmt_prepare($stmt, $query)) {
        // pass
    } else {
        mysqli_stmt_execute($stmt);
        $stmtResult = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($stmtResult) > 0) {
            $result = true;
        }
    }
    mysqli_stmt_close($stmt);
    return $result;
}

function countTableRows($conn, $table)
{
    $query = "SELECT * FROM {$table}";
    $stmt = mysqli_stmt_init($conn);
    $result = 0;
    if (!mysqli_stmt_prepare($stmt, $query)) {
        //pass
    } else {
        mysqli_stmt_execute($stmt);
        $stmtResult = mysqli_stmt_get_result($stmt);
        $result = mysqli_num_rows($stmtResult);
    }

    mysqli_stmt_close($stmt);
    return $result;
}

function deleteRow($conn, $page, $id, $table)
{
    $userQuery = "DELETE FROM {$table} WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);
    $page = strtolower($table);
    if (!mysqli_stmt_prepare($stmt, $userQuery)) {
        header("location: /admin/index.php?action={$page}&error=stmtfailed)");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function getDataRows($conn, $id, $table)
{
    // Fetches data from DB to be inserted in USER/PAGE update form
    $userQuery = "SELECT * FROM {$table} WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $userQuery)) {
        header("location: /signup.php?error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $stmtResult = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($stmtResult)) {
        return $row;
    }
    mysqli_stmt_close($stmt);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function updateUser($conn, $email, $name, $lastname, $role, $id)
{
    $userQuery = "UPDATE Users SET email=?, name=?, lastname=?, role=? WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $userQuery)) {
        header("location: /admin/index.php?action=users&edit={$id}&error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssi", $email, $name, $lastname, $role, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /admin/index.php?action=users&edit={$id}&notify=updatesuccess");
    exit();
}

function updatePage($conn, $title, $order, $content, $id)
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

function updatePost($conn, $title, $content, $id)
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



function fetchInputData($field, $id, $table)
{
    if (isAdmin() && isset($_GET["edit"])) {
        if ($id) {
            require INCLUDE_DIR . '/dbh.inc.php';
            $data = getDataRows($conn, $id, $table);
            return $data[$field];
        } else {
            header("location: /admin/index.php?action=pages&error=fetchfailure");
            exit();
        }
    } else {
        return (isset($_POST['$field']) ? $_POST['$field'] : '');
    }
}

