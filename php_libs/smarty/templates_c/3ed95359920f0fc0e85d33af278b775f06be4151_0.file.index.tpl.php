<?php
/* Smarty version 3.1.30, created on 2024-07-28 10:48:36
  from "/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_66a5a374abe756_10142708',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3ed95359920f0fc0e85d33af278b775f06be4151' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/index.tpl',
      1 => 1722131313,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a5a374abe756_10142708 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <h1>レシピ共有サイト</h1>
    </header>
    <main>
        <section class="admin-login">
        
            <!-- <form action="/index_2.php" method="post"> -->
            <!-- <label for="admin-name">メールアドレス</label>
                <input type="text" id="admin-name" name="mail_address" placeholder="AdmName">
            <label for="password">パスワード</label>
                <input type="password" id="password" name="password" placeholder="PassWord">
            </form> -->

            <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
            <table>
          
            <div style="font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['form']->value['mail_address']['label'];?>
</div>
            <?php echo $_smarty_tpl->tpl_vars['form']->value['mail_address']['html'];?>

            <div style="font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['form']->value['password']['label'];?>
</div>
            <?php echo $_smarty_tpl->tpl_vars['form']->value['password']['html'];?>


<!--
            <tr>
              <td colspan="2" >
                <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
                <div style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>
</div>

                <div style="color:red; font-size: smaller;"> <?php echo $_smarty_tpl->tpl_vars['auth_error_mess']->value;?>
 </div></td>
            </tr>
-->
            <td colspan="2" >
                <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
                <button type="submit" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" name="submit" id="submit-0">ログイン</button>
                </td>
                <div style="color:red; font-size: smaller;"> <?php echo $_smarty_tpl->tpl_vars['auth_error_mess']->value;?>
 </div>            
          </table>
	  </form>
            <!--
            <form action="/index_2.php?type=regist&action=form" method="post">
                <button type="submit">サインアップ</button>
            </form> -->

            <button type="button" onclick="location.href='/index_2.php?type=regist&action=form'">サインアップ</button>

        </section>
    </main>
</body>
</html>
<?php }
}
