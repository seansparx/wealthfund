<?php

$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/wealthfund/account/';

defined('BASE_URL') OR define('BASE_URL', $base_url);

if(isset($_SESSION['wealthfund_session']['wealthfund_user_id'])){
    header('Location: ' . $base_url);
}
?>