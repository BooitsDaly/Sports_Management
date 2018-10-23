<?php
/**
 * destroy session to logout
 */
session_start();
$_SESSION = array();
session_destroy();