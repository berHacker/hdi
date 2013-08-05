<?php
    require_once( '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'init.php' );
    require_once( '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'functions.php' );
    
    // Class instances
    $session      = new Session();
    $patient      = new Patient();
    $doctor       = new Doctor();
    $hospital     = new Hospital();
    $option       = new Option();
    
    // Init.
    $title = $fname = $mname = $sname = $gender = $pid_alias = $last_visit = $visist_count = $address = $email = $phone1 = $phone2 = $ptype = $intdoc = $bloodtype = $rh = $refhospital = $extdoc = $account_status = $kin_fname = $kin_mname = $kin_sname = $kin_gender = $kin_address = $kin_email = $kin_phone1 = $kin_phone2 = $kin_relate = $dob = $marital_status = $religion = $occupation = $country = '';
    
    if (is_a($patient, 'Patient'))
    {
        // Init.
        $pid = '';
        
        // Fetching the Patient ID from memory
        if (is_a($session, 'Session')) $pid = $session->get_patient_id();
        
        $patient_arr = $patient->fetch_patient( $pid );
        if(!empty($patient_arr))
        {
            $title              = $patient_arr[0]['title'];
            $fname              = $patient_arr[0]['first_name'];
            $mname              = $patient_arr[0]['middle_name'];
            $sname              = $patient_arr[0]['surname'];
            $gender             = $patient_arr[0]['gender'];
            $pid_alias          = $patient_arr[0]['id_alias'];
            $last_visit         = $patient_arr[0]['last_visit_date'];
            $visist_count       = $patient_arr[0]['visit_counter'];
            $address            = $patient_arr[0]['address'];
            $email              = $patient_arr[0]['email'];
            $phone1             = $patient_arr[0]['phone_1'];
            $phone2             = $patient_arr[0]['phone_2'];
            $ptype              = $patient_arr[0]['patient_type'];
            $intdoc             = $patient_arr[0]['assigned_doctor_id'];
            $bloodtype          = $patient_arr[0]['blood_type'];
            $rh                 = $patient_arr[0]['rh'];
            $refhospital        = $patient_arr[0]['ref_hospital_id'];
            $extdoc             = $patient_arr[0]['ref_doctor_id'];
            $account_status     = $patient_arr[0]['account_status'];
            $kin_fname          = $patient_arr[0]['kin_first_name'];
            $kin_mname          = $patient_arr[0]['kin_middle_name'];
            $kin_sname          = $patient_arr[0]['kin_surname'];
            $kin_gender         = $patient_arr[0]['kin_gender'];
            $kin_address        = $patient_arr[0]['kin_address'];
            $kin_email          = $patient_arr[0]['kin_email'];
            $kin_phone1         = $patient_arr[0]['kin_phone_1'];
            $kin_phone2         = $patient_arr[0]['kin_phone_2'];
            $kin_relate         = $patient_arr[0]['relationship'];
            $dob                = $patient_arr[0]['date_of_birth'];
            $marital_status     = $patient_arr[0]['marital_status'];
            $religion           = $patient_arr[0]['religion'];
            $occupation         = $patient_arr[0]['occupation'];
            $country            = $patient_arr[0]['country'];
        }
    }
    
    // Init.
    $relation_arr = $patient_type_arr = $account_status_arr = $marital_status_arr = $religion_arr = $occupation_arr =  $country_arr = $title_arr = array();
    if (is_a($option, 'Option'))
    {
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
    
    // External Doctors
    $extdoc_arr = array();
    if (is_a($doctor, 'Doctor'))
    {
        $extdoc_arr = $doctor->query(array(
            'select' => "CONCAT('Dr. ',surname,', ',first_name) as name, doctor_id as id",
            'from'   => 'doctors',
            'where'  => "doctor_type='EXT' AND hospital_id='$refhospital'",
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
                            <td>
                                <?php dropdown($title_arr, 'sel_title', '', '', 'selbox', "$title", 'Select:'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="percent35">First Name:</td>
                            <td>
                                <input name="txt_fname" id="txt_fname" class="txtbox" value="<?php echo $fname; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Middle Name:</td>
                            <td>
                                <input name="txt_mname" id="txt_mname" class="txtbox" value="<?php echo $mname; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Surname:</td>
                            <td>
                                <input name="txt_sname" id="txt_sname" class="txtbox" value="<?php echo $sname; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td>
                                <?php
                                    $gender_arr = array();
                                    $gender_arr = item_array('gender');
                                    dropdown($gender_arr, 'sel_gender', '', '', 'selbox', "$gender", 'Select:');
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
                                    <img src="../calls/images/patients/sample.jpg" class="rnd_oooo" width="100px" alt="" />
                                </div>
                            </td>
                            <td class="percent100" style="vertical-align:top;">
                                <table class="visible_table">
                                    <tr>
                                        <td>Patient&nbsp;ID:</td>
                                        <td class="bold">
                                            <?php echo $pid_alias; ?>
                                            <input type="hidden" name="txt_pid_alias" id="txt_pid_alias" value="<?php echo $pid_alias; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Last&nbsp;Visit:</td>
                                        <td class="bold">
                                            <?php
                                                // Init.
                                                $raw_date = $date = $visit_date = '';
                                                
                                                if ('' != $last_visit)
                                                {
                                                    $raw_date   = substr($last_visit, 0, 10);
                                                    $date       = explode('-', $raw_date);
                                                    $visit_date = $date[2].'/'.$date[1].'/'.$date[0];
                                                    
                                                    echo $visit_date;
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No.&nbsp;of&nbsp;Visits:</td><td class="bold"><?php echo $visist_count; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- Tooltip -->
                    <!-- <div class="tooltip"><span class="dark_gray"></span><div class="tail"></div></div> -->
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
                                <textarea name="txta_address" id="txta_address" class="txtbox" rows="3"><?php echo $address; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>
                                <input name="txt_email" id="txt_email" class="txtbox" value="<?php echo $email; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone Number 1:</td>
                            <td>
                                <input name="txt_phone1"  id="txt_phone1" class="txtbox" value="<?php echo $phone1; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone Number 2:</td>
                            <td>
                                <input name="txt_phone2" id="txt_phone2" class="txtbox" value="<?php echo $phone2; ?>" />
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
                <div id="fieldset_official" class="fieldset">
                    <div class="legend">Official Details:</div>
                    <table class="visible_table">
                        <tr>
                            <td class="percent35">Patient Type:</td>
                            <td>
                                <?php dropdown($patient_type_arr,'sel_ptype','','','selbox',"$ptype",'Select'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Assigned Doctor:</td>
                            <td>
                                <?php dropdown($intdoc_arr, 'sel_intdoc', '', '', 'selbox', "$intdoc", 'Select:'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="percent35">Blood Type:</td>
                            <td>
                                <table class="invisible_table">
                                    <tr>
                                        <td class="percent40" style="padding-left:0;padding-top:0;padding-bottom:0;">
                                            <?php
                                                $blood_type_arr = '';
                                                $blood_type_arr = item_array('blood_type');
                                                dropdown($blood_type_arr, 'sel_bloodtype', '', '', 'selbox', "$bloodtype", 'Select:');
                                            ?>
                                        </td>
                                        <td class="r_align" style="padding-left:20px;">RH:</td>
                                        <td class="percent40" style="padding-right:0;padding-top:0;padding-bottom:0;">
                                            <?php
                                                $rh_arr = '';
                                                $rh_arr = item_array('rh');
                                                dropdown($rh_arr, 'sel_rh', '', '', 'selbox', "$rh", 'Select:');
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Referring Hospital:</td>
                            <td>
                                <?php dropdown($refhospital_arr, 'sel_refhospital', 'onchange', "\$ajax_loading('ref_doc','../calls/includes/switch.php','&opt=ref_doc&value='+this.value);", 'selbox', "$refhospital", 'Select:'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Referring Doctor:</td>
                            <td id="ref_doc">
                                <?php dropdown($extdoc_arr, 'sel_extdoc', '', '', 'selbox', "$extdoc", 'Select:'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Account Status:</td>
                            <td>
                                <?php dropdown($account_status_arr, 'sel_status', '', '', 'selbox', "$account_status", 'Select:'); ?>
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
                            <td>
                                <input name="txt_kin_fname" id="txt_kin_fname" class="txtbox" value="<?php echo $kin_fname; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Middle Name:</td>
                            <td>
                                <input name="txt_kin_mname" id="txt_kin_mname" class="txtbox" value="<?php echo $kin_mname; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Surname:</td>
                            <td>
                                <input name="txt_kin_sname" id="txt_kin_sname" class="txtbox" value="<?php echo $kin_sname; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td>
                                <?php
                                    $gender_arr = array();
                                    $gender_arr = item_array('gender');
                                    dropdown($gender_arr, 'sel_kin_gender', '', '', 'selbox', "$kin_gender", 'Select:');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="percent35" style="vertical-align:top;">Address:</td>
                            <td>
                                <textarea name="txta_kin_address" id="txta_kin_address" class="txtbox" rows="3"><?php echo $kin_address; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>
                                <input name="txt_kin_email" id="txt_kin_email" class="txtbox" value="<?php echo $kin_email; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone Number 1:</td>
                            <td>
                                <input name="txt_kin_phone1" id="txt_kin_phone1" class="txtbox" value="<?php echo $kin_phone1; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone Number 2:</td>
                            <td>
                                <input name="txt_kin_phone2" id="txt_kin_phone2" class="txtbox" value="<?php echo $kin_phone2; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Relationship:</td>
                            <td>
                                <?php dropdown($relation_arr, 'sel_kin_relate', '', '', 'selbox', "$kin_relate", 'Select:'); ?>
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
                <div id="fieldset_other" class="fieldset">
                    <div class="legend">Other Details:</div>
                    <table class="visible_table">
                        <tr>
                            <td class="percent35">Date of Birth:</td>
                            <td>
                                <table class="invisible_table">
                                    <tr>
                                        <td class="percent80 bold" style="padding-left:0;padding-top:0;padding-bottom:0;">
                                            <?php
                                                // Init.
                                                $raw_date = $date = $age_date = $age_year = $age = '';
                                                
                                                if ('' != $dob)
                                                {
                                                    $raw_date = substr($dob, 0, 10);
                                                    $date     = explode('-', $raw_date);
                                                    $age_date = $date[2].'/'.$date[1].'/'.$date[0];
                                                    $age_year = $date[0];
                                                    $age      = date('Y') - $age_year;
                                                } ?>
                                                
                                                <input name="txt_dob" id="txt_dob" class="txtbox" onchange="javascript:$date_engine.get_age(this.value,'#txt_age');" readonly="true" value="<?php echo $age_date; ?>" />
                                        </td>
                                        <td style="padding-right:0;padding-top:0;padding-bottom:0;">
                                            <input name="txt_age" id="txt_age" class="txtbox" onkeyup="javascript:$date_engine.get_dob(this.value,'#txt_dob');" value="<?php echo $age; ?>" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>Marital Status:</td>
                            <td>
                                <?php
                                    dropdown($marital_status_arr, 'sel_marital', '', '', 'selbox', "$marital_status", 'Select:');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Religion:</td>
                            <td>
                                <?php dropdown($religion_arr, 'sel_religion', '', '', 'selbox', "$religion", 'Select:'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Occupation:</td>
                            <td>
                                <?php dropdown($occupation_arr, 'sel_occupation', '', '', 'selbox', "$occupation", 'Select:'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td>
                                <?php dropdown($country_arr, 'sel_country', '', '', 'selbox', "$country", 'Select:'); ?>
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
                            <td colspan="2"><button type="submit">Update Patient</button></td>
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
            //{'name':'#txt_pid_alias','type':'text'}, // Patient ID
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
                $serialized = $serialized + "&opt=update_patient";
                
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
</script>