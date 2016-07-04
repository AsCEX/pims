
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>PR No.</th>
                                <th>PR Code.</th>
                                <th>Department</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($pr as $p): ?>
                                <tr>
                                    <td><?php echo $p->pr_id; ?></td>
                                    <td><?php echo $p->pr_code_id; ?></td>
                                    <td><?php echo $p->dept_name; ?></td>
                                    <td><?php echo $p->created_date; ?></td>
                                    <td><a href="<?php echo site_url('purchased_request/view/' . $p->pr_id); ?>">View</a></td>
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
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!--<script>
    $(function(){
        $("#example1").DataTable();
    });
</script>-->