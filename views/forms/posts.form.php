<?php
if (!isset($_GET["edit"])) {
    echo '<h3>Add new post</h3>';
    $postid = null;
} else {
    echo '<h3>Edit post</h3>';
    if (!empty($_GET["edit"])) {
        $postid = (int) $_GET["edit"];
    }
}
?>
<form action="" method="post">
  <div class="form-group col-md-4 mb-3">
    <label for="Title" class="form-label">Title</label> 
	  <input class="form-control" type="text" id="Title" name="title" value="<?php
            echo fetchInputData('title', $postid, 'posts');
        ?>" required>
  </div>
  <div class="form-group col-md-4 mb-3">
  <label class="form-label" for="content">Content</label>
	<textarea class="form-control h-75 d-inline-block" id="content" name="content" placeholder="Add content here.."><?php
            echo fetchInputData('content', $postid, 'Posts');
        ?></textarea><br><br>
	<input type="submit" class="btn btn-secondary" 
		<?php echo(!isset($_GET["edit"]) ?
        'name="addpost" value="Add post">' :
        'name="updatepost" value="Update post">');
        ?> 
</form>
