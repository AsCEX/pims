
<script src="<?php echo site_url("assets/dist/js/form.bootstrap.js"); ?>"></script>
<?php
$action = "add";
$id = null;
$business_name = "";
$first_name = "";
$middle_name = "";
$last_name = "";
$ext_name = "";
$address = "";

if($suppliers){
    $action = "edit";
    $id = $suppliers->id;
    $business_name = $suppliers->business_name;
    $first_name = $suppliers->first_name;
    $middle_name = $suppliers->middle_name;
    $last_name = $suppliers->last_name;
    $ext_name = $suppliers->ext_name;
    $address = $suppliers->address;
}

?>
<form method="post" id="add-procurement-form" action="<?php echo site_url('suppliers/saveSupplier'); ?>">

    <div class="form-group col-md-12">
        <label>Business Name</label>
        <input class="form-control input-lg" name="business_name" type="text" placeholder="Business Name" value="<?php echo $business_name; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>First Name</label>
        <input class="form-control input-lg" name="first_name" type="text" placeholder="First Name" value="<?php echo $first_name; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>Middle Name</label>
        <input class="form-control input-lg" name="middle_name" type="text" placeholder="Middle Name" value="<?php echo $middle_name; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>Last Name</label>
        <input class="form-control input-lg" name="last_name" type="text" placeholder="Last Name" value="<?php echo $last_name; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>Ext Name</label>
        <input class="form-control input-lg" name="ext_name" type="text" placeholder="JR." value="<?php echo $ext_name; ?>" />
    </div>

    <div class="form-group col-md-12">
        <label>Address</label>
        <textarea name="address" class="textarea form-control" placeholder="Description text here" rows="4" style="font-size:18px;"><?php echo $address; ?></textarea>
    </div>


    <div class="clearfix"></div>

    <input type="hidden" name="action" value="<?php echo $action; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="parent_grid" value="#grid_users">
    <input type="hidden" name="reload_grid" value="">
    <input type="hidden" name="type" value="users">
    <!--<input type="hidden" name="close_after_save" value="true">-->
</form>