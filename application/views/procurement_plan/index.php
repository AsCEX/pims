
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo site_url("assets/plugins/datatables/dataTables.bootstrap.css"); ?>">
<style>
    .table>thead>tr>th {
         vertical-align: middle;
    }
</style>
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
                        <button class="btn btn-success" id="add-ppmp">Add Procurement Plan</button><br /><br />

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th rowspan="2" width="1%"><input type="checkbox" id="check-all"/></th>
                                <th rowspan="2" width="5%">Code</th>
                                <th rowspan="2">General Description</th>
                                <th rowspan="2" width="5%">Qty</th>
                                <th rowspan="2" width="5%">Unit</th>
                                <th rowspan="2">Budget</th>
                                <th colspan="12" width="50%">Schedule/Milestone of Activities</th>
                                <th rowspan="2"></th>
                            </tr>
                            <tr>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>May</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Aug</th>
                                <th>Sep</th>
                                <th>Oct</th>
                                <th>Nov</th>
                                <th style="border-right-width: 1px" >Dec</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($ppmp as $pp): ?>
                                <tr>
                                    <td><input type="checkbox" class="ppmp_details_id" value="<?php echo $pp->ppmp_detail_id; ?>"/></td>
                                    <td><?php echo $pp->code; ?></td>
                                    <td><?php echo $pp->description; ?></td>
                                    <td><?php echo $pp->qty; ?></td>
                                    <td><?php echo strtolower( $pp->unit_name ); ?></td>
                                    <td><?php echo $pp->budget; ?></td>

                                    <?php $sched = explode(",", $pp->scheds); ?>
                                    <?php $values = explode(",", $pp->sched_values); ?>
                                    <?php
                                    $cnt = 0;
                                    for($i=0;$i<12;$i++): ?>
                                        <td align="center">
                                            <?php
                                                if(in_array($i+1, $sched)){
                                                    echo $values[$cnt];
                                                    $cnt++;
                                                }else{
                                                    echo 0;
                                                }
                                            ?>
                                        </td>
                                    <?php endfor; ?>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
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
<script src="<?php echo site_url("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"); ?>"></script>
<script>
    $(function() {

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();


        $("#example1").DataTable({
            "ordering": false,
        });

        $("#add-ppmp").click(function () {
            $("#add-modal").modal({
                show: true,
                backdrop: 'static'
            });
        });

    });
</script>