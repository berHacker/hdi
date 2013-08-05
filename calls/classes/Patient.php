<?php
require_once( INCLUDES.DIRECTORY_SEPARATOR.'functions.php' );

class Patient
{
    private $database_obj = NULL;
    private $session_obj  = NULL;
    private $kinship_obj  = NULL;
    
    public function __construct()
    {
        $this->database_obj = Database::obj();
        $this->session_obj  = new Session();
        $this->kinship_obj  = new Kinship();
    }
    
    public function query($args=array())
    {
        // SQL
        $sql    = (isset($args['select'])) ? " SELECT {$args['select']} "  : '';
        $sql   .= (isset($args['from']))   ? " FROM {$args['from']} "      : '';
        $sql   .= (isset($args['where']))  ? " WHERE {$args['where']} "    : '';
        $sql   .= (isset($args['group']))  ? " GROUP BY {$args['group']} " : '';
        $sql   .= (isset($args['order']))  ? " ORDER BY {$args['order']} " : '';
        $sql   .= (isset($args['limit']))  ? " LIMIT {$args['limit']} "    : '';
        
        // Format
        $format = (isset($args['format'])) ? $args['format'] : 'Object';
        
        // Return
        return $this->database_obj->execute_query($sql,$format);
    }
    
    public function alias2id($alias)
    {
        $alias_arr = $this->query(array(
            'select' => 'patient_id',
            'from'   => 'patients',
            'where'  => "id_alias = '$alias'",
            'limit'  => '1',
            'format' => 'Array'
        ));
        
        if (!empty($alias_arr))
        {
            return $alias_arr[0]['patient_id'];
        }
    }
    
    public function id2alias($id)
    {
        $id_arr = $this->query(array(
            'select' => 'id_alias',
            'from'   => 'patients',
            'where'  => "patient_id = '$id'",
            'limit'  => '1',
            'format' => 'Array'
        ));
        
        if (!empty($id_arr))
        {
            return $id_arr[0]['id_alias'];
        }
    }
    
    public function insert_patient($post)
    {
        // Start transaction
        $this->database_obj->begin_transaction();
        
        // SQL
        $sql = " INSERT INTO patients (id_alias, title, first_visit_date, last_visit_date, visit_counter, first_name, middle_name, surname, gender, address, email, phone_1, phone_2, date_of_birth, marital_status, religion, occupation, patient_type, blood_type, rh, account_status, assigned_doctor_id, country, ref_hospital_id, ref_doctor_id)
                 VALUES (:id_alias, :title, :first_visit_date, :last_visit_date, :visit_counter, :first_name, :middle_name, :surname, :gender, :address, :email, :phone_1, :phone_2, :date_of_birth, :marital_status, :religion, :occupation, :patient_type, :blood_type, :rh, :account_status, :assigned_doctor_id, :country, :ref_hospital_id, :ref_doctor_id) ";
        
        // Variables
        $id_alias           = isset($post['txt_pid_alias'])   ? trim($post['txt_pid_alias']) : '';
        $title              = isset($post['sel_title'])       ? trim($post['sel_title'])     : '';
        $first_visit_date   = date('Y-m-d 00:00:00');
        $last_visit_date    = date('Y-m-d 00:00:00');
        $visit_counter      = 1;
        $first_name         = isset($post['txt_fname'])       ? trim($post['txt_fname'])     : '';
        $middle_name        = isset($post['txt_mname'])       ? trim($post['txt_mname'])     : '';
        $surname            = isset($post['txt_sname'])       ? trim($post['txt_sname'])     : '';
        $gender             = isset($post['sel_gender'])      ? trim($post['sel_gender'])    : '';
        $address            = isset($post['txta_address'])    ? trim($post['txta_address'])  : '';
        $email              = isset($post['txt_email'])       ? trim($post['txt_email'])     : '';
        $phone_1            = isset($post['txt_phone1'])      ? trim($post['txt_phone1'])    : '';
        $phone_2            = isset($post['txt_phone2'])      ? trim($post['txt_phone2'])    : '';
        // Reformating the Date of Birth (dob)
        if(isset($post['txt_dob'])) {
            $date_of_birth = standardize_date($post['txt_dob'], '/');
        } else {
            $date_of_birth = '0000-00-00 00:00:00';
        }
        $patient_type       = isset($post['sel_ptype'])       ? $post['sel_ptype']           : '';
        $assigned_doctor_id = isset($post['sel_intdoc'])      ? $post['sel_intdoc']          : '';
        $blood_type         = isset($post['sel_bloodtype'])   ? $post['sel_bloodtype']       : '';
        $rh                 = isset($post['sel_rh'])          ? $post['sel_rh']              : '';
        $ref_hospital_id    = isset($post['sel_refhospital']) ? $post['sel_refhospital']     : '';
        $ref_doctor_id      = isset($post['sel_extdoc'])      ? $post['sel_extdoc']          : '';
        $account_status     = isset($post['sel_status'])      ? $post['sel_status']          : '';
        $marital_status     = isset($post['sel_marital'])     ? $post['sel_marital']         : '';
        $religion           = isset($post['sel_religion'])    ? $post['sel_religion']        : '';
        $occupation         = isset($post['sel_occupation'])  ? $post['sel_occupation']      : '';
        $country            = isset($post['sel_country'])     ? $post['sel_country']         : '';
        
        // Bind
        $bind_array = array(
            ':id_alias'           => array($id_alias, PDO::PARAM_STR),
            ':title'              => array($title, PDO::PARAM_INT),
            ':first_visit_date'   => array($first_visit_date, PDO::PARAM_STR),
            ':last_visit_date'    => array($last_visit_date, PDO::PARAM_STR),
            ':visit_counter'      => array($visit_counter, PDO::PARAM_INT),
            ':first_name'         => array($first_name, PDO::PARAM_STR),
            ':middle_name'        => array($middle_name, PDO::PARAM_STR),
            ':surname'            => array($surname, PDO::PARAM_STR),
            ':gender'             => array($gender, PDO::PARAM_STR),
            ':address'            => array($address, PDO::PARAM_STR),
            ':email'              => array($email, PDO::PARAM_STR),
            ':phone_1'            => array($phone_1, PDO::PARAM_STR),
            ':phone_2'            => array($phone_2, PDO::PARAM_STR),
            ':date_of_birth'      => array($date_of_birth, PDO::PARAM_STR),
            ':patient_type'       => array($patient_type, PDO::PARAM_INT),
            ':assigned_doctor_id' => array($assigned_doctor_id, PDO::PARAM_INT),
            ':blood_type'         => array($blood_type, PDO::PARAM_STR),
            ':rh'                 => array($rh, PDO::PARAM_STR),
            ':ref_hospital_id'    => array($ref_hospital_id, PDO::PARAM_INT),
            ':ref_doctor_id'      => array($ref_doctor_id, PDO::PARAM_INT),
            ':account_status'     => array($account_status, PDO::PARAM_INT),
            ':marital_status'     => array($marital_status, PDO::PARAM_INT),
            ':religion'           => array($religion, PDO::PARAM_INT),
            ':occupation'         => array($occupation, PDO::PARAM_INT),
            ':country'            => array($country, PDO::PARAM_INT)
        );
        
        // Execute
        $status = $this->database_obj->execute_query($sql,'',$bind_array);
        
        // Transaction status
        if ($status === true)
        {
            // Fetch the last inserted Patient ID
            $patient_id = $this->database_obj->last_insert_id();
            
            if (is_a( $this->kinship_obj, 'Kinship' ))
            {
                // Insert the Kinship (Next of Kin)
                $status = $this->kinship_obj->insert_kinship($post, $patient_id);
            }
            else
            {
                $status = false;
            }
            
            if ($status === true)
            {
                if (is_a( $this->session_obj, 'Session' ))
                {
                    // Store the Patient ID in memory
                    $this->session_obj->set_patient_id($patient_id);
                    
                    // Commit transaction
                    $this->database_obj->commit_transaction();
                }
                else
                {
                    // Roll back transaction
                    $this->database_obj->roll_back();
                }
            }
            else
            {
                // Roll back transaction
                $this->database_obj->roll_back();
            }
        }
        else
        {
            // Roll back transaction
            $this->database_obj->roll_back();
        }
        
        // Return
        return $status;
    }
    
    public function update_patient()
    {
        // Start transaction
        $this->database_obj->begin_transaction();
        
        // SQL
        $sql = " UPDATE patients
        
                 SET title              = :title,
                     first_visit_date   = :first_visit_date,
                     last_visit_date    = :last_visit_date,
                     visit_counter      = :visit_counter,
                     first_name         = :first_name,
                     middle_name        = :middle_name,
                     surname            = :surname,
                     gender             = :gender,
                     address            = :address,
                     email              = :email,
                     phone_1            = :phone_1,
                     phone_2            = :phone_2,
                     date_of_birth      = :date_of_birth,
                     marital_status     = :marital_status,
                     religion           = :religion,
                     occupation         = :occupation,
                     patient_type       = :patient_type,
                     blood_type         = :blood_type,
                     rh                 = :rh,
                     account_status     = :account_status,
                     assigned_doctor_id = :assigned_doctor_id,
                     country            = :country,
                     ref_hospital_id    = :ref_hospital_id,
                     ref_doctor_id      = :ref_doctor_id
                     
                  WHERE patient_id      = :patient_id
                 ";
        
        // Variables
        $id_alias           = isset($post['txt_pid_alias'])   ? trim($post['txt_pid_alias']) : '';
        $patient_id         = $this->alias2id($id_alias);
        $title              = isset($post['sel_title'])       ? $post['sel_title']           : '';
        $first_visit_date   = date('Y-m-d 00:00:00');
        $last_visit_date    = date('Y-m-d 00:00:00');
        $visit_counter      = 1;
        $first_name         = isset($post['txt_fname'])       ? trim($post['txt_fname'])     : '';
        $middle_name        = isset($post['txt_mname'])       ? trim($post['txt_mname'])     : '';
        $surname            = isset($post['txt_sname'])       ? trim($post['txt_sname'])     : '';
        $gender             = isset($post['sel_gender'])      ? $post['sel_gender']          : '';
        $address            = isset($post['txta_address'])    ? trim($post['txta_address'])  : '';
        $email              = isset($post['txt_email'])       ? trim($post['txt_email'])     : '';
        $phone_1            = isset($post['txt_phone1'])      ? trim($post['txt_phone1'])    : '';
        $phone_2            = isset($post['txt_phone2'])      ? trim($post['txt_phone2'])    : '';
        // Reformating the Date of Birth (dob)
        if(isset($post['txt_dob'])) {
            $date_of_birth = standardize_date($post['txt_dob'], '/');
        } else {
            $date_of_birth = '0000-00-00 00:00:00';
        }
        $patient_type       = isset($post['sel_ptype'])       ? $post['sel_ptype']           : '';
        $assigned_doctor_id = isset($post['sel_intdoc'])      ? $post['sel_intdoc']          : '';
        $blood_type         = isset($post['sel_bloodtype'])   ? $post['sel_bloodtype']       : '';
        $rh                 = isset($post['sel_rh'])          ? $post['sel_rh']              : '';
        $ref_hospital_id    = isset($post['sel_refhospital']) ? $post['sel_refhospital']     : '';
        $ref_doctor_id      = isset($post['sel_extdoc'])      ? $post['sel_extdoc']          : '';
        $account_status     = isset($post['sel_status'])      ? $post['sel_status']          : '';
        $marital_status     = isset($post['sel_marital'])     ? $post['sel_marital']         : '';
        $religion           = isset($post['sel_religion'])    ? $post['sel_religion']        : '';
        $occupation         = isset($post['sel_occupation'])  ? $post['sel_occupation']      : '';
        $country            = isset($post['sel_country'])     ? $post['sel_country']         : '';
        
        // Bind
        $bind_array = array(
            ':patient_id'         => array($patient_id, PDO::PARAM_INT),
            ':title'              => array($title, PDO::PARAM_INT),
            ':first_visit_date'   => array($first_visit_date, PDO::PARAM_STR),
            ':last_visit_date'    => array($last_visit_date, PDO::PARAM_STR),
            ':visit_counter'      => array($visit_counter, PDO::PARAM_INT),
            ':first_name'         => array($first_name, PDO::PARAM_STR),
            ':middle_name'        => array($middle_name, PDO::PARAM_STR),
            ':surname'            => array($surname, PDO::PARAM_STR),
            ':gender'             => array($gender, PDO::PARAM_STR),
            ':address'            => array($address, PDO::PARAM_STR),
            ':email'              => array($email, PDO::PARAM_STR),
            ':phone_1'            => array($phone_1, PDO::PARAM_STR),
            ':phone_2'            => array($phone_2, PDO::PARAM_STR),
            ':date_of_birth'      => array($date_of_birth, PDO::PARAM_STR),
            ':patient_type'       => array($patient_type, PDO::PARAM_INT),
            ':assigned_doctor_id' => array($assigned_doctor_id, PDO::PARAM_INT),
            ':blood_type'         => array($blood_type, PDO::PARAM_STR),
            ':rh'                 => array($rh, PDO::PARAM_STR),
            ':ref_hospital_id'    => array($ref_hospital_id, PDO::PARAM_INT),
            ':ref_doctor_id'      => array($ref_doctor_id, PDO::PARAM_INT),
            ':account_status'     => array($account_status, PDO::PARAM_INT),
            ':marital_status'     => array($marital_status, PDO::PARAM_INT),
            ':religion'           => array($religion, PDO::PARAM_INT),
            ':occupation'         => array($occupation, PDO::PARAM_INT),
            ':country'            => array($country, PDO::PARAM_INT)
        );
        
        // Execute
        $status = $this->database_obj->execute_query($sql,'',$bind_array);
        
        // Transaction status
        if ($status === true)
        {            
            if (is_a( $this->kinship_obj, 'Kinship' ))
            {
                // Insert the Kinship (Next of Kin)
                $status = $this->kinship_obj->update_kinship($post, $patient_id);
            }
            else
            {
                $status = false;
            }
            
            if ($status === true)
            {
                if (is_a( $this->session_obj, 'Session' ))
                {
                    // Store the Patient ID in memory
                    $this->session_obj->set_patient_id($patient_id);
                    
                    // Commit transaction
                    $this->database_obj->commit_transaction();
                }
                else
                {
                    // Roll back transaction
                    $this->database_obj->roll_back();
                }
            }
            else
            {
                // Roll back transaction
                $this->database_obj->roll_back();
            }
        }
        else
        {
            // Roll back transaction
            $this->database_obj->roll_back();
        }
        
        // Return
        return $status;
    }
    
    public function fetch_patient($id)
    {
        // SQL
        $sql = "SELECT p.title, p.id_alias, p.first_visit_date, p.last_visit_date, p.visit_counter, p.first_name,
                       p.middle_name, p.surname, p.gender, p.address, p.email, p.phone_1, p.phone_2, p.date_of_birth,
                       p.marital_status, p.religion, p.occupation, p.patient_type, p.blood_type, p.rh, p.account_status,
                       p.assigned_doctor_id, p.country, p.ref_hospital_id, p.ref_doctor_id, k.first_name AS kin_first_name,
                       k.middle_name AS kin_middle_name, k.surname AS kin_surname, k.gender AS kin_gender, k.address AS kin_address, k.email AS kin_email, k.phone_1 AS kin_phone_1, k.phone_2 AS kin_phone_2, k.relationship
                FROM patients p
                INNER JOIN kinships k
                ON p.patient_id=k.patient_id
                WHERE p.patient_id='{$id}'
                LIMIT 1";
        
        // Execute
        return $this->database_obj->execute_query($sql,'A');
    }
} ?>