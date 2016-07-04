
<script src="<?php echo site_url("assets/dist/js/form.bootstrap.js"); ?>"></script>
<?php
$action = "add";
$id = null;
$business_name = "";
$first_name = "";
$middle_name = "";
$last_name ="";
$ext_name ="";

if($users){
    $action = "edit";
    $id = $users->u_id;
    $business_name = $users->u_username;
    $first_name = $users->u_firstname;
    $middle_name = $users->u_middlename;
    $last_name = $users->u_lastname;
    $ext_name = $users->u_extname;
}

?>
<form method="post" id="add-procurement-form" action="<?php echo site_url('suppliers/saveSupplier'); ?>">

    <div class="form-group col-md-12">
        <label>Username</label>
        <input class="form-control input-lg" name="u_username" type="text" placeholder="Business Name" value="<?php echo $business_name; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>First Name</label>
        <input class="form-control input-lg" name="u_firstname" type="text" placeholder="First Name" value="<?php echo $first_name; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>Middle Name</label>
        <input class="form-control input-lg" name="u_middlename" type="text" placeholder="Middle Name" value="<?php echo $middle_name; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>Last Name</label>
        <input class="form-control input-lg" name="u_lastname" type="text" placeholder="Last Name" value="<?php echo $last_name; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>Ext Name</label>
        <input class="form-control input-lg" name="u_extname" type="text" placeholder="JR." value="<?php echo $ext_name; ?>" />
    </div>


    <div class="clearfix"></div>

    <input type="hidden" name="action" value="<?php echo $action; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="parent_grid" value="#grid_users">
    <input type="hidden" name="reload_grid" value="">
    <input type="hidden" name="type" value="users">
    <!--<input type="hidden" name="close_after_save" value="true">-->
</form>