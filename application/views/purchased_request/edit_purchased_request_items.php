
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
                        <?php foreach($pr as $p): ?>

                            <button class="btn btn-success btn-lg">Edit PR Details</button><br /><br />
                            <input type="hidden" id="pr_quarter" value="<?php echo $p->quarter; ?>" />
                            <input type="hidden" id="pr_id" value="<?php echo $p->pr_id; ?>" />
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td width="30%">Department: <?php echo $p->dept_name; ?></td>
                                    <td width="10%">PR No.: </td>
                                    <td align="right" width="10%"><?php echo $p->pr_id; ?></td>
                                    <td width="5%">Date: </td>
                                    <td align="right" width="10%"><?php echo date("M d Y", strtotime($p->created_date) ); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>SAI No.: </td>
                                    <td align="right"><?php echo $p->sai_no; ?></td>
                                    <td>Date: </td>
                                    <td align="right"><?php echo (strtotime($p->sai_date) > 0 ) ? date("M d Y", strtotime($p->sai_date) ) : ""; ?></td>
                                </tr>
                                <tr>
                                    <td>Section: </td>
                                    <td>ALOBS No.: </td>
                                    <td align="right"><?php echo $p->alobs_no; ?></td>
                                    <td>Date: </td>
                                    <td align="right"><?php echo (strtotime($p->alobs_date) > 0) ? date("M d Y", strtotime($p->alobs_date) ) : ""; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Purpose:</b> <?php echo $p->purpose; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                            <br /><br />

                            <button class="btn btn-success btn-lg" id="add-pr-items" data-quarter="<?php echo $p->quarter; ?>" data-id="<?php echo $p->pr_id; ?>" >Add Items</button><br /><br />
                            <table class="table table-bordered">
                                <tr></tr>
                                <tr>
                                    <th width="5%">Item No.</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Item Description</th>
                                    <th>Estimated Unit Cost</th>
                                    <th>Estimated Cost</th>
                                </tr>
                                <?php $specs = $this->pr_model->getPurchaseItems($p->pr_id);
                                $pr_total_cost = 0;?>
                                <?php foreach($specs as $key=>$spec): ?>
                                    <tr style="background: #f3f3f3;">
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo number_format($spec->qty, 0); ?></td>
                                        <td><?php echo strtolower($spec->unit_name); ?></td>
                                        <td>
                                            <?php echo $spec->ppmp_desc; ?>
                                        </td>
                                        <td></td>
                                        <td align="right"><?php echo number_format($spec->cost, 2); ?></td>
                                    </tr>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="box box-success">
                                                    <div class="box-header with-border">Additional Details</div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label></label>
                                                            <textarea name="description" class="textarea" placeholder="Specification text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                            <?php echo $spec->description; ?>
                                                            </textarea>
                                                        </div>

                                                        <label>Item Specifications</label>
                                                        <div class="repeater-default-values">
                                                            <div data-repeater-list="car">
                                                                <div data-repeater-item class="pr-items-repeater">
                                                                    <div class="form-group col-md-4">

                                                                        <div class="col-md-12">
                                                                            <label>Specs</label>
                                                                            <input type="text" name="name" value="" placeholder="Specifications" class="form-control input-lg"/>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <label>Description</label>
                                                                            <textarea class="form-control input-lg" name="desc"></textarea>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Cost</label>
                                                                            <input type="text" name="name" value="" placeholder="Specs" class="form-control input-lg"/>
                                                                        </div>



                                                                        <div class="clearfix"></div>


                                                                    </div>
                                                                    <div class="form-group col-md-7">

                                                                        <!-- innner repeater -->
                                                                        <label>Sub Specs</label>
                                                                        <div class="inner-repeater" >
                                                                            <div data-repeater-list="inner-list">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group">
                                                                                        <div class="col-md-2">
                                                                                            <input type="text" name="qty" value="" placeholder="0" class="form-control input-lg"/>
                                                                                        </div>

                                                                                        <div class="col-md-4">
                                                                                            <select name="unit_id" class="form-control input-lg">
                                                                                                <option value="">Units...</option>
                                                                                                <option value="1">TEST</option>
                                                                                            </select>
                                                                                        </div>

                                                                                        <div class="col-md-5">
                                                                                            <input type="text" name="name" value="" placeholder="Name" class="form-control input-lg"/>
                                                                                        </div>
                                                                                        <div class="col-md-1">
                                                                                      <span data-repeater-delete class="btn btn-danger btn-sm pull-right">
                                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                                      </span>
                                                                                        </div>
                                                                                        <div class="clearfix"></div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>

                                                                              <span data-repeater-create class="btn btn-info btn-md">
                                                                                <span class="glyphicon glyphicon-plus"></span> Add

                                                                              </span>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-1">
                                                                          <span data-repeater-delete class="btn btn-danger btn-sm pull-right">
                                                                            <span class="glyphicon glyphicon-remove"></span>
                                                                          </span>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                  <span data-repeater-create class="btn btn-info btn-md">
                                                                    <span class="glyphicon glyphicon-plus"></span> Add
                                                                  </span>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    <?php $item_details = $this->pr_model->getPurchaseItemDetails($spec->id); ?>
                                    <?php if($item_details): ?>
                                        <?php foreach($item_details as $key=>$item): ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <b><?php echo chr($key+65) . ". " . $item->title; ?></li></b><br />
                                                    <?php echo $item->description; ?>
                                                </td>
                                                <td align="right"><?php echo ($item->cost) ? number_format($item->cost, 2) : ""; ?></td>
                                                <td align="right"></td>
                                            </tr>
                                            <?php
                                            $item_specs = $this->pr_model->getPRItemSpecs($item->id);
                                            foreach($item_specs as $key => $spec):
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <table width="50%" border="0" style="margin-left:20px;">
                                                            <tr>
                                                                <td width="20%"><?php echo number_format($spec->qty, 0) . " " . strtolower($spec->unit_name); ?></td>
                                                                <td width="80%"><?php echo $spec->name; ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td align="right"><?php echo number_format($spec->cost, 2); ?></td>
                                                    <td align="right"></td>
                                                </tr>

                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php $pr_total_cost += $spec->cost; ?>
                                <?php endforeach; ?>

                                <!--<tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="right"><b>Total: </b></td>
                                    <td align="right"></td>
                                    <td align="right"><b><?php /*echo number_format($pr_total_cost,2); */?></b></td>
                                </tr>-->

                            </table>
                        <?php endforeach; ?>

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
        $(".textarea").wysihtml5();


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
        background: #e2e2e2;
        padding: 10px 0px;
        margin: 10px 0px;
        border: 1px solid #ccc;
    }

    .inner-repeater{
        margin: 11px 0px;
        padding: 10px;
        background: #848484;
    }
</style>