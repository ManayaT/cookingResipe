<?php
/* Smarty version 3.1.30, created on 2024-07-28 20:33:40
  from "/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/recipe.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_66a62c94e7ea91_28928818',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '29f38a5e13a68f99039cb69f65e23e737976ab51' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/recipe.tpl',
      1 => 1722166401,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a62c94e7ea91_28928818 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レシピ詳細</title>
    <link rel="stylesheet" href="recipe.css">
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
        <section class="recipe-detail">
            <h1><?php echo $_smarty_tpl->tpl_vars['data']->value['recipe_title'];?>
</h1>
            <img class="recipe-photo" src=<?php echo $_smarty_tpl->tpl_vars['data']->value['recipe_picture'];?>
>
            <div class="recipe-content">
                <h2>レシピ</h2>
                <p><?php echo $_smarty_tpl->tpl_vars['data']->value['recipe_text'];?>
</p>
            </div>

            <button class="favorite-button" type="button" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=favorite&id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
'">☆お気に入り</button>

        </section>

        <!-- 保留
        <section class="comments">
            <h2>コメント</h2>
            <div class="comment">
                <p><strong>User_1</strong></p>
                <p>User_1のコメントを表示</p>
                <button class="more-button">もっと見る</button>
            </div>
            <div class="comment-input">
                <textarea placeholder="ユーザが任意のコメントを記述"></textarea>
                <button class="submit-button">送信</button>
            </div>
        </section>
        -->
    </main>
</body>
</html>
<?php }
}
