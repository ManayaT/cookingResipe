<?php
/* Smarty version 3.1.30, created on 2024-05-20 16:04:44
  from "/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/system_login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_664af60c0ae3e6_68867555',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e9dee42707bfe0821d2e15bff57c3bb2d032b93' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/system_login.tpl',
      1 => 1506835186,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_664af60c0ae3e6_68867555 (Smarty_Internal_Template $_smarty_tpl) {
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
        <td>
	  <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
          <table>
            <tr>
              <th>管理画面:</th>
            </tr>
            <tr>
              <td><div style="text-align: right"><?php echo $_smarty_tpl->tpl_vars['form']->value['username']['label'];?>
:</div></td>
              <td> <?php echo $_smarty_tpl->tpl_vars['form']->value['username']['html'];?>
</td>
            </tr>

	    <tr>
          <td><div style="text-align: right"><?php echo $_smarty_tpl->tpl_vars['form']->value['password']['label'];?>
:</div></td>
              <td> <?php echo $_smarty_tpl->tpl_vars['form']->value['password']['html'];?>
</td>
            </tr>
            <tr>
              <td colspan="2" >
                <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
                <div style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>
</div>
		<br>
                <div style="color:red;font-size: smaller;"> <?php echo $_smarty_tpl->tpl_vars['auth_error_mess']->value;?>
 </div></td>
            </tr>
          </table>
	  </form>
	  
        </td>
        <td>
            <br>
            <br>
        </td>
      </tr>
    </table>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html><?php }
}
