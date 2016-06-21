
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

                        <form method="post" id="add-procurement-form" action="<?php echo site_url('purchased_request/add_purchase_request'); ?>">

                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <label>Department</label>
                                <select name="office_id" class="form-control input-lg">
                                    <?php foreach($offices as $office):?>
                                        <option value="<?php echo $office->id; ?>"><?php echo $office->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group col-md-2">
                                <label>SAI No:</label>
                                <input class="form-control input-lg required" type="text" placeholder="" name="sai_no">
                            </div>
                            <div class="form-group col-md-4">
                                <label>SAI DATE</label>
                                <input class="form-control input-lg text-right" name="sai_date" type="text" placeholder="" />
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-group col-md-2">
                                <label>ALOBS No:</label>
                                <input class="form-control input-lg required" type="text" placeholder="" name="alobs_no">
                            </div>
                            <div class="form-group col-md-4">
                                <label>ALOBS DATE</label>
                                <input class="form-control input-lg text-right" name="alobs_date" type="text" placeholder="" />
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-group col-md-6">
                                <label>Schedule</label>
                                <select name="quarter" class="form-control input-lg">
                                    <option value="1">Quarter 1</option>
                                    <option value="2">Quarter 2</option>
                                    <option value="3">Quarter 3</option>
                                    <option value="4">Quarter 4</option>
                                </select>
                            </div>

                            <div class="clearfix"></div>


                            <div class="form-group col-md-12">
                                <label>Purpose</label>
                                <textarea name="purpose" class="textarea" placeholder="Purpose text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="clearfix"></div>

                            <br />
                        </div>


                            <div class="form-group col-md-6">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="1%"><input type="checkbox" id="check-all"/></th>
                                            <th width="5%">Code</th>
                                            <th>General Description</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($ppmp as $pp): ?>
                                            <tr>
                                                <td><input type="checkbox" class="ppmp_details_id" name="ppmp_id[]" value="<?php echo $pp->ppmp_detail_id; ?>"/></td>
                                                <td><?php echo $pp->code; ?></td>
                                                <td><?php echo $pp->description; ?></td>

                                                <td></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <br /><br /><br />
                                    <button class="btn btn-success btn-lg pull-right" type="submit">Create Purchase Request</button>
                            </div>


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