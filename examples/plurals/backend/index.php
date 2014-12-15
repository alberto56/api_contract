<?php
/**
 * @file
 * A page request to the frontend.
 */

require_once('src/Backend.php');
$backend = new Backend();
echo $backend->getPage($_POST);
