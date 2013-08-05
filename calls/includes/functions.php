<?php
    //require_once('..'.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Utility.php');
    
    /**
     * pad()
     * 
     * Does all kinds of padding
     * 
     * e.g:
     * 
     * $x = '45';
     * pad($x, 5, 'x', 'right'); // '45xxx'
     * 
     * @param mixed $value
     * @param mixed $pad_len
     * @param string $pad_with
     * @param string $pad_pos
     * @return
     */
    function pad($value, $pad_len, $pad_with='0', $pad_pos='left')
    {
        // Padding position
        // STR_PAD_RIGHT, STR_PAD_LEFT, or STR_PAD_BOTH
        if (($pad_pos == 'l') || ($pad_pos == 'left'))
        {
            $pad_pos = STR_PAD_LEFT;
        }
        else if (($pad_pos == 'r') || ($pad_pos == 'right'))
        {
            $pad_pos = STR_PAD_RIGHT;
        }
        else if (($pad_pos == 'b') || ($pad_pos == 'both'))
        {
            $pad_pos = STR_PAD_BOTH;
        }
        
        return str_pad($value, $pad_len, $pad_with, $pad_pos);
    }
    
    /**
     * standardize_date()
     * 
     * Reformat a date
     * 
     * @return void
     */
    function standardize_date($date, $separator, $order='reverse')
    {
        // Explode the incoming date
        $dob_arr       = explode($separator, $date);
        
        // Reverse the ordering
        if ($order == 'reverse')
        {
            $date = $dob_arr[2] . '-' . $dob_arr[1] . '-' . $dob_arr[0] . ' 00:00:00';
        }
        
        return $date;
    }
    
    function dropdown($array,$name,$even_handler,$action,$class,$selected='',$first='')
    {
        // Init. return variable
        $build = '';
        
        if (!empty($array)) {
            // Start the selection drop-down menu build
            $build = '<select id="'.$name.'" name="'.$name.'" class="'.$class.'" '.$even_handler.'="'.$action.'">';
            
            // Setting the optional first value of the dropdown list
            if ($first != '') $build .= "<option value=''>$first</option>";
            
            foreach ($array as $each_instance)
            {
                $select = '';
                if ($each_instance['id'] == $selected) $select='SELECTED';
                $build .= '<option value="'.$each_instance['id'].'" '.$select.'>'.$each_instance['name'].'</option>';
            }
            
            // End the selection drop-down menu build
            $build .= '</select>';
        }
        else
        {
            $build  = '<select id="'.$name.'" name="'.$name.'" class="'.$class.'" '.$even_handler.'="'.$action.'">';
            $build .= '<option value="" >Select:</option>';
            $build .= '</select>';
        }
        
        //sleep(2);
        echo $build;
    }
    
    /**
     * get_id_desc()
     * 
     * This function is used to fetch the description for:
     * doctor, hospital, occupation, relationship, religion
     * 
     * @param mixed $id
     * @param mixed $handle
     * @return
     */
    function get_id_desc($id, $handle)
    {
        // Switch
        switch($handle)
        {
            case 'account_status':
                if ($obj = new Utility())
                {
                    $result_arr = $obj->query(array(
                        'select' => "option_name as name, option_id as id",
                        'from'   => 'options',
                        'where'  => "group_code='account_status' AND option_id='$id'",
                        'limit'  => '1',
                        'format' => 'Array'
                    ));
                    
                    if (!empty($result_arr)) return $result_arr[0]['name'];
                }
            break;
            case 'country':
                if ($obj = new Utility())
                {
                    $result_arr = $obj->query(array(
                        'select' => "option_name as name, option_id as id",
                        'from'   => 'options',
                        'where'  => "group_code='country' AND option_id='$id'",
                        'limit'  => '1',
                        'format' => 'Array'
                    ));
                    
                    if (!empty($result_arr)) return $result_arr[0]['name'];
                }
            break;
            case 'doctor':
                if ($obj = new Utility())
                {
                    $result_arr = $obj->query(array(
                        'select' => "CONCAT('Dr. ',surname,', ',first_name) as name",
                        'from'   => 'doctors',
                        'where'  => "doctor_id='$id'",
                        'limit'  => '1',
                        'format' => 'Array'
                    ));
                    
                    if (!empty($result_arr)) return $result_arr[0]['name'];
                }
            break;
            case 'hospital':
                if ($obj = new Utility())
                {
                    $result_arr = $obj->query(array(
                        'select' => "hospital_name as name, hospital_id as id",
                        'from'   => 'hospitals',
                        'where'  => "hospital_id='$id'",
                        'limit'  => '1',
                        'format' => 'Array'
                    ));
                    
                    if (!empty($result_arr)) return $result_arr[0]['name'];
                }
            break;
            case 'marital_status':
                if ($obj = new Utility())
                {
                    $result_arr = $obj->query(array(
                        'select' => "option_name as name, option_id as id",
                        'from'   => 'options',
                        'where'  => "group_code='marital_status' AND option_id='$id'",
                        'limit'  => '1',
                        'format' => 'Array'
                    ));
                    
                    if (!empty($result_arr)) return $result_arr[0]['name'];
                }
            break;
            case 'occupation':
                if ($obj = new Utility())
                {
                    $result_arr = $obj->query(array(
                        'select' => "option_name as name, option_id as id",
                        'from'   => 'options',
                        'where'  => "group_code='occupation' AND option_id='$id'",
                        'limit'  => '1',
                        'format' => 'Array'
                    ));
                    
                    if (!empty($result_arr)) return $result_arr[0]['name'];
                }
            break;
            case 'patient_type':
                if ($obj = new Utility())
                {
                    $result_arr = $obj->query(array(
                        'select' => "option_name as name, option_id as id",
                        'from'   => 'options',
                        'where'  => "group_code='patient_type' AND option_id='$id'",
                        'limit'  => '1',
                        'format' => 'Array'
                    ));
                    
                    if (!empty($result_arr)) return $result_arr[0]['name'];
                }
            break;
            case 'relationship':
                if ($obj = new Utility())
                {
                    $result_arr = $obj->query(array(
                        'select' => "option_name as name, option_id as id",
                        'from'   => 'options',
                        'where'  => "group_code='relationship' AND option_id='$id'",
                        'limit'  => '1',
                        'format' => 'Array'
                    ));
                    
                    if (!empty($result_arr)) return $result_arr[0]['name'];
                }
            break;
            case 'religion':
                if ($obj = new Utility())
                {
                    $result_arr = $obj->query(array(
                        'select' => "option_name as name, option_id as id",
                        'from'   => 'options',
                        'where'  => "group_code='religion' AND option_id='$id'",
                        'limit'  => '1',
                        'format' => 'Array'
                    ));
                    
                    if (!empty($result_arr)) return $result_arr[0]['name'];
                }
            break;
            case 'title':
                if ($obj = new Utility())
                {
                    $result_arr = $obj->query(array(
                        'select' => "option_name as name, option_id as id",
                        'from'   => 'options',
                        'where'  => "group_code='title' AND option_id='$id'",
                        'limit'  => '1',
                        'format' => 'Array'
                    ));
                    
                    if (!empty($result_arr)) return $result_arr[0]['name'];
                }
            break;
            // If $handle is not found, try to pull data from the item_array() function
            default:
                if (isset($handle) && ($handle != ''))
                {
                    $item_array = item_array($handle);
                    
                    if (!empty($item_array))
                    {
                        foreach ($item_array as $each_item)
                        {
                            if (isset($id) && ($id != '') && ($id == $each_item['id']))
                            {
                                return $each_item['name'];
                            }
                        }
                    }
                }
            break;
        }
    }
    
    function item_array($item)
    {
        // Init.
        $arr = array();
        
        // Switch
        switch($item)
        {
            case 'blood_type':
                $arr = array(
                    array('id' => 'O','name' => 'O'),
                    array('id' => 'A','name' => 'A'),
                    array('id' => 'B','name' => 'B'),
                    array('id' => 'AB','name' => 'AB')
                );
            break;
            case 'gender':
                $arr = array(
                    array('id' => 'F','name' => 'Female'),
                    array('id' => 'M','name' => 'Male')
                );
            break;
            case 'rh':
                $arr = array(
                    array('id' => 'P','name' => '+'),
                    array('id' => 'N','name' => '-')
                );
            break;
        }
        
        // Return
        return $arr;
    }
?>