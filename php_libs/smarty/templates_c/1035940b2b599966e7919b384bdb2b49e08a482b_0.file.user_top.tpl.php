<?php
/* Smarty version 3.1.30, created on 2024-07-28 18:15:29
  from "/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/user_top.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_66a60c31ecc303_93226787',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1035940b2b599966e7919b384bdb2b49e08a482b' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/user_top.tpl',
      1 => 1722158062,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a60c31ecc303_93226787 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>
    <link rel="stylesheet" href="user_top.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップ</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=search">レシピ検索</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=favorite_list">お気に入り</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="user-info">
            <h1><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['username']->value, ENT_QUOTES, 'UTF-8', true);?>
 のトップページ</h1>

            <!-- 会員情報の更新機能は使用しない予定
            <button class="update-button">会員情報を更新</button>
            -->

        </section>
        <section class="recipes">
            <div class="posted-recipes">
                <h2>投稿したレシピ</h2>

                <!-- 投稿レシピ表示OK -->
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
                <div class="recipe">
                    <img class="recipe-photo" src=<?php echo $_smarty_tpl->tpl_vars['item']->value['recipe_picture'];?>
>
                    <div class="recipe-details">
                        <!-- 料理表示ページへのリンク -->
                        <p><a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=view_recipe&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['recipe_title'], ENT_QUOTES, 'UTF-8', true);?>
</a></p>
                        <!-- 削除ボタン -->
                        <button class="delete-button" type="button" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=delete&action=confirm&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'">削除</button>
                    </div>
                </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </div>

            <button class="post-recipe-button" type="button" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=upload'">レシピを投稿する</button>
        </section>
        <a class="logout" href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=logout">ログアウト</a>
    </main>
</body>
</html>
<?php }
}
