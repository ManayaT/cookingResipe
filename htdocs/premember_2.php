<?php
/*************************************************
 * 会員本登録用スクリプト
 * 
 */

// メールで送信されてくるリンク（リダイレクトなし）
define('_ROOT_DIR', __DIR__ . '/');
require_once _ROOT_DIR . '../php_libs/init.php';
$controller = new PrememberController_2();
$controller->run();

exit;