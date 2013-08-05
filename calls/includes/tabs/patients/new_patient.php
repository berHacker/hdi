<?php
    require_once( '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'init.php' );
    require_once( INCLUDES.DIRECTORY_SEPARATOR.'functions.php' );
    
    // Class instances
    $doctor       = new Doctor();
    $hospital     = new Hospital();
    $option       = new Option();
    
    // Init.
    $next_code = '';
    $relation_arr = $patient_type_arr = $account_status_arr = $marital_status_arr = $religion_arr = $occupation_arr =  $country_arr = $title_arr = array();
    if (is_a($option, 'Option'))
    {
        // Patient ID Alias Generator
        $pid_alias = $option->next_code('pid_alias');
        if ($pid_alias != '')
        {
            $next_code = 'P' . date('ym') . '/' . pad($pid_alias, 2);
        } else {
            $next_code = '';
        }
        
        // Relationship
        $relation_arr = $option->query(array(
            'select' => "option_name as name, option_id as id",
            'from'   => 'options',
            'where'  => "group_code='relationship'",
            'order'  => 'option_name',
            'format' => 'Array'
        ));
        
        // Patient type
        $patient_type_arr = $option->query(array(
            'select' => "option_name as name, option_id as id",
            'from'   => 'options',
            'where'  => "group_code='patient_type'",
            'order'  => 'option_name',
            'format' => 'Array'
        ));
        
        // Account status
        $account_status_arr = $option->query(array(
            'select' => "option_name as name, option_id as id",
            'from'   => 'options',
            'where'  => "group_code='account_status'",
            'order'  => 'option_name',
            'format' => 'Array'
        ));
        
        // Marital status
        $marital_status_arr = $option->query(array(
            'select' => "option_name as name, option_id as id",
            'from'   => 'options',
            'where'  => "group_code='marital_status'",
            'order'  => 'option_name',
            'format' => 'Array'
        ));
        
        // Religion
        $religion_arr = $option->query(array(
            'select' => "option_name as name, option_id as id",
            'from'   => 'options',
            'where'  => "group_code='religion'",
            'order'  => 'option_name',
            'format' => 'Array'
        ));
        
        // Occupation
        $occupation_arr = $option->query(array(
            'select' => "option_name as name, option_id as id",
            'from'   => 'options',
            'where'  => "group_code='occupation'",
            'order'  => 'option_name',
            'format' => 'Array'
        ));
        
        // Country
        $country_arr = $option->query(array(
            'select' => "option_name as name, option_id as id",
            'from'   => 'options',
            'where'  => "group_code='country'",
            'order'  => 'option_name',
            'format' => 'Array'
        ));
        
        // Title
        $title_arr = $option->query(array(
            'select' => "option_name as name, option_id as id",
            'from'   => 'options',
            'where'  => "group_code='title'",
            'order'  => 'option_name',
            'format' => 'Array'
        ));
    }
    
    // Hospital
    $refhospital_arr = array();
    if (is_a($hospital, 'Hospital'))
    {
        $refhospital_arr = $hospital->query(array(
            'select' => "hospital_name as name, hospital_id as id",
            'from'   => 'hospitals',
            'order'  => 'hospital_name',
            'format' => 'Array'
        ));
    }
    
    // Internal Doctors
    $intdoc_arr = array();
    if (is_a($doctor, 'Doctor'))
    {
        $intdoc_arr = $doctor->query(array(
            'select' => "CONCAT('Dr. ',surname,', ',first_name) as name, doctor_id as id",
            'from'   => 'doctors',
            'where'  => "doctor_type='INT'",
            'order'  => 'surname',
            'format' => 'Array'
        ));
    }
?>
    
<form name="frm_new_patient" id="frm_new_patient" method="post">
    <div class="outter_pad">
        <div class="l_float percent50">
            <div class="inner_pad">
                <div class="fieldset">
                    <div class="legend">Personal Details:</div>
                    <table class="visible_table">
                        <tr>
                            <td class="percent35">Title:</td>
                            <td><?php dropdown($title_arr,'sel_title','','','selbox','','Select:');?></td>
                        </tr>
                        <tr>
                            <td class="percent35">First Name:</td>
                            <td><input name="txt_fname" id="txt_fname" class="txtbox" value="" /></td>
                        </tr>
                        <tr>
                            <td>Middle Name:</td>
                            <td><input name="txt_mname" id="txt_mname" class="txtbox" value="" /></td>
                        </tr>
                        <tr>
                            <td>Surname:</td>
                            <td><input name="txt_sname" id="txt_sname" class="txtbox" value="" /></td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td>
                                <?php
                                    $gender_arr = '';
                                    $gender_arr = item_array('gender');
                                    if ('' != $gender_arr)
                                    {
                                        dropdown($gender_arr, 'sel_gender', '', '', 'selbox', '', 'Select:');
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <!-- Tooltip -->
                    <div class="tooltip"><span class="dark_gray"></span><div class="tail"></div></div>
                </div>
            </div>
        </div>
            
        <div class="l_float percent50">
            <div class="inner_pad">
                <div class="fieldset" style="border:none;padding:0;">
                    <table class="percent100">
                        <tr>
                            <td style="padding-right:15px;">
                                <div>
                                    <div style='height:0px;width:0px;overflow:hidden;'><input type="file" name="fil_patient_pix" id="fil_patient_pix" onchange="javascript:$process_uploader();" /></div>
                                    <button type="button" name="btn_patient_pix" id="btn_patient_pix" class="btn_pix rnd_oooo"><img src="../calls/images/patients/sample.jpg" class="rnd_oooo" width="100px" alt="Upload Picture" /></button>
                                </div>
                            </td>
                            <td class="percent100" style="vertical-align:top;">
                                <table class="visible_table">
                                    <tr>
                                        <td>Patient&nbsp;ID:</td><td><input name="txt_pid_alias" id="txt_pid_alias" class="txtbox" value="<?php echo $next_code; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>First&nbsp;Visit:</td><td class="bold"><?php echo date('F d, Y.') ?></td>
                                    </tr>
                                    <tr>
                                        <td>No.&nbsp;of&nbsp;Visits:</td><td class="bold">0</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- Tooltip -->
                    <div class="tooltip"><span class="dark_gray"></span><div class="tail"></div></div>
                </div>
            </div>
        </div>
        
        <div class="percent100 clear"></div>
            
        <div class="l_float percent50">
            <div class="inner_pad">
                <div id="fieldset_contact" class="fieldset">
                    <div class="legend">Contact Details:</div>
                    <table class="visible_table">
                        <tr>
                            <td class="percent35" style="vertical-align:top;">Address:</td>
                            <td>
                                <textarea name="txta_address" id="txta_address" class="txtbox" rows="3"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input name="txt_email" id="txt_email" class="txtbox" value=""  /></td>
                        </tr>
                        <tr>
                            <td>Phone Number 1:</td>
                            <td><input name="txt_phone1"  id="txt_phone1" class="txtbox" value="" /></td>
                        </tr>
                        <tr>
                            <td>Phone Number 2:</td>
                            <td><input name="txt_phone2" id="txt_phone2" class="txtbox" value=""   /></td>
                        </tr>
                    </table>
                    <!-- Tooltip -->
                    <div class="tooltip"><span class="dark_gray"></span><div class="tail"></div></div>
                </div>
            </div>
        </div>
        
        <div class="l_float percent50">
            <div class="inner_pad">
                <div id="fieldset_official" class="fieldset">
                    <div class="legend">Official Details:</div>
                    <table class="visible_table">
                        <tr>
                            <td class="percent35">Patient Type:</td>
                            <td>
                                <?php dropdown($patient_type_arr,'sel_ptype','','','selbox','','Select:');?>
                            </td>
                        </tr>
                        <tr>
                            <td>Assigned Doctor:</td>
                            <td><?php dropdown($intdoc_arr, 'sel_intdoc', '', '', 'selbox', '', 'Select:'); ?></td>
                        </tr>
                        <tr>
                            <td class="percent35">Blood Type:</td>
                            <td>
                                <table class="invisible_table">
                                    <tr>
                                        <td class="percent40" style="padding-left:0;padding-top:0;padding-bottom:0;">
                                            <?php
                                                $blood_types_arr = '';
                                                $blood_types_arr = item_array('blood_type');
                                                if ('' != $blood_types_arr)
                                                {
                                                    dropdown($blood_types_arr, 'sel_bloodtype', '', '', 'selbox', '', 'Select:');
                                                }
                                            ?>
                                        </td>
                                        <td class="r_align" style="padding-left:20px;">RH:</td>
                                        <td class="percent40" style="padding-right:0;padding-top:0;padding-bottom:0;">
                                            <?php
                                                $rh_arr = '';
                                                $rh_arr = item_array('rh');
                                                if ('' != $rh_arr)
                                                {
                                                    dropdown($rh_arr, 'sel_rh', '', '', 'selbox', '', 'Select:');
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Referring Hospital:</td>
                            <td><?php dropdown($refhospital_arr, 'sel_refhospital', 'onchange', "\$ajax_loading('ref_doc','../calls/includes/switch.php','&opt=ref_doc&value='+this.value);", 'selbox', '', 'Select:'); ?></td>
                        </tr>
                        <tr>
                            <td>Referring Doctor:</td>
                            <td id="ref_doc">
                                <select name="sel_extdoc" id="sel_extdoc" class="selbox">
                                    <option value="">Select:</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Account Status:</td>
                            <td>
                                <?php dropdown($account_status_arr, 'sel_status', '', '', 'selbox', '', 'Select:'); ?>
                            </td>
                        </tr>
                    </table>
                    <!-- Tooltip -->
                    <div class="tooltip"><span class="dark_gray"></span><div class="tail"></div></div>
                </div>
            </div>
        </div>
        
        <div class="percent100 clear"></div>
        
        <div class="l_float percent50">
            <div class="inner_pad">
                <div id="fieldset_nok" class="fieldset">
                    <div class="legend">Next of Kin Details:</div>
                    <table class="visible_table">
                        <tr>
                            <td class="percent35">First Name:</td>
                            <td><input name="txt_kin_fname" id="txt_kin_fname" class="txtbox" value="" /></td>
                        </tr>
                        <tr>
                            <td>Middle Name:</td>
                            <td><input name="txt_kin_mname" id="txt_kin_mname" class="txtbox" value=""  /></td>
                        </tr>
                        <tr>
                            <td>Surname:</td>
                            <td><input name="txt_kin_sname" id="txt_kin_sname" class="txtbox" value=""  /></td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td>
                                <?php
                                    $gender_arr = '';
                                    $gender_arr = item_array('gender');
                                    if ('' != $gender_arr)
                                    {
                                        dropdown($gender_arr, 'sel_kin_gender', '', '', 'selbox', '', 'Select:');
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="percent35" style="vertical-align:top;">Address:</td>
                            <td>
                                <textarea name="txta_kin_address" id="txta_kin_address" class="txtbox" rows="3"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input name="txt_kin_email" id="txt_kin_email" class="txtbox" value="" /></td>
                        </tr>
                        <tr>
                            <td>Phone Number 1:</td>
                            <td><input name="txt_kin_phone1" id="txt_kin_phone1" class="txtbox" value="" /></td>
                        </tr>
                        <tr>
                            <td>Phone Number 2:</td>
                            <td><input name="txt_kin_phone2" id="txt_kin_phone2" class="txtbox" value="" /></td>
                        </tr>
                        <tr>
                            <td>Relationship:</td>
                            <td><?php dropdown($relation_arr, 'sel_kin_relate', '', '', 'selbox', '', 'Select:'); ?></td>
                        </tr>
                    </table>
                    <!-- Tooltip -->
                    <div class="tooltip"><span class="dark_gray"></span><div class="tail"></div></div>
                </div>
            </div>
        </div>
        
        <div class="l_float percent50">
            <div class="inner_pad">
                <div id="fieldset_other" class="fieldset">
                    <div class="legend">Other Details:</div>
                    <table class="visible_table">
                        <tr>
                            <td class="percent35">Date of Birth:</td>
                            <td>
                                <table class="invisible_table">
                                    <tr>
                                        <td class="percent80" style="padding-left:0;padding-top:0;padding-bottom:0;"><input name="txt_dob" id="txt_dob" class="txtbox" onchange="javascript:$date_engine.get_age(this.value,'#txt_age');" readonly="true" value="" /></td>
                                        <td style="padding-right:0;padding-top:0;padding-bottom:0;"><input name="txt_age" id="txt_age" class="txtbox" onkeyup="javascript:$date_engine.get_dob(this.value,'#txt_dob');" value="" /></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Marital Status:</td>
                            <td>
                                <?php dropdown($marital_status_arr, 'sel_marital', '', '', 'selbox', '', 'Select:'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Religion:</td>
                            <td>
                                <?php dropdown($religion_arr, 'sel_religion', '', '', 'selbox', '', 'Select:'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Occupation:</td>
                            <td>
                                <?php dropdown($occupation_arr, 'sel_occupation', '', '', 'selbox', '', 'Select:'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td>
                                <?php dropdown($country_arr, 'sel_country', '', '', 'selbox', '', 'Select:'); ?>
                            </td>
                        </tr>
                    </table>
                    <!-- Tooltip -->
                    <div class="tooltip"><span class="dark_gray"></span><div class="tail"></div></div>
                </div>
            </div>
        </div>
        
        <div class="percent100 clear"></div>
        
        <div class="l_float percent100">
            <div class="inner_pad">
                <div class="fieldset">
                    <div class="legend">Controls:</div>
                    <table class="visible_table">
                        <tr>
                            <td colspan="2"><button type="submit">Insert Patient</button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="clear"></div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function()
    {
        $init.equalize_heights(['#fieldset_contact','#fieldset_official']);
        $init.equalize_heights(['#fieldset_nok','#fieldset_other']);
        
        // File uploader
        $('#btn_patient_pix').on('click', function()
        {
            $('#fil_patient_pix').trigger('click');
        });
        
        // Jquery date picker
        $( "#txt_dob" ).datepicker({ dateFormat: "dd/mm/yy", changeMonth: true, changeYear: true });
        
        // Switch on validator for certain form fields
        $validator.activate([
            {'name':'#sel_title','type':'select'},   // Title
            {'name':'#txt_fname','type':'text'},     // First Name
            {'name':'#txt_sname','type':'text'},     // Surname
            {'name':'#sel_gender','type':'select'},  // Gender
            {'name':'#txta_address','type':'text'},  // Address
            {'name':'#txt_phone1','type':'text'},    // Phone 1
            {'name':'#txt_pid_alias','type':'text'}, // Patient ID
            {'name':'#sel_ptype','type':'select'},   // Patient Type
            {'name':'#sel_intdoc','type':'select'},  // Assigned Doctor
            {'name':'#sel_status','type':'select'},  // Patient Status
            {'name':'#txt_age','type':'text'}        // Age
        ]);
        
        // Reset the form field appearance
        $("input, textarea").on('keyup', function()
        {
            $(this).css({"border":"#CCC solid 1px"});
            
            // Switch-off the tooltip
            $validator.hide_tooltip();
        });
        $("input, textarea").on('change', function()
        {
            $(this).css({"border":"#CCC solid 1px"});
            
            // Switch-off the tooltip
            $validator.hide_tooltip();
        });
        $("select").on('change', function()
        {
            $(this).css({"border":"#CCC solid 1px"});
            
            // Switch-off the tooltip
            $validator.hide_tooltip();
        });
        
        // Form        
        $("#frm_new_patient").on('submit', function($this)
        {
            // Prevent the form from submitting
            $this.preventDefault();
            
            // Return all input controls to their default color
            //$(this).find("input, textarea, select").css({"border":"#CCC solid 1px"});
                    
            // Error flag
            var $no_error = true;
            
            // Serialize the form values
            var $form       = $(this).serializeArray(),
                $serialized = $(this).serialize();
            
            // Loop through the form values
            $.each($form, function( e, $form )
            {
                //alert($form.name + ' => ' + $form.value);
                var $div = $("#"+$form.name);
                
                if (($div.prop("validate") == "text") && ($div.prop("value") == ""))
                {
                    $div.focus().css({"border":"red solid 2px"});
                    
                    var $div_top  = $div.position().top + $div.height() + 18,
                        $div_left = $div.position().left - 100;
                    
                    // Positioning the tooltip
                    $validator.show_tooltip([{
                        'caller':$div,
                        'top':$div_top,
                        'left':$div_left,
                        'msg':'Please,&nbsp;fill&nbsp;out&nbsp;this&nbsp;field.'
                    }]);
                    
                    // Error flag
                    $no_error = false;
                    
                    return false;
                }
                
                else if (($div.prop("validate") == "select") && ($div.prop("value") == ""))
                {
                    $div.focus().css({"border":"red solid 2px"});
                    
                    var $div_top  = $div.position().top + $div.height() + 18,
                        $div_left = $div.position().left - 100;
                    
                    // Positioning the tooltip
                    $validator.show_tooltip([{
                        'caller':$div,
                        'top':$div_top,
                        'left':$div_left,
                        'msg':'Please,&nbsp;select&nbsp;this&nbsp;field.'
                    }]);
                    
                    // Error flag
                    $no_error = false;
                    
                    return false;
                }
            });
            
            if ($no_error)
            {
                $serialized = $serialized + "&opt=insert_patient";
                
                $.ajax({
                    url: "../calls/includes/switch.php",
                    type: "POST",
                    data: $serialized,
                    dataType: "json",
                    success: function($json)
                    {
                        if($json.status == "true")
                        {
                            $ui_engine.block({title:'Alert!',file:'alert_successful',width:'200',height:'120',buttons:'NNY'});
                            $file_loader.load_component('patients/fetch_patient');
                            $file_loader.load_side_kick('patients/patient_side_menu');
                        }
                        else
                        {
                            $ui_engine.block({title:'Alert!',file:'alert_failure',width:'200',height:'120',buttons:'NNY'});
                        }
                    },
                    error: function(request, status, error)
                    {
                        //alert(request.responseText);
                        $ui_engine.block({title:'Alert!',file:'alert_connection',width:'200',height:'120',buttons:'NNY'});
                    }
                });
            }
        });
    });
    
    // Process file upload
    var $process_uploader = function()
    {
        alert($('#fil_patient_pix').val());
        //alert($('#frm_new_patient').serialize());
    }
</script>