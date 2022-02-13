<h3 class="mb-3">Update settings</h3>
<form action="" method="POST">
    <div class="form-group col-md-4 mb-3">
        <label class="form-label" for="value"><?php echo '<strong>Set '. fetchInputData('name', $_GET["edit"], 'Settings').'</strong>'; ?></label><input class="form-control" id="value" type="number" name="value" value="" required>
    </div>
    <input class="btn btn-secondary" type="submit" name="set" value="Update Settings">
</form>