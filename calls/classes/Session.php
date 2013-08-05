<?php
class Session
{
    private $logged_in  = false;
    private $patient_id = '';
    public  $user_id;
    
    
    function __construct()
    {
        if(session_id() == '')
        {
            // Start Session
            session_start();
        }
        
        // House keeping                
        $this->check_login();
                
        if($this->logged_in)
        {
            // actions to take right away if user is logged in
            //echo 'User is logged in';
        } else {
            // actions to take right away if user is not logged in
            //echo 'User is not logged in';
        }
    }
    
    public function is_logged_in()
    {
        return $this->logged_in;
    }
    
    public function login($user)
    {
        // database should find user based on username/password
        if($user)
        {
            $this->user_id   = $_SESSION['user_id'] = $user->id;
            $this->logged_in = true;
        }
    }
    
    public function set_patient_id($id)
    {
        $this->patient_id = $_SESSION['patient_id'] = $id;
    }
    
    public function get_patient_id()
    {
        if ($this->patient_id == '' && isset($_SESSION['patient_id'])) $this->patient_id = $_SESSION['patient_id'];
        return $this->patient_id;
    }
    
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->logged_in = false;
        
        // Redirect
        //redirect_to();
    }
    
    private function check_login()
    {
        if(isset($_SESSION['user_id']))
        {
            $this->user_id   = $_SESSION['user_id'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }
    
    public function redirect_to( $location = NULL )
    {
        if ($location != NULL)
        {
            header("Location: {$location}");
            exit;
        }
    }
} ?>