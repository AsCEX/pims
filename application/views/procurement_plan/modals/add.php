<?php
    $action ="add";
    $id = "";
    $code ="";
    $qty ="";
    $office_id = "";
    $category = "";
    $desc = "";
    $unit_id = "";
    $budget = "";
    $fund_id = "";
    $cat = "";
    for($i=1;$i<=12;$i++){
        $sched['sched_' . $i ] = 0;
    }


    if($ppmp){
        $action ="edit";
        $id = $ppmp['ppmp_id'];
        $sched = $ppmp;
        $code = $ppmp['ppmp_code'];
        $desc = $ppmp['ppmp_description'];
        $office_id = $ppmp['ppmp_office_id'];
        $fund_id = $ppmp['ppmp_source_fund'];
        $budget = $ppmp['ppmp_budget'];
        $qty = $ppmp['qty'];
        $cat = $ppmp['ppmp_category_id'];
        $unit_id = $ppmp['ppmp_unit'];
    }

?>
    <script src="<?php echo site_url("assets/dist/js/form.bootstrap.js"); ?>"></script>


    <form method="post" id="add-procurement-form" action="<?php echo site_url('procurement_plan/add_procurement_plan'); ?>">
    <div class="section" style="width: 800px;">
        <div class="form-group col-md-2">
            <label>Code:</label>
            <input class="form-control required numeric" type="text" placeholder="Code" name="ppmp_code" value="<?php echo $code; ?>" />
        </div>

        <div class="form-group col-md-5">
            <label>Office</label>
            <select name="ppmp_office_id" class="form-control required">
                    <option value="">Select Office</option>
                <?php foreach($offices as $office):?>
                    <option value="<?php echo $office->ofc_id; ?>" <?php echo ($office_id == $office->ofc_id) ? "selected" : ""; ?> ><?php echo $office->ofc_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-md-5">
            <label>Category</label>
            <select name="ppmp_category" class="form-control required">
                <option value="">Select Category</option>
                <?php foreach($categories as $category):?>
                    <option value="<?php echo $category->cat_id; ?>" <?php echo ($cat == $category->cat_id) ? "selected" : ""; ?> ><?php echo $category->cat_description; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>General Description</label>
            <textarea name="ppmp_description" class="form-control required" placeholder="Description text here" style="width: 100%; height: 200px; border: 1px solid #dddddd; padding: 10px;"><?php echo $desc; ?></textarea>
        </div>


        <div class="form-group col-md-2">
            <label>Unit</label>
            <select name="ppmp_unit" class="form-control required">
                <option value="">Select Unit</option>
                <?php foreach($units as $unit):?>
                    <option value="<?php echo $unit->unit_id; ?>" <?php echo ($unit_id == $unit->unit_id) ? "selected" : ""; ?> ><?php echo $unit->unit_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-md-5">
            <label>Estimated Budget</label>
            <input class="form-control text-right required numeric" name="ppmp_budget" type="text" placeholder="0.0"  value="<?php echo $budget; ?>"  />
        </div>

        <div class="form-group col-md-5">
            <label>Funds:</label>
            <select name="ppmp_source_fund" class="form-control">
                <?php foreach($funds as $fund):?>
                    <option value="<?php echo $fund->fund_id; ?>" <?php echo ($fund_id == $fund->fund_id) ? "selected" : ""; ?> ><?php echo $fund->fund_name; ?></option>
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
                                <input type="text" class="form-control text-right numeric" name="month[1]" placeholder="0.0" value="<?php echo $sched["sched_1"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Feb</div>
                                <input type="text" class="form-control text-right numeric" name="month[2]" placeholder="0.0" value="<?php echo $sched["sched_2"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Mar</div>
                                <input type="text" class="form-control text-right numeric" name="month[3]" placeholder="0.0" value="<?php echo $sched["sched_3"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>
                    </td>

                    <td>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Apr</div>
                                <input type="text" class="form-control text-right numeric" name="month[4]" placeholder="0.0" value="<?php echo $sched["sched_4"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">May</div>
                                <input type="text" class="form-control text-right numeric" name="month[5]" placeholder="0.0" value="<?php echo $sched["sched_5"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Jun</div>
                                <input type="text" class="form-control text-right numeric" name="month[6]" placeholder="0.0" value="<?php echo $sched["sched_6"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>
                    </td>


                    <td>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Jul</div>
                                <input type="text" class="form-control text-right numeric" name="month[7]" placeholder="0.0" value="<?php echo $sched["sched_7"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Aug</div>
                                <input type="text" class="form-control text-right numeric" name="month[8]" placeholder="0.0" value="<?php echo $sched["sched_8"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Sep</div>
                                <input type="text" class="form-control text-right numeric" name="month[9]" placeholder="0.0" value="<?php echo $sched["sched_9"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>
                    </td>

                    <td>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Oct</div>
                                <input type="text" class="form-control text-right numeric" name="month[10]" placeholder="0.0" value="<?php echo $sched["sched_10"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Nov</div>
                                <input type="text" class="form-control text-right numeric" name="month[11]" placeholder="0.0" value="<?php echo $sched["sched_11"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Dec</div>
                                <input type="text" class="form-control text-right numeric" name="month[12]" placeholder="0.0" value="<?php echo $sched["sched_12"]; ?>" />
                            </div>
                            <!-- /.input group -->
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="clearfix"></div>
        <input type="hidden" name="action" value="<?php echo $action; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="parent_grid" value="#grid_users">
        <input type="hidden" name="reload_grid" value="">
        <input type="hidden" name="type" value="users">
    </form>



<script language="javascript">


    $(document).ready(function(){

        $('.numeric').numeric();
        $( document ).on( 'focus', ':input', function(){
            $( this ).attr( 'autocomplete', 'off' );
        });
        $('.date-picker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });


    });

</script>