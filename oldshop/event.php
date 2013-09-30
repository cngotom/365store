<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

define('IN_ECS', true);

require(ROOT_PATH . '/includes/init.php');
$result  = $smarty->fetch('library/event_info.lbi');
echo $result;



?>
