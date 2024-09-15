<?php
/* Smarty version 3.1.30, created on 2024-07-29 00:16:18
  from "/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/favorite.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_66a660c2a8cee2_50022975',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd471a3721bbc9106d0f93624e9091ce26fe9afa8' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/favorite.tpl',
      1 => 1722179098,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a660c2a8cee2_50022975 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お気に入り一覧</title>
    <link rel="stylesheet" href="favorite.css">

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

    <!-- お気に入り一覧 -->
    <section class="recipe-list">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
    <div class="recipe-item">
        <img class="recipe-photo" src=<?php echo $_smarty_tpl->tpl_vars['item']->value['recipe_picture'];?>
>
            <!-- 料理表示ページへのリンク -->
            <p><a class="recipe-name" href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=view_recipe&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['recipe_title'], ENT_QUOTES, 'UTF-8', true);?>
</a></p>
    </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </section>

    <!--
        <section class="favorites-list">
            <h2>お気に入り一覧</h2>
            <div class="recipe-item">
                <div class="recipe-photo">写真 1</div>
                <div class="recipe-name">料理名_1</div>
            </div>
            <div class="recipe-item">
                <div class="recipe-photo">写真 2</div>
                <div class="recipe-name">料理名_2</div>
            </div>
            <div class="recipe-item">
                <div class="recipe-photo">写真 3</div>
                <div class="recipe-name">料理名_3</div>
            </div>
        </section>
    -->
    </main>
</body>
</html>
<?php }
}
