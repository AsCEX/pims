

<!-- DataTables -->
<link rel="stylesheet" href="<?php echo site_url("assets/plugins/datatables/dataTables.bootstrap.css"); ?>">
<script src="<?php echo site_url("assets/dist/js/jquery.grid.bootstrap.js"); ?>"></script>
<script src="<?php echo site_url("assets/dist/js/modal.bootstrap.js"); ?>"></script>
<script language="javascript">
    $(document).ready(function(){
        $('#grid_users').grid();
    });
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
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

                    <div class="grid panel panel-default" id="grid_users">
                        <div class="panel-body">
                            <a href="<?php echo site_url('groups/addGroup/'); ?>" class="btn btn-primary display-modal" title="Add New Group">Add New</a>
                            <br /><br />
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr class="header">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th width="20"></th>
                                </tr>
                                </thead>
                                <tr class="init-row">
                                    <td>
                                        <span class="grp_id"></span>
                                    </td>
                                    <td><span class="grp_name"></span></td>
                                    <td><span class="grp_description"></span></td>
                                    <td>
                                        <div class="quicklinks pull-right"><a href="<?php echo site_url('groups/addGroup'); ?>/" class="grp_id display-modal" title="Edit Record"><i class="fa fa-pencil"></i></a></div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="grid-controls panel-footer">
                            <div class="pad row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">Page: <span class="currentPage"></span> of <span class="totalPages"></span> of <span class="totalRecords"></span> records.</span>
                                        <input type="text" class="form-control gotopage" name="gotopage">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default go-page">Go To Page</button>
                                        </div><!-- /btn-group -->
                                    </div><!-- /input-group -->
                                </div>
                                <div class="col-md-8">
                                    <div class="paging pull-right">
                                        <a href="#" class="page-previous page-link btn btn-default" rel="">Previous Page</a>
                                        <a href="#" class="page-next page-link btn btn-default" rel="">Next Page</a>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <input type="hidden" name="grid_url" value="<?php echo site_url('groups/getGroups'); ?>" />
                        <input type="hidden" name="parameters" value="" />
                    </div>
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
        $("#example1").DataTable({
            ordering: false
        });

    });
</script>