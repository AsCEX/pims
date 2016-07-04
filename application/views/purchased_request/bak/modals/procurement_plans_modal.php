
<div class="modal" id="procurement-plan-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Procurement Plan</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="ppmp-to-pr-form" action="<?php echo site_url("purchased_request/add_pr_items"); ?>">
                    <?php foreach($pr as $p): ?>
                        <input type="hidden" name="pr_quarter" value="<?php echo $p->quarter; ?>" />
                        <input type="hidden" name="pr_id" value="<?php echo $p->pr_id; ?>" />
                    <?php endforeach; ?>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="5%">Code</th>
                            <th>General Description</th>
                            <th width="1%"><input type="checkbox" id="check-all"/></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($ppmp as $pp): ?>
                            <tr>
                                <td><?php echo $pp->code; ?></td>
                                <td><?php echo $pp->description; ?></td>
                                <td><input type="checkbox" name="ppmp_id[]" class="ppmp_details_id" value="<?php echo $pp->ppmp_detail_id; ?>"/></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add-procurement-submit">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(function(){
        $("#add-procurement-submit").click(function(){
            $(this).attr('disabled','disabled');
            $("#ppmp-to-pr-form").submit();
        });

        $("#ppmp-to-pr-form").submit(function(e){
            e.preventDefault();

            if($(this).valid()){
                url = $(this).attr('action');
                form_data = $(this).serialize();
                $.ajax({
                    url: url,
                    method: 'post',
                    data: form_data,
                    success: function(response){
                        alert(response);
                        $("#add-procurement-submit").removeAttr('disabled');
                    }
                });
            }else{
                $("#add-procurement-submit").removeAttr('disabled');
            }
        });
    });
</script>