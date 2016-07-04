
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo site_url("assets/plugins/datatables/dataTables.bootstrap.css"); ?>">
<script src="<?php echo site_url("assets/dist/js/jquery.grid.bootstrap.js"); ?>"></script>
<script src="<?php echo site_url("assets/dist/js/modal.bootstrap.js"); ?>"></script>
<script language="javascript">
    $(document).ready(function(){
        $('#grid_users').grid({
            columnCount: 18
        });
    });
</script>
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
            Procurement Plan
            <small>Control panel</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="panel panel-default">
            <div class="panel-heading">Procurement Plans</div>
            <div class="panel-body">
                <!-- Main row -->
                <div class="row">
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-12">
                        <div class="grid panel panel-default" id="grid_users">
                            <div class="panel-body">
                                <a href="<?php echo site_url('procurement_plan/create/'); ?>" class="btn btn-primary display-modal" title="Add New Procurement Plan"><i class="fa fa-plus-square"></i> Add New</a>
                                <br /><br />
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
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
                                    <tr class="init-row">
                                        <td><span class="ppmp_code"></span></td>
                                        <td><span class="ppmp_description"></span></td>
                                        <td><span class="qty"></span></td>
                                        <td><span class="unit_name"></span></td>
                                        <td style="text-align:right;    "><span class="ppmp_budget"></span></td>

                                        <?php for($i=1;$i<=12;$i++): ?>
                                            <td align="center">
                                                <span class="sched_<?php echo $i; ?>"></span>
                                            </td>
                                        <?php endfor; ?>
                                        <td>
                                            <div class="quicklinks pull-right"><a href="<?php echo site_url('procurement_plan/create'); ?>/" class="id display-modal" title="Edit Record"><i class="fa fa-pencil"></i></a></div>
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
                            <input type="hidden" name="grid_url" value="<?php echo site_url('procurement_plan/getProcurementPlans'); ?>" />
                            <input type="hidden" name="parameters" value="" />
                        </div>
                </div>

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
<script src="<?php echo site_url("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"); ?>"></script>
<script>
    $(function() {

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5({
            "toolbar": {
                "font-styles": false,
                "emphasis": true,
                "lists": true,
                "html": false,
                "link": false,
                "image": false,
                "color": false,
                "blockquote": false,
            }
        });


        $("#example1").DataTable({
            "ordering": false,
        });

        $("#add-ppmp").click(function () {
            $("#add-modal").modal({
                show: true,
                backdrop: 'static'
            });
        });
        $(".edit-ppmp").click(function (e) {
            e.preventDefault();
            var id = $(this).attr('rel');
            $.ajax({
                url: '<?php echo site_url('procurement_plan/getProcurementPlanById'); ?>/' + id,
                data: {

                },
                success: function(response){
                    console.log(response);
                }
            })

            $("#add-modal").modal({
                show: true,
                backdrop: 'static'
            });
        });

    });
</script>