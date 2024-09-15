<?php
/* Smarty version 3.1.30, created on 2024-07-28 01:20:25
  from "/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/premember_2.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_66a51e4983d0e9_60041016',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc3717c0321d74a608f508c62cb35fd0dd5f3bd6' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/premember_2.tpl',
      1 => 1722096744,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a51e4983d0e9_60041016 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<hr>
    <table>
      <tr>
        
      <td> <a href="index_2.php">トップページへ</a>
      </td>
        
      <td>
  		<?php echo $_smarty_tpl->tpl_vars['message']->value;?>


        </td>
      </tr>
    </table>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
