<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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


function match_token($id) {
    $CI = & get_instance();
    $token = decode($CI->input->get('token'));
    if (intval($id) == intval($token)) {
        return true;
    } else {
        show_error("Token has been expired.<a href='" . site_url('admin/dashboard') . "'>Go to dashboard</a>");
    }
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
function makeSession($authdata) {

    $CI = & get_instance();
    $user_browser = $_SERVER['HTTP_USER_AGENT'];    
    $se_arr = array(SITE_SESSION_NAME . 'user_id' => $authdata->id, SITE_SESSION_NAME . 'name' => $authdata->full_name, SITE_SESSION_NAME . 'login_string' => hash('sha512', $authdata->password . $user_browser));

    $sessArr[SITE_SESSION_NAME . "session"] = $se_arr;
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
 * Function to check login session
 * 
 * @return boolean;
 */
function login_check() 
{
    $CI = & get_instance();
    
}

/**
 *  Funciton to make user logout
 *  @return void
 *  
 */
function logout() {
    $CI = & get_instance();
    session_destroy();
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


/**
 * Function to convert time in words format
 * @param datetime $date
 * @return string
 */
function time_ago($date) {
    if (empty($date)) {
        return "No date provided";
    }

    $periods = array("Sec", "Min", "Hr", "d", "wk", "mth", "yr", "dcd");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    /** Convert GMT to Central European Time */
    $now = date("Y-m-d H:i:s");

    $now = strtotime($now);
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

    return "$difference $periods[$j] ";
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
