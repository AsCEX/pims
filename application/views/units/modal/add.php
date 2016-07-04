
<script src="<?php echo site_url("assets/dist/js/form.bootstrap.js"); ?>"></script>
<?php
$action = "add";
$id = null;
$unit_name = "";

if($units){
    $action = "edit";
    $id = $units->unit_id;
    $unit_name = $units->unit_name;
}

?>
<form method="post" id="add-procurement-form" action="<?php echo site_url('units/saveUnit'); ?>">

    <div class="form-group col-md-12">
        <label>Unit Name</label>
        <input class="form-control input-lg" name="unit_name" type="text" placeholder="Name" value="<?php echo $unit_name; ?>" />
    </div>

    <div class="clearfix"></div>

    <input type="hidden" name="action" value="<?php echo $action; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="parent_grid" value="#grid_users">
    <input type="hidden" name="reload_grid" value="">
    <input type="hidden" name="type" value="users">
    <!--<input type="hidden" name="close_after_save" value="true">-->
</form>