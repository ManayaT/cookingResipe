<?php
/*************************************************
 * 会員実行スクリプト
 * 
 */

define('_ROOT_DIR', __DIR__ . '/');
// ファイル（関数の読み込み）
require_once _ROOT_DIR . '../php_libs/init.php';
$controller = new MemberController_2();
$controller->run();

exit;