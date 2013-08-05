<?php  
// Global Settings
/**
 * Global default timezone settings
 */
date_default_timezone_set('UTC');

// Physical
defined('ROOT')     ? NULL: define('ROOT', 'C:' .DIRECTORY_SEPARATOR. 'Program Files (x86)' .DIRECTORY_SEPARATOR. 'Zend' .DIRECTORY_SEPARATOR. 'Apache2' .DIRECTORY_SEPARATOR. 'htdocs' .DIRECTORY_SEPARATOR. 'hdi');
defined('CLASSES')  ? NULL: define('CLASSES', ROOT .DIRECTORY_SEPARATOR. 'calls' .DIRECTORY_SEPARATOR. 'classes');
defined('INCLUDES') ? NULL: define('INCLUDES', ROOT .DIRECTORY_SEPARATOR. 'calls' .DIRECTORY_SEPARATOR. 'includes');

function __autoload($class_name)
{
    $class_name = strtolower($class_name);
    $path = CLASSES .DIRECTORY_SEPARATOR. "{$class_name}.php";
    if(file_exists($path)) {
        require_once($path);
    } else {
        echo realpath(__DIR__);        
        //die("The file <b>{$class_name}.php</b> could not be found.");
    }
}

/*$menu         = (isset($menu)         && is_a($menu, 'Menu'))                 ? $menu: new Menu();
$user         = (isset($user)         && is_a($user, 'User'))                 ? $user: new User();
$doctor       = (isset($doctor)       && is_a($doctor, 'Doctor'))             ? $doctor: new Doctor();
$patient      = (isset($patient)      && is_a($patient, 'Patient'))           ? $patient: new Patient();
$country      = (isset($country)      && is_a($country, 'Country'))           ? $country: new Country();
$kinship      = (isset($kinship)      && is_a($kinship, 'Kinship'))           ? $kinship: new Kinship();
$relationship = (isset($relationship) && is_a($relationship, 'Relationship')) ? $relationship: new Relationship();
$occupation   = (isset($occupation)   && is_a($occupation, 'Occupation'))     ? $occupation: new Occupation();
$religion     = (isset($religion)     && is_a($religion, 'Religion'))         ? $religion: new Religion();
$hospital     = (isset($hospital)     && is_a($hospital, 'Hospital'))         ? $hospital: new Hospital();
$option       = (isset($option)       && is_a($option, 'Option'))             ? $option: new Option();
$session      = (isset($session)      && is_a($session, 'Session'))           ? $session: new Session();*/
?>