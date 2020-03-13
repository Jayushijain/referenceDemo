<?php

include_once '../../includes/config.php';
include_once '../../classes/auth.class.php';

$auth = new Auth();

$auth->logout();
header('Location:'.ADMIN_URL);
exit();

?>