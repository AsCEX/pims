

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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Office</th>
                                <th>Roles</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?php echo $user->user_id; ?></td>
                                    <td><?php echo $user->last_name . ", " . $user->first_name; ?></td>
                                    <td><?php echo $user->office; ?></td>
                                    <td><?php echo $user->user_roles; ?></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Office</th>
                                <th>Roles</th>
                                <th></th>
                            </tr>
                            </tfoot>
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
<script>
    $(function(){
        $("#example1").DataTable();
    });
</script>