
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

                        <form method="post" id="add-procurement-form" action="<?php echo site_url('purchased_request/add_purchase_request'); ?>">

                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label>Department</label>
                                    <select name="office_id" class="form-control input-lg required" id="office_id">
                                        <option value="">Select Department</option>
                                        <?php foreach($offices as $office):?>
                                            <option value="<?php echo $office->id; ?>"><?php echo $office->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>SAI No:</label>
                                    <input class="form-control input-lg" type="text" placeholder="" name="sai_no">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>SAI DATE</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker input-lg" name="sai_date">
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group col-md-6">
                                    <label>Schedule</label>
                                    <select name="quarter" class="form-control input-lg required" id="quarter">
                                        <option value="">Select Quarter</option>
                                        <option value="1">Quarter 1</option>
                                        <option value="2">Quarter 2</option>
                                        <option value="3">Quarter 3</option>
                                        <option value="4">Quarter 4</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>ALOBS No:</label>
                                    <input class="form-control input-lg" type="text" placeholder="" name="alobs_no">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>SAI DATE</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control input-lg text-right datepicker" name="alobs_date" type="text" placeholder="" />
                                    </div>
                                </div>

                                <div class="clearfix"></div>


                                <div class="clearfix"></div>


                                <div class="form-group col-md-6">
                                    <label>Purpose</label>
                                    <textarea name="purpose" class="form-control" placeholder="Purpose text here" style="width: 100%; height: 200px; font-size: 18px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Section</label>
                                    <input class="form-control input-lg" name="section" type="text" placeholder="Section" />
                                </div>
                                <div class="clearfix"></div>

                                <br />
                            </div>


                            <div class="form-group col-md-12"  style="padding: 10px;border: 4px solid #d3d3d3;">
                                <table id="ppmp_list" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th width="5%">Code</th>
                                        <th>General Description</th>
                                        <th width="100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <select class="form-control input-lg">
                                                    <option value="">Testing</option>
                                                    <option value="">Lorem Ipsum</option>
                                                </select>
                                            </td>
                                            <td><a href="#" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add</a></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
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
