<?php
/* Smarty version 3.1.30, created on 2024-07-24 11:12:12
  from "/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/sign_up.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_66a062fc701249_90510022',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f035407a1f3a7317e13aef49a91962ced962f358' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/sign_up.tpl',
      1 => 1721711266,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a062fc701249_90510022 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <?php echo '<script'; ?>
 type="text/javascript" src="js/quickform.js" async><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="sign_up.css">
</head>
<body>
<div>
    <header>
        <h1>レシピ共有サイト</h1>
    </header>
    <main>
        <section class="user-registration">
            <h2>新規登録</h2>
            
            <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
            <?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>

            <table>  <!--tableにsubmitとかをおかないと，エラーメッセージでないよ-->
                <div style="font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['form']->value['username']['label'];?>
</div>
                <?php if (isset($_smarty_tpl->tpl_vars['form']->value['username']['error'])) {?>
                <div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['username']['error'];?>
</div>
                <?php }?>
                <?php echo $_smarty_tpl->tpl_vars['form']->value['username']['html'];?>


                <div style="font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['form']->value['mail_address']['label'];?>
</div>
                <?php if (isset($_smarty_tpl->tpl_vars['form']->value['mail_address']['error'])) {?>
                <div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['mail_address']['error'];?>
</div>
                <?php }?>
                <?php echo $_smarty_tpl->tpl_vars['form']->value['mail_address']['html'];?>


                <div style="font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['form']->value['password']['label'];?>
</div>
                <?php if (isset($_smarty_tpl->tpl_vars['form']->value['password']['error'])) {?>
                <div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['password']['error'];?>
</div>
                <?php }?>
                <?php echo $_smarty_tpl->tpl_vars['form']->value['password']['html'];?>


                <td>
                <button type="submit" id="confilm_b" value="登録" name="submit">登録</button>
                <?php if (($_smarty_tpl->tpl_vars['form']->value['submit2']['attribs']['value'] != '')) {?>
                <?php echo $_smarty_tpl->tpl_vars['form']->value['reset']['html'];?>
　<!--きっとこいつは入力フォームのリセット-->
                <?php }?>
                <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
                <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
                </td>
            </table>
            </form>
        </section>
    </main>
</div>
<?php if ($_smarty_tpl->tpl_vars['form']->value['javascript']) {?>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['javascript'];?>

<?php }?>
</body>
</html>
<?php }
}
