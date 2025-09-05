<?php
session_start();
require '../../config.php';
unset($_SESSION['token']);
$logAction->addLog('Logout success', 'Logout success', $userInfo['id']);
header("Location: ../../index.php");