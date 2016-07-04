
<div class="modal" id="add-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Procurement Plan</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="add-procurement-form" action="<?php echo site_url('procurement_plan/add_procurement_plan'); ?>">

                <div class="form-group col-md-2">
                    <label>Code:</label>
                    <input class="form-control input-lg required" type="text" placeholder="Code" name="code">
                </div>

                <div class="form-group col-md-5">
                    <label>Office</label>
                    <select name="office_id" class="form-control input-lg">
                        <?php foreach($offices as $office):?>
                            <option value="<?php echo $office->id; ?>"><?php echo $office->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                 <div class="form-group col-md-5">
                     <label>Category</label>
                     <select name="category" class="form-control input-lg">
                         <?php foreach($categories as $category):?>
                             <option value="<?php echo $category->id; ?>"><?php echo $category->description; ?></option>
                         <?php endforeach; ?>
                     </select>
                 </div>

                <div class="form-group">
                    <label>General Description</label>
                    <textarea name="description" class="form-control required" placeholder="Description text here" style="width: 100%; height: 200px; font-size: 18px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>


                    <div class="form-group col-md-2">
                        <label>Unit</label>
                        <select name="unit_id" class="form-control input-lg">
                            <?php foreach($units as $unit):?>
                                <option value="<?php echo $unit->id; ?>"><?php echo $unit->unit_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                <div class="form-group col-md-5">
                    <label>Estimated Budget</label>
                    <input class="form-control input-lg text-right required" name="budget" type="text" placeholder="0.0" />
                </div>

                    <div class="form-group col-md-5">
                        <label>Funds:</label>
                        <select name="source_fund" class="form-control input-lg">
                            <?php foreach($funds as $fund):?>
                                <option value="<?php echo $fund->id; ?>"><?php echo $fund->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <br />
                <hr />

                <div class="form-group col-md-12">
                    <label>Schedule / Milestone of Activities</label>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="25%">Q1</th>
                                <th width="25%">Q2</th>
                                <th width="25%">Q3</th>
                                <th width="25%">Q4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Jan</div>
                                            <input type="text" class="form-control text-right" name="month[1]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Feb</div>
                                            <input type="text" class="form-control text-right" name="month[2]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Mar</div>
                                            <input type="text" class="form-control text-right" name="month[3]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Apr</div>
                                            <input type="text" class="form-control text-right" name="month[4]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">May</div>
                                            <input type="text" class="form-control text-right" name="month[5]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Jun</div>
                                            <input type="text" class="form-control text-right" name="month[6]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </td>


                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Jul</div>
                                            <input type="text" class="form-control text-right" name="month[7]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Aug</div>
                                            <input type="text" class="form-control text-right" name="month[8]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Sep</div>
                                            <input type="text" class="form-control text-right" name="month[9]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Oct</div>
                                            <input type="text" class="form-control text-right" name="month[10]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Nov</div>
                                            <input type="text" class="form-control text-right" name="month[11]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Dec</div>
                                            <input type="text" class="form-control text-right" name="month[12]" placeholder="0.0"/>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
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
            $("#add-procurement-form").submit();
        });


        $("#add-procurement-form").submit(function(e){
            e.preventDefault();

            if($(this).valid()){
                url = $(this).attr('action');
                form_data = $(this).serialize();
                $.ajax({
                    url: url,
                    method: 'post',
                    data: form_data,
                    success: function(response){

                        $("#add-procurement-submit").removeAttr('disabled');
                        if(response){
                            windowl.location.reload();
                        }
                    }
                });
            }else{
                $("#add-procurement-submit").removeAttr('disabled');
            }
        });
    });
</script>