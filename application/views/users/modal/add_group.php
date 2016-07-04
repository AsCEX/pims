
<script src="<?php echo site_url("assets/dist/js/form.bootstrap.js"); ?>"></script>
<?php
    $action = "add";
    $id = null;
    $name = "";
    $desc = "";
    if($groups){
        $action = "edit";
        $id = $groups->grp_id;
        $name = $groups->grp_name;
        $desc = $groups->grp_description;
    }

?>
<form method="post" id="add-procurement-form" action="<?php echo site_url('groups/saveGroup'); ?>">

    <div class="form-group col-md-12">
        <label>Group Name</label>
        <input class="form-control input-lg" name="name" type="text" placeholder="Name" value="<?php echo $name; ?>" />
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