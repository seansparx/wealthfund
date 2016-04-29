<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();

function is_active($id, $status, $super_admin = false)
{
    if($super_admin) {
        return '--';
    }
    if(($status == '1') || ($status == 'yes')) {
        return '<a class="btn btn-primary btn-rounded btn-outline ladda-button active" href="javascript:void(0);" data-style="zoom-in" data-key="'.$id.'"><i class="fa fa-eye"></i> Active</a>';
    }
    else{
        return '<a class="btn btn-default btn-rounded btn-outline ladda-button inactive" href="javascript:void(0);" data-style="zoom-in" data-key="'.$id.'"><i class="fa fa-eye-slash"></i> Inactive</a>';
    }
}


function action_edit($id, $super_admin = false, $url = '')
{
    if($super_admin) {
        return '-';
    }
    ?>
    <a title="Edit Details" href="<?php echo $url.'/'.$id; ?>">
        <button type="button" class="btn btn-outline btn-success dim"><i class="fa fa-edit"></i></button>
    </a>   
    <?php
}


function action_delete($id, $super_admin = false, $url = '')
{
    if($super_admin) {
        return '-';
    }
    ?>
    <a href="<?php echo $url.'/'.$id; ?>"  title="Delete">
        <button title="Delete" type="button" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-outline btn-danger dim"><i class="fa fa-trash-o"></i></button>
    </a>    
    <?php
}


function action_permission($id, $super_admin = false, $url = '')
{
    if($super_admin) {
        return '-';
    }
    ?>   
    <a title="Access Permissions" href="<?php echo $url.'/'.$id; ?>">
        <button type="button" class="btn btn-outline btn-warning dim"><i class="fa fa-lock"></i></button>
    </a>
    <?php
}

/**
 * function to encode password 
 * @param string $password
 * @param string $salt
 * @return string $ciphertext;
 */
function encode_password($password, $salt) {
     $password = hash('sha512', $password);
    return hash('sha512', $password . $salt);
}

/**
 * function to return random salt
 * @return string;
 */
function random_salt() { 
    return hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
}

/**
 * Function to get Verification string
 * @param String $string
 * @return string;
 */
function verification_string($string) {
    return hash('sha512', uniqid($string . time(), true));
}



function loginCheck()
{   
    $CI = & get_instance();
    if (intval($CI->session->userdata('wealthfund_session')['wealthfund_user_id']) > 0) {
        return true;
    }else{
        return false;
    }
}


function loginLoginCheck()
{   
    $CI = & get_instance();
    $CI->load->model('login_model');
    $CI->login_model->checkSession();
//    if (intval($CI->session->userdata('wealthfund_session')['wealthfund_user_id']) > 0) {
//        return true;
//    }else{
//        return false;
//    }
}


/** Match site token 
 * 
 * @param string $token [ Optional ]
 * @return bool
 */
function match_token($token = null) 
{
    $CI = & get_instance();
    
    if($CI->input->get('token')){
        $token = $CI->input->get('token');
    }
    else if($CI->input->post('token')){
        $token = $CI->input->post('token');
    }
    
    if((decode($token) == ACCESS_TOKEN)){
        return true;
    }
    else{
        die("Token does not match.");
    }
}



/**
 * Get site token
 * 
 * @return string;
 */
function site_token()
{
    return encode(ACCESS_TOKEN);
}


/**
 * Function to encode plain text
 * @param string $plain_text 
 * @return string $ciphertext;
 */
function encode($plain_text) {
    $CI = & get_instance();
    $ciphertext = $CI->encrypt->encode($plain_text);
    $urisafe = strtr($ciphertext, '+/', '-_');
    return $urisafe;
}

/**
 * Function to decode plain text
 * @param string $ciphertext
 * @return string $plain_text;
 */
function decode($ciphertext) {
    $CI = & get_instance();
    $ciphertext = strtr($ciphertext, '-_', '+/');
    $plain_text = $CI->encrypt->decode($ciphertext);
    return $plain_text;
}

/**
 * Function to encrypt the plain text
 * @param string $plain_text
 * @return string $ciphertext;
 */
function encrypt($plain_text) {
    $CI = & get_instance();
    $ciphertext = $CI->encryption->encrypt($plain_text);
    return $ciphertext;
}

/**
 * Function to decrypt a text
 * @param string $ciphertext
 * @return string;
 */
function decrypt($ciphertext) {
    $CI = & get_instance();
    $plain_text = $CI->encryption->decrypt($ciphertext);
    return $plain_text;
}


/**
 *  Function To create Session
 * @param $userdata
 * @return Boolean
 * 
 */
function makeSession($authdata) 
{
    $CI = & get_instance();
    
    $CI->load->helper('yodlee');
    
    $user_browser = $_SERVER['HTTP_USER_AGENT'];    
    $sessArr[SITE_SESSION_NAME."session"] = array(SITE_SESSION_NAME . 'user_id' => $authdata->id, SITE_SESSION_NAME . 'name' =>$authdata->prefix.' '. $authdata->full_name, SITE_SESSION_NAME . 'login_string' => hash('sha512', $authdata->password . $user_browser));
        
    $CI->session->set_userdata($sessArr);
    
    return TRUE;
}


/**
 * Function to set flash message
 * @param string  $msg
 * @return void
 * 
 */
function success_msg($msg) {
    $CI = & get_instance();
    $CI->session->set_flashdata('success', $msg);
}

/**
 * Fucntion to set error message
 * @param type $msg
 * @return Void
 * 
 */
function error_msg($msg) {
    $CI = & get_instance();
    $CI->session->set_flashdata('error', $msg);
}


/**
 * function, receives string, returns seo friendly version for that strings, 
 *     sample: 'Hotels in Buenos Aires' => 'hotels-in-buenos-aires'
 *    - converts all alpha chars to lowercase
 *    - converts any char that is not digit, letter or - into - symbols into "-"
 *    - not allow two "-" chars continued, converte them into only one syngle "-"
 * @param $vp_string
 * @return string
 */
function friendly_seo_string($vp_string) {

    $vp_string = trim($vp_string);

    $vp_string = html_entity_decode($vp_string);

    $vp_string = strip_tags($vp_string);

    $vp_string = strtolower($vp_string);

    $vp_string = preg_replace('~[^ a-z0-9_.]~', ' ', $vp_string);

    $vp_string = preg_replace('~ ~', '-', $vp_string);

    $vp_string = preg_replace('~-+~', '-', $vp_string);

    return $vp_string;
}


/**
 *  Funciton to make user logout
 *  @return void
 *  
 */
function logout() 
{    
    unset($_SESSION);
    session_destroy();
    session_unset();
        
    redirect();
}


/**
 * Fucntion to remove directory
 * @param string $dir
 *@return Void 
 */
function rmdir_recursive($dir) {
    foreach (scandir($dir) as $file) {
        if ('.' === $file || '..' === $file)
            continue;
        if (is_dir("$dir/$file"))
            rmdir_recursive("$dir/$file");
        else
            unlink("$dir/$file");
    }
    rmdir($dir);
}

/**
 * Function to Center Crop
 * @param int $max_width
 * @param int $max_height
 * @param int $source_file
 * @param string $dst_dir
 * @param int $quality
 * @return void
 */
function crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80) {
    $imgsize = getimagesize($source_file);
    $width = $imgsize[0];
    $height = $imgsize[1];
    $mime = $imgsize['mime'];

    switch ($mime) {
        case 'image/gif':
            $image_create = "imagecreatefromgif";
            $image = "imagegif";
            break;

        case 'image/png':
            $image_create = "imagecreatefrompng";
            $image = "imagepng";
            $quality = 7;
            break;

        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            $image = "imagejpeg";
            $quality = 80;
            break;

        default:
            return false;
            break;
    }

    $dst_img = imagecreatetruecolor($max_width, $max_height);
    $src_img = $image_create($source_file);

    $width_new = $height * $max_width / $max_height;
    $height_new = $width * $max_height / $max_width;
    //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
    if ($width_new > $width) {
        $h_point = 5;
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    } else {
        $w_point = (($width - $width_new) / 2);
        imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    }

    $image($dst_img, $dst_dir, $quality);

    if ($dst_img)
        imagedestroy($dst_img);
    if ($src_img)
        imagedestroy($src_img);
}

/**
 * Function to Create all folders required in glufrag to upload files.
 * @param  no parameter
 * @return boolean
 */
function create_folders() {
    /** @temp exec("find $base_path -type d -exec chmod 0777 {} +"); */
    $folders = array();
    $folders[] = "files";
    
    foreach ($folders as $folder) {
        $Directory = SITE_ROOT . $folder;
        if (!file_exists($Directory)) {
            mkdir($Directory, 0755);
        }

    }
    return true;
}

/**
 * Function to Open a directory, and read its contents.
 * @param string $dir
 * 
 * @return void
 */
function list_dir_content($dir) {
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                echo "filename:" . $file . "<br>";
            }
            closedir($dh);
        }
    }
}


/** Set date time format.
 * 
 * @param string
 * @return string
 */
function date_time($date)
{
    return date("d M, Y h:i a", strtotime($date));
}

/**
 * Function to convert time in words format
 * @param datetime $date
 * @return string
 */
function time_ago($date) 
{
    if (empty($date)) {
        return "No date provided";
    }
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
    $now = time();
    $unix_date = strtotime($date);
    
    // check validity of date
    if (empty($unix_date)) {
        return "Bad date";
    }

    // is it future date or past date
    if ($now > $unix_date) {
        $difference = $now - $unix_date;
        $tense = "ago";
    } else {
        $difference = $unix_date - $now;
        $tense = "from now";
    }
    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }
    $difference = round($difference);
    if ($difference != 1) {
        $periods[$j].= "s";
    }
    return "$difference $periods[$j] {$tense}";
}


/**
 * Function to Get System Settings.
 * 
 * @param string $code [ Optional ]
 * 
 * @return mix
 */
function get_sys_config($code = null) {
    $CI = & get_instance();
    $CI->load->model('admin/system_model');
    return $CI->system_model->read($code);
}

function pr($post) {
    echo "<pre>";
    print_r($post);
    echo '</pre>';
}

?>
