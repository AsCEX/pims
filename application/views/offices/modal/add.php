
<script src="<?php echo site_url("assets/dist/js/form.bootstrap.js"); ?>"></script>
<?php
$action = "add";
$id = null;
$name = "";
$code = "";
$initial = "";

if($offices){
    $action = "edit";
    $id = $offices->ofc_id;
    $code = $offices->ofc_code;
    $initial = $offices->ofc_initial;
    $name = $offices->ofc_name;
}

?>
<form method="post" id="add-procurement-form" action="<?php echo site_url('offices/saveOffice'); ?>">

    <div class="form-group col-md-12">
        <label>Code</label>
        <input class="form-control input-lg" name="code" type="text" placeholder="Code" value="<?php echo $code; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>Initial</label>
        <input class="form-control input-lg" name="initial" type="text" placeholder="Name" value="<?php echo $initial; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>Name</label>
        <input class="form-control input-lg" name="name" type="text" placeholder="Name" value="<?php echo $name; ?>" />
    </div>


    <div class="clearfix"></div>

    <input type="hidden" name="action" value="<?php echo $action; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="parent_grid" value="#grid_users">
    <input type="hidden" name="reload_grid" value="">
    <input type="hidden" name="type" value="users">
    <!--<input type="hidden" name="close_after_save" value="true">-->
</form>