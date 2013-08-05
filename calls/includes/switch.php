<?php
    include_once('init.php');
    include_once('functions.php');
    
    // Switch
    if(isset($_POST['opt']))
    {
        switch($_POST['opt'])
        {
            case 'auth':
                // Init.
                $json = array();
                
                // User instance
                $user = new User();
                
                if ( is_a($user, 'User') )
                {
                    // Security check
                    $this_user = NULL;
                    $login_id  = trim($_POST['login_id']);
                    $passcode  = trim($_POST['passcode']);
                    
                    // Authentication message
                    $user_obj = $user->query(array(
                        'select' => 'id, passcode',
                        'from'   => 'users',
                        'where'  => "login_id='$login_id'",
                        'limit'  => '1',
                        'format' => 'Object'
                    ));
                    
                    if (!empty($user_obj))
                    {
                        foreach ($user_obj as $each_user)
                        {
                            if ($each_user->passcode == $passcode)
                            {
                                // Found user
                                $this_user = $each_user;
                                
                                // Exit loop
                                break;
                            }
                        }
                    }
                    
                    // Status message
                    if ( $this_user !== NULL )
                    {
                        // Session instance
                        $session = new Session();
                
                        if (is_a($session, 'Session'))
                        {
                            $session->login($this_user);
                            
                            $json['status'] = 'true';
                            $json['msg']    = 'Authenticated!';
                        }
                        else
                        {
                            $json['status'] = 'false';
                            $json['msg']    = '<b>SESSION ERROR:</b> Please, Try Again.';
                        }
                    }
                    else
                    {
                        $json['status'] = 'false';
                        $json['msg']    = '<b>ERROR:</b> Invalid Login Details';
                        
                        // Session instance
                        $session = new Session();
                
                        // Logout
                        if (is_a($session, 'Session')) $session->logout();
                    }
                } else {
                    $json['status'] = 'false';
                    $json['msg']    = '<b>ERROR:</b> Database Access Denied.';
                    
                    // Session instance
                    $session = new Session();
                    
                    // Logout
                    if (is_a($session, 'Session')) $session->logout();
                }
                
                echo json_encode($json);
            break;
            case 'exit':
                // Init.
                $json = array();
                
                // Session instance
                $session = new Session();
                
                if (is_a($session, 'Session'))
                {
                    // Logout
                    $session->logout();
                    
                    $json['status'] = 'true';
                    $json['msg']    = 'Logout!';
                }
                else
                {
                    $json['status'] = 'false';
                    $json['msg']    = '<b>SESSION ERROR:</b> Please, Try Again.';
                }
                
                echo json_encode($json);
            break;
            case 'ref_doc':
                // Init.
                $value = $_POST['value'];
                
                if (isset($value))
                {
                    // Doctor instance
                    $doctor = new Doctor();
    
                    // Doctors associated with a specific Hospital
                    $refdoc_arr = array();
                    $refdoc_arr = $doctor->query(array(
                        'select' => "CONCAT('Dr. ',surname,', ',first_name) as name, doctor_id as id",
                        'from'   => 'doctors',
                        'where'  => "doctor_type='EXT' AND hospital_id='$value'",
                        'order'  => 'surname',
                        'format' => 'Array'
                    ));
                    
                    if (!empty($refdoc_arr))
                    {
                        dropdown($refdoc_arr, 'sel_extdoc', '', '', 'selbox', '', 'Select:');
                    }
                    else
                    {
                        dropdown('', 'sel_extdoc', '', '', 'selbox', '', 'Select:');
                    }
                }
            break;
            case 'insert_patient':
                // Init.
                $json = array();
                
                // Patient instance
                $patient = new Patient();
                
                if (is_a($patient, 'Patient'))
                {
                    $status = $patient->insert_patient($_POST);
                    
                    if($status)
                    {
                        $json['status'] = 'true';
                    }
                    else
                    {
                        $json['status'] = 'false';
                    }
                }
                
                echo json_encode($json);
            break;
            case 'update_patient':
                // Init.
                $json = array();
                
                // Patient instance
                $patient = new Patient();
                
                if (('' != $_POST['txt_pid_alias']) && is_a($patient, 'Patient'))
                {
                    $status = $patient->update_patient($_POST);
                    
                    if($status)
                    {
                        $json['status'] = 'true';
                    }
                    else
                    {
                        $json['status'] = 'false';
                    }
                }
                
                echo json_encode($json);
            break;
            case 'alias_search':
                // Init.
                $pid            = '';
                $alias          = trim($_POST['alias']);
                $json['status'] = 'false';
                
                
                if ('' != $alias)
                {
                    // Patient instance
                    $patient = new Patient();
                    
                    if (is_a($patient, 'Patient'))
                    {
                        $pid = $patient->alias2id($alias);
                        
                        // Session instance
                        $session = new Session();
                        
                        if(('' != $pid) && is_a($session, 'Session'))
                        {
                            $session->set_patient_id($pid);
                            
                            $json['status'] = 'true';
                        }
                    }
                }
                
                echo json_encode($json);
            break;
            case 'access':
                switch($_POST['access_opt'])
                {
                    case 'form':
                        echo
                        "
                        <form name='frm_getaccess' id='frm_getaccess' method='post'>
                            <div id='access_msg' class='center gray'>(You are allowed to select multiple User types.)</div>
                            
                            <p class='bold pad15px'>How would you like to test this System?</p>
                            
                            <table class='invisible_table'>
                                <tr>
                                    <td class='gray percent1'><input name='chk_agtbro' id='chk_agtbro' type='checkbox' ".$_GET['chk_agtbro']." class='l_float' /></td>
                                    <td style='vertical-align: middle;'><label class='cursor_pointer blue' for='chk_agtbro'>As an Agent / Broker</label></td>
                                </tr>
                                <tr>
                                    <td class='gray'><input name='chk_staff' id='chk_staff' type='checkbox' ".$_GET['chk_staff']." class='l_float' /></td>
                                    <td style='vertical-align: middle;'><label class='cursor_pointer blue' for='chk_staff'>As Staff</label></td>
                                </tr>
                                <tr>
                                    <td class='gray'><input name='chk_client' id='chk_client' type='checkbox' ".$_GET['chk_client']." class='l_float' /></td>
                                    <td style='vertical-align: middle;'><label class='cursor_pointer blue' for='chk_client'>As a Client</label></td>
                                </tr>
                                <tr>
                                    <td class='gray'><input name='chk_mgt' id='chk_mgt' type='checkbox' ".$_GET['chk_mgt']." class='l_float' /></td>
                                    <td style='vertical-align: middle;'><label class='cursor_pointer blue' for='chk_mgt'>As Management</label></td>
                                </tr>
                            </table>
                            
                            <p class='bold pad15px'>Other details:</p>
                            
                            <table class='visible_table'>
                                <tr>
                                    <td class='percent30'>Surname:</td>
                                    <td><input name='csurname' id='csurname' value='".$_GET['csurname']."' class='txtbox' /></td>
                                </tr>
                                <tr>
                                    <td>Other Names:</td>
                                    <td><input name='cothname' id='cothname'  value='".$_GET['cothname']."' class='txtbox' /></td>
                                </tr>
                                <tr>
                                    <td>Company:</td>
                                    <td><input name='ccompany' id='ccompany' value='".$_GET['ccompany']."' class='txtbox' /></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><input name='cemail' id='cemail' value='".$_GET['cemail']."' class='txtbox' /></td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td class='l_align' style='padding: 0 6px 0 0'><input name='cgsm' id='cgsm' value='".$_GET['cgsm']."' class='txtbox' /></td>
                                                <td class='r_align dark_gray' style='padding: 0 0 0 6px;'> <b>e.g:</b>&nbsp;23480xxxxxxxx</td>
                                            </tr>
                                        </table>
                                </tr>
                                <tr>
                                    <td class='l_align'>&nbsp;</td>
                                    <td class='r_align'><button name='getaccess_btn' id='getaccess_btn' type='button' onclick=\"javascript:\$get_access(document.forms.frm_getaccess,'preview');\">&nbsp; Preview &#9658;</button></td>
                                </tr>
                                <tr>
                                    <td class='l_align' colspan='2'>
                                        <div class='font11 dark_gray'>Already have your Login details? <a href='#get_access' onclick='javascript:login_blocker();' class='orange bold'>Click here</a> to Login</div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        ";
                    break;
                    case 'preview':
                        echo
                        "
                        <form name='frm_getaccess' id='frm_getaccess' method='post'>
                            <div id='access_msg' class='center gray'>(<span class='coy_color'>Please, confirm your Selections.</span>)</div>
                            
                            <p class='bold pad15px'>You like to test the System:</p>
                            
                            <table class='invisible_table'>
                                <input type='hidden' name='chk_agtbro' id='chk_agtbro' value='".$_GET['chk_agtbro']."' />
                                <input type='hidden' name='chk_staff' id='chk_staff' value='".$_GET['chk_staff']."' />
                                <input type='hidden' name='chk_client' id='chk_client' value='".$_GET['chk_client']."' />
                                <input type='hidden' name='chk_mgt' id='chk_mgt' value='".$_GET['chk_mgt']."' />
                                ";
                            
                                if ($_GET['chk_agtbro'] == 'checked')
                                {
                                    echo " <tr>
                                                <td class='gray percent1'><img src='images/interface/prelogin/checkbox.png' /></td>
                                                <td style='vertical-align: middle;'>
                                                    <label class='blue'>As an Agent / Broker</label>
                                                </td>
                                            </tr>";
                                }
                            
                                if ($_GET['chk_staff'] == 'checked')
                                {
                                    echo " <tr>
                                                <td class='gray percent1'><img src='images/interface/prelogin/checkbox.png' /></td>
                                                <td style='vertical-align: middle;'>
                                                    <label class='blue'>As Staff</label>
                                                </td>
                                            </tr>";
                                }
                            
                                if ($_GET['chk_client'] == 'checked')
                                {
                                    echo " <tr>
                                                <td class='gray percent1'><img src='images/interface/prelogin/checkbox.png' /></td>
                                                <td style='vertical-align: middle;'>
                                                    <label class='blue'>As a Client</label>
                                                </td>
                                            </tr>";
                                }
                            
                                if ($_GET['chk_mgt'] == 'checked')
                                {
                                    echo " <tr>
                                                <td class='gray percent1'><img src='images/interface/prelogin/checkbox.png' /></td>
                                                <td style='vertical-align: middle;'>
                                                    <label class='blue'>As Management</label>
                                                </td>
                                            </tr>";
                                }
                                
                            echo "
                            </table>
                            
                            <p class='bold pad15px'>Other details:</p>
                            
                            <table class='visible_table'>
                                <tr>
                                    <td class='percent30'>Surname:</td>
                                    <td class='bold'>
                                        ".ucwords($_GET['csurname'])."
                                        <input type='hidden' name='csurname' id='csurname' value='".ucwords($_GET['csurname'])."' class='txtbox' />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Other Names:</td>
                                    <td class='bold'>
                                        ".ucwords($_GET['cothname'])."
                                        <input type='hidden' name='cothname' id='cothname' value='".ucwords($_GET['cothname'])."' class='txtbox' />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Company:</td>
                                    <td class='bold'>
                                        ".ucwords($_GET['ccompany'])."
                                        <input type='hidden' name='ccompany' id='ccompany' value='".ucwords($_GET['ccompany'])."' class='txtbox' />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class='bold'>
                                        ".strtolower($_GET['cemail'])."
                                        <input type='hidden' name='cemail' id='cemail' value='".strtolower($_GET['cemail'])."' class='txtbox' />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td class='l_align bold' style='padding-left: 0;'>
                                                    ".$_GET['cgsm']."                                                
                                                    <input type='hidden' name='cgsm' id='cgsm' value='".$_GET['cgsm']."' class='txtbox' />
                                                </td>
                                                <td class='r_align dark_gray'>&nbsp;</td>
                                            </tr>
                                        </table>
                                </tr>
                                <tr>
                                    <td class='l_align'><button name='getaccess_btn' id='getaccess_btn' type='button' onclick=\"javascript:\$get_access(document.forms.frm_getaccess,'form');\">&#9668; Edit &nbsp;</button></td>
                                    <td class='r_align'><button name='getaccess_btn' id='getaccess_btn' type='button' onclick=\"javascript:\$get_access(document.forms.frm_getaccess,'preview');\">&nbsp; Confirm &#9658;</button></td>
                                </tr>
                                <tr>
                                    <td class='l_align' colspan='2'>
                                        <div class='font11 dark_gray'>Already have your Login details? <a href='#get_access' onclick='javascript:login_blocker();' class='orange bold'>Click here</a> to Login</div>
                                    </td>
                                </tr>
                            </table>
                        </form>";
                    break;
                }
            break;
        }
    }
?>