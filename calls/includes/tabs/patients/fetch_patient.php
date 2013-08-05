<?php
    require_once( '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'init.php' );
    require_once( '..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'functions.php' );
    
    // Class instances
    $session = new Session();
    $patient = new Patient();
    
    // Init.
    $title = $fname = $mname = $sname = $gender = $pid_alias = $last_visit = $visist_count = $address = $email = $phone1 = $phone2 = $ptype = $intdoc = $bloodtype = $rh = $refhospital = $extdoc = $status = $kin_fname = $kin_mname = $kin_sname = $kin_gender = $kin_address = $kin_email = $kin_phone1 = $kin_phone2 = $kin_relate = $dob = $marital = $religion = $occupation = $country = '';
    
    if (is_a($patient, 'Patient'))
    {
        // Init.
        $pid = '';
        
        // Fetching the Patient ID from memory
        if (is_a($session, 'Session')) $pid = $session->get_patient_id();
        
        $patient_arr = $patient->fetch_patient( $pid );
        if(!empty($patient_arr))
        {
            $title        = $patient_arr[0]['title'];
            $fname        = $patient_arr[0]['first_name'];
            $mname        = $patient_arr[0]['middle_name'];
            $sname        = $patient_arr[0]['surname'];
            $gender       = $patient_arr[0]['gender'];
            $pid_alias    = $patient_arr[0]['id_alias'];
            $last_visit   = $patient_arr[0]['last_visit_date'];
            $visist_count = $patient_arr[0]['visit_counter'];
            $address      = $patient_arr[0]['address'];
            $email        = $patient_arr[0]['email'];
            $phone1       = $patient_arr[0]['phone_1'];
            $phone2       = $patient_arr[0]['phone_2'];
            $ptype        = $patient_arr[0]['patient_type'];
            $intdoc       = $patient_arr[0]['assigned_doctor_id'];
            $bloodtype    = $patient_arr[0]['blood_type'];
            $rh           = $patient_arr[0]['rh'];
            $refhospital  = $patient_arr[0]['ref_hospital_id'];
            $extdoc       = $patient_arr[0]['ref_doctor_id'];
            $status       = $patient_arr[0]['account_status'];
            $kin_fname    = $patient_arr[0]['kin_first_name'];
            $kin_mname    = $patient_arr[0]['kin_middle_name'];
            $kin_sname    = $patient_arr[0]['kin_surname'];
            $kin_gender   = $patient_arr[0]['kin_gender'];
            $kin_address  = $patient_arr[0]['kin_address'];
            $kin_email    = $patient_arr[0]['kin_email'];
            $kin_phone1   = $patient_arr[0]['kin_phone_1'];
            $kin_phone2   = $patient_arr[0]['kin_phone_2'];
            $kin_relate   = $patient_arr[0]['relationship'];
            $dob          = $patient_arr[0]['date_of_birth'];
            $marital      = $patient_arr[0]['marital_status'];
            $religion     = $patient_arr[0]['religion'];
            $occupation   = $patient_arr[0]['occupation'];
            $country      = $patient_arr[0]['country'];
        }
    }
?>

<div class="outter_pad">
    <div class="l_float percent50">
        <div class="inner_pad">
            <div class="fieldset">
                <div class="legend">Personal Details:</div>
                <table class="visible_table">
                    <tr>
                        <td class="percent35">Title:</td>
                        <td class="bold"><?php echo get_id_desc($title, 'title'); ?></td>
                    </tr>
                    <tr>
                        <td class="percent35">First Name:</td>
                        <td class="bold"><?php echo $fname; ?></td>
                    </tr>
                    <tr>
                        <td>Middle Name:</td>
                        <td class="bold"><?php echo $mname; ?></td>
                    </tr>
                    <tr>
                        <td>Surname:</td>
                        <td class="bold"><?php echo $sname; ?></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td class="bold"><?php echo get_id_desc($gender, 'gender'); ?></td>
                    </tr>
                </table>
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
                                    <td>Patient&nbsp;ID:</td><td class="bold"><?php echo $pid_alias; ?></td>
                                </tr>
                                <tr>
                                    <td>Last&nbsp;Visit:</td><td class="bold">
                                        <?php
                                            // Init.
                                            $raw_date = $date = $visit_date = '';
                                            
                                            if ($last_visit != '')
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
                        <td class="bold"><?php echo $address; ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td class="bold"><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number 1:</td>
                        <td class="bold"><?php echo $phone1; ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number 2:</td>
                        <td class="bold"><?php echo $phone2; ?></td>
                    </tr>
                </table>
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
                        <td class="bold"><?php echo get_id_desc($ptype, 'patient_type'); ?></td>
                    </tr>
                    <tr>
                        <td>Assigned Doctor:</td>
                        <td class="bold"><?php echo get_id_desc($intdoc, 'doctor'); ?></td>
                    </tr>
                    <tr>
                        <td class="percent35">Blood Type:</td>
                        <td>
                            <table class="invisible_table">
                                <tr>
                                    <td class="percent40 bold" style="padding-left:0;padding-top:0;padding-bottom:0;">
                                        <?php echo get_id_desc($bloodtype, 'blood_type'); ?>
                                    </td>
                                    <td class="r_align" style="padding-left:20px;">RH:</td>
                                    <td class="percent40 bold" style="padding-right:0;padding-top:0;padding-bottom:0;">
                                        <?php echo get_id_desc($rh, 'rh'); ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Referring Hospital:</td>
                        <td class="bold"><?php echo get_id_desc($refhospital, 'hospital'); ?></td>
                    </tr>
                    <tr>
                        <td>Referring Doctor:</td>
                        <td class="bold"><?php echo get_id_desc($extdoc, 'doctor'); ?></td>
                    </tr>
                    <tr>
                        <td>Account Status:</td>
                        <td class="bold"><?php echo get_id_desc($status, 'account_status'); ?></td>
                    </tr>
                </table>
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
                        <td class="bold"><?php echo $kin_fname; ?></td>
                    </tr>
                    <tr>
                        <td>Middle Name:</td>
                        <td class="bold"><?php echo $kin_mname; ?></td>
                    </tr>
                    <tr>
                        <td>Surname:</td>
                        <td class="bold"><?php echo $kin_sname; ?></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td class="bold"><?php echo get_id_desc($kin_gender, 'gender'); ?></td>
                    </tr>
                    <tr>
                        <td class="percent35" style="vertical-align:top;">Address:</td>
                        <td class="bold"><?php echo $kin_address; ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td class="bold"><?php echo $kin_email; ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number 1:</td>
                        <td class="bold"><?php echo $kin_phone1; ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number 2:</td>
                        <td class="bold"><?php echo $kin_phone2; ?></td>
                    </tr>
                    <tr>
                        <td>Relationship:</td>
                        <td class="bold"><?php echo get_id_desc($kin_relate, 'relationship'); ?></td>
                    </tr>
                </table>
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
                                    <td class="percent70 bold" style="padding-left:0;padding-top:0;padding-bottom:0;">
                                        <?php
                                            // Init.
                                            $raw_date = $date = $age_date = $age_year = $age = '';
                                            
                                            if ($dob != '')
                                            {
                                                $raw_date = substr($dob, 0, 10);
                                                $date     = explode('-', $raw_date);
                                                $age_date = $date[2].'/'.$date[1].'/'.$date[0];
                                                $age_year = $date[0];
                                                $age      = date('Y') - $age_year;
                                                
                                                echo $age_date;
                                            }
                                        ?>
                                    </td>
                                    <td style="padding-right:0;padding-top:0;padding-bottom:0;">Age: <b><?php if ($age != '') echo $age; ?></b></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Marital Status:</td>
                        <td class="bold"><?php echo get_id_desc($marital, 'marital_status'); ?></td>
                    </tr>
                    <tr>
                        <td>Religion:</td>
                        <td class="bold"><?php echo get_id_desc($religion, 'religion'); ?></td>
                    </tr>
                    <tr>
                        <td>Occupation:</td>
                        <td class="bold"><?php echo get_id_desc($occupation, 'occupation'); ?></td>
                    </tr>
                    <tr>
                        <td>Country:</td>
                        <td class="bold"><?php echo get_id_desc($country, 'country'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="clear"></div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $init.equalize_heights(['#fieldset_contact','#fieldset_official']);
        $init.equalize_heights(['#fieldset_nok','#fieldset_other']);
    });
</script>