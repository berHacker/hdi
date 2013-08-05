<?php
class Kinship
{
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
        return Database::obj()->execute_query($sql,$format);
    }
    
    public function insert_kinship($post, $patient_id)
    {
            // SQL
            $sql = " INSERT INTO kinships (patient_id, first_name, middle_name, surname, gender, address, email, phone_1, phone_2, relationship)
                     VALUES (:patient_id, :first_name, :middle_name, :surname, :gender, :address, :email, :phone_1, :phone_2, :relationship) ";
            
            $first_name   = isset($post['txt_kin_fname'])    ? $post['txt_kin_fname']    : '';
            $middle_name  = isset($post['txt_kin_mname'])    ? $post['txt_kin_mname']    : '';
            $surname      = isset($post['txt_kin_sname'])    ? $post['txt_kin_sname']    : '';
            $gender       = isset($post['sel_kin_gender'])   ? $post['sel_kin_gender']   : '';
            $address      = isset($post['txta_kin_address']) ? $post['txta_kin_address'] : '';
            $email        = isset($post['txt_kin_email'])    ? $post['txt_kin_email']    : '';
            $phone_1      = isset($post['txt_kin_phone1'])   ? $post['txt_kin_phone1']   : '';
            $phone_2      = isset($post['txt_kin_phone2'])   ? $post['txt_kin_phone2']   : '';
            $relationship = isset($post['sel_kin_relate'])   ? $post['sel_kin_relate']   : '';
            
            // Bind
            $bind_array = array(
                ':patient_id'   => array($patient_id, PDO::PARAM_STR),
                ':first_name'   => array($first_name, PDO::PARAM_STR),
                ':middle_name'  => array($middle_name, PDO::PARAM_STR),
                ':surname'      => array($surname, PDO::PARAM_STR),
                ':gender'       => array($gender, PDO::PARAM_STR),
                ':address'      => array($address, PDO::PARAM_STR),
                ':email'        => array($email, PDO::PARAM_STR),
                ':phone_1'      => array($phone_1, PDO::PARAM_STR),
                ':phone_2'      => array($phone_2, PDO::PARAM_STR),
                ':relationship' => array($relationship, PDO::PARAM_INT)
            );
            
            // Execute
            return Database::obj()->execute_query($sql,'',$bind_array);
    }
    
    public function update_kinship($post, $patient_id)
    {
            // SQL
            $sql = " UPDATE kinships
            
                     SET first_name   = :first_name,
                         middle_name  = :middle_name,
                         surname      = :surname,
                         gender       = :gender,
                         address      = :address,
                         email        = :email,
                         phone_1      = :phone_1,
                         phone_2      = :phone_2,
                         relationship = :relationship
                         
                     WHERE patient_id = :patient_id
                   ";
            
            $first_name   = isset($post['txt_kin_fname'])    ? $post['txt_kin_fname']    : '';
            $middle_name  = isset($post['txt_kin_mname'])    ? $post['txt_kin_mname']    : '';
            $surname      = isset($post['txt_kin_sname'])    ? $post['txt_kin_sname']    : '';
            $gender       = isset($post['sel_kin_gender'])   ? $post['sel_kin_gender']   : '';
            $address      = isset($post['txta_kin_address']) ? $post['txta_kin_address'] : '';
            $email        = isset($post['txt_kin_email'])    ? $post['txt_kin_email']    : '';
            $phone_1      = isset($post['txt_kin_phone1'])   ? $post['txt_kin_phone1']   : '';
            $phone_2      = isset($post['txt_kin_phone2'])   ? $post['txt_kin_phone2']   : '';
            $relationship = isset($post['sel_kin_relate'])   ? $post['sel_kin_relate']   : '';
            
            // Bind
            $bind_array = array(
                ':patient_id'   => array($patient_id, PDO::PARAM_STR),
                ':first_name'   => array($first_name, PDO::PARAM_STR),
                ':middle_name'  => array($middle_name, PDO::PARAM_STR),
                ':surname'      => array($surname, PDO::PARAM_STR),
                ':gender'       => array($gender, PDO::PARAM_STR),
                ':address'      => array($address, PDO::PARAM_STR),
                ':email'        => array($email, PDO::PARAM_STR),
                ':phone_1'      => array($phone_1, PDO::PARAM_STR),
                ':phone_2'      => array($phone_2, PDO::PARAM_STR),
                ':relationship' => array($relationship, PDO::PARAM_INT)
            );
            
            // Execute
            return Database::obj()->execute_query($sql,'',$bind_array);
    }
}
?>