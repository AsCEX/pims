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

                        <form method="post" id="add-procurement-form" action="<?php echo site_url('purchased_request/update_purchase_request'); ?>">
                        <input type="hidden" name="id" value="<?php echo $pr->id; ?>" />
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label>Department</label>
                                <select name="office_id" class="form-control input-lg required" id="office_id">
                                    <option value="">Select Department</option>
                                    <?php foreach($offices as $office):?>
                                        <option value="<?php echo $office->id; ?>" <?php echo ($office->id == $pr->department_id) ? "selected":""; ?> ><?php echo $office->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label>SAI No:</label>
                                <input class="form-control input-lg" type="text" placeholder="" name="sai_no" value="<?php echo $pr->sai_no; ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <label>SAI DATE</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right datepicker input-lg" name="sai_date" value="<?php echo $pr->sai_date; ?>">
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-group col-md-6">
                                <label>Schedule</label>
                                <select name="quarter" class="form-control input-lg  required" id="quarter">
                                    <option value="">Select Quarter</option>
                                    <?php for($i=1;$i<=4;$i++): ?>
                                        <option value="<?php echo $i; ?>" <?php echo ($i == $pr->quarter) ? "selected" : ""; ?>>Quarter <?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label>ALOBS No:</label>
                                <input class="form-control input-lg" type="text" placeholder="" name="alobs_no" value="<?php echo $pr->alobs_no; ?>">
                            </div>

                            <div class="form-group col-md-2">
                                <label>ALOBS DATE</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control input-lg datepicker" name="alobs_date" type="text" placeholder=""  value="<?php echo $pr->alobs_date; ?>"/>
                                </div>
                            </div>

                            <div class="clearfix"></div>


                            <div class="clearfix"></div>


                            <div class="form-group col-md-6">
                                <label>Purpose</label>
                                <textarea name="purpose" class="form-control" placeholder="Purpose text here" style="width: 100%; height: 200px; font-size: 18px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $pr->purpose; ?></textarea>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Section</label>
                                <input class="form-control input-lg" name="section" type="text" placeholder="Section" value="<?php echo $pr->section; ?>"/>
                            </div>
                            <div class="clearfix"></div>

                            <br />
                        </div>


                            <div class="form-group col-md-12">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="1%"><input name="select_all" value="1" type="checkbox"></th>
                                            <th width="5%">Code</th>
                                            <th>General Description</th>
                                        </tr>
                                        </thead>
                                        <tbody>

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
    //
    // Updates "Select all" control in a data table
    //
    function updateDataTableSelectAllCtrl(table){
        var $table             = table.table().node();
        var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
        var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
        var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

        // If none of the checkboxes are checked
        if($chkbox_checked.length === 0){
            chkbox_select_all.checked = false;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = false;
            }

            // If all of the checkboxes are checked
        } else if ($chkbox_checked.length === $chkbox_all.length){
            chkbox_select_all.checked = true;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = false;
            }

            // If some of the checkboxes are checked
        } else {
            chkbox_select_all.checked = true;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = true;
            }
        }
    }


    $(document).ready(function (){
        // Array holding selected row IDs
        var rows_selected = [];
        table = $('#example1').DataTable({
            'ajax': {
                'url': '<?php echo site_url('procurement_plan/getProcurement'); ?>',
                "type": 'POST',
                "data": function(d){
                    d.office = $("#office_id").val();
                    d.quarter = $("#quarter").val();
                }
            /*{
                    'office': $("#office_id").val()
                }*/
            },
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'width': '1%',
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    console.log(data);
                    return '<input type="checkbox" name="ppmp_id[]" value="' + data + '">';
                }
            }],
            'order': [[1, 'asc']],
            'rowCallback': function(row, data, dataIndex){
                // Get row ID
                var rowId = data[0];

                // If row ID is in the list of selected row IDs
                if($.inArray(rowId, rows_selected) !== -1){
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            }
        });


        // Handle click on checkbox
        $('#example1 tbody').on('click', 'input[type="checkbox"]', function(e){
            var $row = $(this).closest('tr');

            // Get row data
            var data = table.row($row).data();

            // Get row ID
            var rowId = data[0];

            // Determine whether row ID is in the list of selected row IDs
            var index = $.inArray(rowId, rows_selected);

            // If checkbox is checked and row ID is not in list of selected row IDs
            if(this.checked && index === -1){
                rows_selected.push(rowId);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1){
                rows_selected.splice(index, 1);
            }

            if(this.checked){
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }

            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle click on table cells with checkboxes
        $('#example1').on('click', 'tbody td, thead th:first-child', function(e){
            $(this).parent().find('input[type="checkbox"]').trigger('click');
        });

        // Handle click on "Select all" control
        $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
            if(this.checked){
                $('#example1 tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#example1 tbody input[type="checkbox"]:checked').trigger('click');
            }

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle table draw event
        table.on('draw', function(){
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);
        });

        $("#office_id").change(function(){
           table.ajax.reload();
        });
        $("#quarter").change(function(){
           table.ajax.reload();
        });

        // Handle form submission event
        $('#frm-example').on('submit', function(e){
            var form = this;

            // Iterate over all selected checkboxes
            $.each(rows_selected, function(index, rowId){
                // Create a hidden element
                $(form).append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                );
            });
        });

    });

    $(function() {

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();


        $("#add-ppmp").click(function () {
            $("#add-modal").modal({
                show: true,
                backdrop: 'static'
            });
        });

    });
</script>

<style>
    table.dataTable.select tbody tr,
    table.dataTable thead th:first-child {
        cursor: pointer;
    }
    table.dataTable tbody>tr.selected{
        background-color: #acbad4;
    }
</style>