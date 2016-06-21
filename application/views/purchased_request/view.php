
<!-- DataTables -->
<link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">

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
                        </table>
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
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo number_format($spec->qty, 0); ?></td>
                                    <td><?php echo strtolower($spec->unit_name); ?></td>
                                    <td>
                                        <?php echo $spec->ppmp_desc; ?>
                                    </td>
                                    <td></td>
                                    <td align="right"><?php echo number_format($spec->cost, 2); ?></td>
                                </tr>
                                <?php if($spec->description): ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $spec->description; ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endif; ?>
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

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right"><b>Total: </b></td>
                                <td align="right"></td>
                                <td align="right"><b><?php echo number_format($pr_total_cost,2); ?></b></td>
                            </tr>

                        </table>
                        <table class="table table-bordered">
                            <tr>
                                <td>Purpose: <?php echo $p->purpose; ?></td>
                            </tr>
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
