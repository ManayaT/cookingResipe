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
                <li><a href="{$SCRIPT_NAME}">トップ</a></li>
                <li><a href="{$SCRIPT_NAME}?type=search">レシピ検索</a></li>
                <li><a href="{$SCRIPT_NAME}?type=favorite_list">お気に入り</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <form {$form.attributes} class="recipe-form" enctype="multipart/form-data">
        {$form.hidden}

        <h2>レシピ投稿 フォーム</h2>

        <div class="form-group">
            {if isset($form.recipe_name.error)}
            <div style="color:red; font-size: smaller;">{$form.recipe_name.error}</div>
            {/if}
            {$form.recipe_name.html}
        </div>

        <div class="form-group file-upload-group">
            {if isset($form.recipe_image.error)}
            <div style="color:red; font-size: smaller;">{$form.recipe_image.error}</div>
            {/if}
            <input type="file" id="image-file" name="{$form.recipe_image.name}" accept="image/*" onchange="displayFileName()">
            <input type="text" id="file-name" readonly>
            <label for="image-file" class="file-label">ファイルを選択</label>
        </div>

        <div class="form-group">
            {if isset($form.recipe_text.error)}
            <div style="color:red; font-size: smaller;">{$form.recipe_text.error}</div>
            {/if}
            <textarea name="{$form.recipe_text.name}" id="{$form.recipe_text.id}" rows="10" cols="50">{$form.recipe_text.value}</textarea>
        </div>

        <table>
        <button type="submit" id="confilm_b" value="投稿" name="submit" class="submit-button">投稿</button>
        {if ( $form.submit2.attribs.value != "" ) }
            {$form.reset.html}　<!--きっとこいつは入力フォームのリセット-->
            {/if}
            <input type="hidden" name="type" value="{$type}">
            <input type="hidden" name="action" value="{$action}">

        </table>
        </form>
    </main>

    <script>
        function displayFileName() {
            const input = document.getElementById('image-file');
            const fileNameDisplay = document.getElementById('file-name');
            fileNameDisplay.value = input.files.length > 0 ? input.files[0].name : '';
        }
    </script>
</body>
</html>
