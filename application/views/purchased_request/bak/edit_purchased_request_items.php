
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo site_url("assets/plugins/datatables/dataTables.bootstrap.css"); ?>">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Main row -->
        <div class="row">

            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Purchased Requests</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <button class="btn btn-success btn-lg">Edit PR Details</button><br /><br />
                        <form method="POST" id="edit_pr_items" action="">
                        <?php foreach($pr as $p): ?>

                            <input type="hidden" name="pr_quarter" id="pr_quarter" value="<?php echo $p->pr_quarter; ?>" />
                            <input type="hidden" name="pr_id" id="pr_id" value="<?php echo $p->pr_id; ?>" />
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td width="30%">Department: <?php echo $p->dept_name; ?></td>
                                    <td width="10%">PR No.: </td>
                                    <td align="right" width="10%"><?php echo $p->pr_code_id; ?></td>
                                    <td width="5%">Date: </td>
                                    <td align="right" width="10%"><?php echo date("M d Y", strtotime($p->pr_created_date) ); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>SAI No.: </td>
                                    <td align="right"><?php echo $p->pr_sai_no; ?></td>
                                    <td>Date: </td>
                                    <td align="right"><?php echo (strtotime($p->pr_sai_date) > 0 ) ? date("M d Y", strtotime($p->pr_sai_date) ) : ""; ?></td>
                                </tr>
                                <tr>
                                    <td>Section: </td>
                                    <td>ALOBS No.: </td>
                                    <td align="right"><?php echo $p->pr_alobs_no; ?></td>
                                    <td>Date: </td>
                                    <td align="right"><?php echo (strtotime($p->pr_alobs_date) > 0) ? date("M d Y", strtotime($p->pr_alobs_date) ) : ""; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Purpose:</b> <?php echo $p->pr_purpose; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>

                            <!--<button class="btn btn-success btn-lg" id="add-pr-items" data-quarter="<?php /*echo $p->quarter; */?>" data-id="<?php /*echo $p->pr_id; */?>" >Add Items</button><br /><br />-->
                            <table class="table table-bordered">
                                <tr></tr>
                                <tr>
                                    <th width="5%">Item No.</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Item Description</th>
                                    <th width="10%">Unit Cost</th>
                                    <th width="10%">Cost</th>
                                </tr>
                                <?php $specs = $this->pr_model->getPurchaseItems($p->pr_id);
                                $pr_total_cost = 0;?>
                                <?php foreach($specs as $key=>$spec): ?>
                                    <tr style="background: #e6ffea;">
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo number_format($spec->qty, 0); ?></td>
                                        <td><?php echo strtolower($spec->unit_name); ?></td>
                                        <td>
                                            <?php echo $spec->ppmp_desc; ?>
                                        </td>
                                        <td></td>
                                        <td align="right"><?php echo number_format($spec->cost, 2); ?></td>
                                    </tr>


                                    <?php $item_details = $this->pr_model->getPurchaseItemDetails($spec->id); ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="box box-success">
                                                    <!--<div class="box-header with-border">Additional Details</div>-->
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label></label>
                                                            <textarea name="pr[<?php echo $spec->id; ?>][item_detail_desc]" class="form-control" placeholder="Specification text here" style="width: 100%; height: 200px; font-size: 18px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $spec->description; ?></textarea>
                                                        </div>

                                                        <div class="repeater-default-values">
                                                            <label class="rh">Item Specifications</label>
                                                            <div data-repeater-list="pr[<?php echo $spec->id; ?>][pr_items]">
                                                                <?php if($item_details): ?>
                                                                <?php foreach( $item_details as $item): ?>
                                                                    <div data-repeater-item class="pr-items-repeater">
                                                                        <div class="form-group col-md-12">
                                                                            <input type="hidden" name="pr_item_detail_id" value="<?php echo $item->id; ?>" />
                                                                            <div class="col-md-12">
                                                                                <label>Specs</label>
                                                                                <input type="text" name="specs_name" value="<?php echo $item->title; ?>" placeholder="Specifications" class="form-control input-lg"/>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <label>Description</label>
                                                                                <textarea class="form-control input-lg" name="specs_desc"><?php echo $item->description; ?></textarea>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label>Cost</label>
                                                                                <input type="text" name="specs_cost" value="<?php echo $item->cost; ?>" placeholder="0" class="form-control input-lg"/>
                                                                            </div>



                                                                            <div class="clearfix"></div>


                                                                        </div>
                                                                        <div class="form-group col-md-1"></div>
                                                                        <div class="form-group col-md-10">

                                                                            <!-- innner repeater -->
                                                                            <label  class="rh">Sub Specs</label>
                                                                            <div class="inner-repeater" >
                                                                                <div data-repeater-list="item_details">

                                                                                    <div class="form-group">
                                                                                        <div class="col-md-2">
                                                                                            <label>Qty</label>
                                                                                        </div>

                                                                                        <div class="col-md-2">
                                                                                            <label>Unit</label>
                                                                                        </div>

                                                                                        <div class="col-md-3">
                                                                                            <label>Name</label>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label>Cost</label>
                                                                                        </div>
                                                                                        <div class="col-md-1"></div>
                                                                                        <div class="clearfix"></div>
                                                                                    </div>


                                                                                    <?php
                                                                                    $item_specs = $this->pr_model->getPRItemSpecs($item->id);
                                                                                    if($item_specs){
                                                                                    foreach($item_specs as $key => $spec):
                                                                                    ?>
                                                                                    <div data-repeater-item>
                                                                                        <input type="hidden" name="pr_item_detail_specs_id" value="<?php echo $spec->specs_id; ?>" />
                                                                                        <div class="form-group">
                                                                                            <div class="col-md-2">
                                                                                                <input style="text-align:right;" type="text" name="qty" value="<?php echo number_format($spec->qty, 2); ?>" placeholder="0" class="form-control input-lg"/>
                                                                                            </div>

                                                                                            <div class="col-md-2">
                                                                                                <select name="unit_id" class="form-control input-lg">
                                                                                                    <option value="">Select Unit</option>
                                                                                                    <?php foreach($units as $unit): ?>
                                                                                                        <option value="<?php echo $unit->id; ?>" <?php echo ($spec->unit_id == $unit->id) ? "selected" : ""; ?> ><?php echo $unit->unit_name; ?></option>
                                                                                                    <?php endforeach; ?>
                                                                                                </select>
                                                                                            </div>

                                                                                            <div class="col-md-3">
                                                                                                <input type="text" name="name" value="<?php echo $spec->name; ?>" placeholder="Name" class="form-control input-lg"/>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <input style="text-align:right;" type="text" name="cost" value="<?php echo number_format($spec->cost, 2); ?>" placeholder="0" class="form-control input-lg"/>
                                                                                            </div>
                                                                                            <div class="col-md-1">
                                                                                              <span data-repeater-delete class="pull-right" style="color: #bd1515;margin: 7px;">
                                                                                                <span class="glyphicon glyphicon-remove"></span>
                                                                                              </span>
                                                                                            </div>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <?php endforeach; ?>
                                                                                    <?php }else{ ?>

                                                                                        <div data-repeater-item>
                                                                                            <input type="hidden" name="pr_item_detail_specs_id" value="" />
                                                                                            <div class="form-group">
                                                                                                <div class="col-md-2">
                                                                                                    <input style="text-align:right;" type="text" name="qty" value="" placeholder="0" class="form-control input-lg"/>
                                                                                                </div>

                                                                                                <div class="col-md-3">
                                                                                                    <select name="unit_id" class="form-control input-lg">
                                                                                                        <option value="">Select Unit</option>
                                                                                                        <?php foreach($units as $unit): ?>
                                                                                                            <option value="<?php echo $unit->id; ?>" ><?php echo $unit->unit_name; ?></option>
                                                                                                        <?php endforeach; ?>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div class="col-md-4">
                                                                                                    <input type="text" name="name" value="" placeholder="Name" class="form-control input-lg"/>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <input style="text-align:right;" type="text" name="cost" value="" placeholder="0" class="form-control input-lg"/>
                                                                                                </div>
                                                                                                <div class="col-md-1">
                                                                                                      <span data-repeater-delete class="pull-right" style="color: #bd1515;margin: 7px;">
                                                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                                                      </span>
                                                                                                </div>
                                                                                                <div class="clearfix"></div>
                                                                                            </div>

                                                                                        </div>

                                                                                    <?php } ?>
                                                                                </div>

                                                                                    <span data-repeater-create class="btn btn-default btn-md">
                                                                                        <span class="glyphicon glyphicon-plus"></span> Add Sub Specs
                                                                                      </span>
                                                                            </div>

                                                                        </div>
                                                                        <div style="position:absolute;top:0px;right:0px;">
                                                                                  <span data-repeater-delete class="pull-right" style="color: #bd1515;margin: 7px;">
                                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                                  </span>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                <?php else: ?>

                                                                    <div data-repeater-item class="pr-items-repeater">
                                                                        <div class="form-group col-md-12">

                                                                            <input type="hidden" name="pr_item_detail_id" value="" />
                                                                            <div class="col-md-12">
                                                                                <label>Specs</label>
                                                                                <input type="text" name="specs_name" value="" placeholder="Specifications" class="form-control input-lg"/>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <label>Description</label>
                                                                                <textarea class="form-control input-lg" name="specs_desc"></textarea>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label>Cost</label>
                                                                                <input type="text" name="specs_cost" value="" placeholder="0" class="form-control input-lg"/>
                                                                            </div>
                                                                            <div class="clearfix"></div>

                                                                        </div>

                                                                        <div class="col-md-1">&nbsp;</div>
                                                                        <div class="form-group col-md-10">

                                                                            <!-- innner repeater -->
                                                                            <label  class="rh">Sub Specs</label>
                                                                            <div class="inner-repeater" >
                                                                                <div data-repeater-list="item_details">
                                                                                    <div class="form-group">
                                                                                        <div class="col-md-2">
                                                                                            <label>Qty</label>
                                                                                        </div>

                                                                                        <div class="col-md-3">
                                                                                            <label>Unit</label>
                                                                                        </div>

                                                                                        <div class="col-md-5">
                                                                                            <label>Name</label>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label>Cost</label>
                                                                                        </div>

                                                                                        <div class="clearfix"></div>
                                                                                    </div>
                                                                                        <div data-repeater-item>

                                                                                            <input type="hidden" name="pr_item_detail_specs_id" value="" />
                                                                                            <div class="form-group">
                                                                                                <div class="col-md-2">
                                                                                                    <input style="text-align:right;" type="text" name="qty" value="" placeholder="0" class="form-control input-lg"/>
                                                                                                </div>

                                                                                                <div class="col-md-3">
                                                                                                    <select name="unit_id" class="form-control input-lg">
                                                                                                        <option value="">Select Unit</option>
                                                                                                        <?php foreach($units as $unit): ?>
                                                                                                            <option value="<?php echo $unit->id; ?>" ><?php echo $unit->unit_name; ?></option>
                                                                                                        <?php endforeach; ?>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div class="col-md-4">
                                                                                                    <input type="text" name="name" value="" placeholder="Name" class="form-control input-lg"/>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <input style="text-align:right;" type="text" name="cost" value="" placeholder="0" class="form-control input-lg"/>
                                                                                                </div>
                                                                                                <div class="col-md-1">
                                                                                                      <span data-repeater-delete class="pull-right" style="color: #bd1515;margin: 7px;">
                                                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                                                      </span>
                                                                                                </div>
                                                                                                <div class="clearfix"></div>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>

                                                                                  <span data-repeater-create class="btn btn-default btn-md">
                                                                                    <span class="glyphicon glyphicon-plus"></span> Add Sub Specs
                                                                                  </span>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-1">&nbsp;</div>
                                                                        <div style="position:absolute;top:0px;right:0px;">
                                                                              <span data-repeater-delete class="pull-right" style="color: #bd1515;margin: 7px;">
                                                                                <span class="glyphicon glyphicon-remove"></span>
                                                                              </span>
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                <?php endif; ?>

                                                            </div>

                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                  <span data-repeater-create class="btn btn-info btn-md">
                                                                    <span class="glyphicon glyphicon-plus"></span> Add Item
                                                                  </span>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                <?php endforeach; ?>

                            </table>
                        <?php endforeach; ?>
                            <input type="submit" />
                        </form>

                    </div>
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- DataTables -->
<script src="<?php echo site_url("assets/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo site_url("assets/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo site_url("assets/plugins/jquery-repeater/jquery.repeater.min.js"); ?>"></script>
<script src="<?php echo site_url("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"); ?>"></script>
<script>
    $(function() {

        //bootstrap WYSIHTML5 - text editor
        //$(".textarea").wysihtml5();


        $("#example1").DataTable({
            "ordering": false,

        });

        $("#add-pr-items").click(function () {
            $("#procurement-plan-modal").modal({
                show: true,
                backdrop: 'static'
            });
        });

        $('.repeater-default-values').repeater({
            repeaters: [{
                selector: '.inner-repeater'
            }]
        });

    });
</script>
<style>
    .pr-items-repeater{
        background: #e5f3e9;
        padding: 10px 0px;
        margin: 10px 0px;
        border: 1px solid #37b55c;
        position: relative;
    }

    .inner-repeater{
        margin: 11px 0px;
        padding: 10px;
        background: #badcc6;
        border: 1px solid #3ec13e;
    }

    .repeater-default-values{
        /*border: 1px solid #e2e2e2;*/
        padding: 10px;
        background-color: #ebeded;
        border: 4px solid #d3d3d3;
    }

    .repeater-default-values label.rh{
        display: block;
        border: 1px solid #949494;
        padding: 10px;
        margin: 0px;
        background: #e2e2e2;
    }
</style>