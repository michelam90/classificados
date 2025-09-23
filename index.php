<?php 
// função para declarar erros de tipo no código
declare(strict_types=1);

define('ACESSO_VALIDO', true);

require 'config/config.php';      
require 'classes/Ad.php';
require 'classes/AdCategory.php';
require 'helpers/CsrfValidator.php';
$ad = new Ad($pdo);
$categories = new AdCategory($pdo);

require 'pages/header.php';

$page = $_GET['page'] ?? 'home';

switch($page) {
    case 'ad-create':        
        require 'pages/ad/create.php';
        $logAction->addLog('Ad Create Page', 'Ad Create Page', $userInfo['id']);
        break;
    case 'ad-edit':
        require 'pages/ad/edit.php';
        $logAction->addLog('Ad Edit Page', 'Ad Edit Page', $userInfo['id']);
        break;
    case 'ad-my-ads':
        require 'pages/ad/my-ads.php';
        $logAction->addLog('My Ads Page', 'May Ads Page', $userInfo['id']);
        break;
    case 'ad-product':
        require 'pages/ad/product.php';
        $logAction->addLog('Product Page', 'Product Page', $userInfo['id']);
        break;
    case 'auth-login':
        require 'pages/auth/login.php';
        $logAction->addLog('Login Page', 'Login Page', $userInfo['id']);
        break;
    case 'auth-signup':
        require 'pages/auth/signup.php';
        $logAction->addLog('Signup Page', 'Signup Page', $userInfo['id']);
        break;    
    default:
        require 'pages/home.php';
        $logAction->addLog('Home Page', 'Home Page', $userInfo['id']);
}

require 'pages/footer.php';