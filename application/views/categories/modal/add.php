
<script src="<?php echo site_url("assets/dist/js/form.bootstrap.js"); ?>"></script>
<?php
$action = "add";
$id = null;
$desc = "";
$code = "";

if($categories){
    $action = "edit";
    $id = $categories->cat_id;
    $code = $categories->cat_code;
    $desc = $categories->cat_description;
}

?>
<form method="post" id="add-procurement-form" action="<?php echo site_url('categories/saveCategory'); ?>">

    <div class="form-group col-md-12">
        <label>Code</label>
        <input class="form-control input-lg" name="code" type="text" placeholder="Code" value="<?php echo $code; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>Description</label>
        <textarea name="description" class="textarea form-control" placeholder="Description text here" rows="4"><?php echo $desc; ?></textarea>
    </div>


    <div class="clearfix"></div>

    <input type="hidden" name="action" value="<?php echo $action; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="parent_grid" value="#grid_users">
    <input type="hidden" name="reload_grid" value="">
    <input type="hidden" name="type" value="users">
    <!--<input type="hidden" name="close_after_save" value="true">-->
</form>