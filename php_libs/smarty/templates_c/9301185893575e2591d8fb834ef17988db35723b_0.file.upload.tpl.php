<?php
/* Smarty version 3.1.30, created on 2024-07-29 00:45:38
  from "/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/upload.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_66a667a200d4a3_01084204',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9301185893575e2591d8fb834ef17988db35723b' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/php_libs/smarty/templates/upload.tpl',
      1 => 1722181534,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a667a200d4a3_01084204 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レシピ投稿フォーム</title>
    <link rel="stylesheet" href="upload_form.css">
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
        <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
 class="recipe-form" enctype="multipart/form-data">
        <?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>


        <h2>レシピ投稿 フォーム</h2>

        <div class="form-group">
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['recipe_name']['error'])) {?>
            <div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['recipe_name']['error'];?>
</div>
            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['form']->value['recipe_name']['html'];?>

        </div>

        <div class="form-group file-upload-group">
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['recipe_image']['error'])) {?>
            <div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['recipe_image']['error'];?>
</div>
            <?php }?>
            <input type="file" id="image-file" name="<?php echo $_smarty_tpl->tpl_vars['form']->value['recipe_image']['name'];?>
" accept="image/*" onchange="displayFileName()">
            <input type="text" id="file-name" readonly>
            <label for="image-file" class="file-label">ファイルを選択</label>
        </div>

        <div class="form-group">
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['recipe_text']['error'])) {?>
            <div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['recipe_text']['error'];?>
</div>
            <?php }?>
            <textarea name="<?php echo $_smarty_tpl->tpl_vars['form']->value['recipe_text']['name'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['form']->value['recipe_text']['id'];?>
" rows="10" cols="50"><?php echo $_smarty_tpl->tpl_vars['form']->value['recipe_text']['value'];?>
</textarea>
        </div>

        <table>
        <button type="submit" id="confilm_b" value="投稿" name="submit" class="submit-button">投稿</button>
        <?php if (($_smarty_tpl->tpl_vars['form']->value['submit2']['attribs']['value'] != '')) {?>
            <?php echo $_smarty_tpl->tpl_vars['form']->value['reset']['html'];?>
　<!--きっとこいつは入力フォームのリセット-->
            <?php }?>
            <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
            <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">

        </table>
        </form>
    </main>

    <?php echo '<script'; ?>
>
        function displayFileName() {
            const input = document.getElementById('image-file');
            const fileNameDisplay = document.getElementById('file-name');
            fileNameDisplay.value = input.files.length > 0 ? input.files[0].name : '';
        }
    <?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
