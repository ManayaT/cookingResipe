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
                <li><a href="{$SCRIPT_NAME}">トップ</a></li>
                <li><a href="{$SCRIPT_NAME}?type=search">レシピ検索</a></li>
                <li><a href="{$SCRIPT_NAME}?type=favorite_list">お気に入り</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="user-info">
            <h1>{$username|escape:"html"} のトップページ</h1>

            <!-- 会員情報の更新機能は使用しない予定
            <button class="update-button">会員情報を更新</button>
            -->

        </section>
        <section class="recipes">
            <div class="posted-recipes">
                <h2>投稿したレシピ</h2>

                <!-- 投稿レシピ表示OK -->
                {foreach item=item from=$data}
                <div class="recipe">
                    <img class="recipe-photo" src={$item.recipe_picture}>
                    <div class="recipe-details">
                        <!-- 料理表示ページへのリンク -->
                        <p><a href="{$SCRIPT_NAME}?type=view_recipe&id={$item.id}">{$item.recipe_title|escape:"html"}</a></p>
                        <!-- 削除ボタン -->
                        <button class="delete-button" type="button" onclick="location.href='{$SCRIPT_NAME}?type=delete&action=confirm&id={$item.id}'">削除</button>
                    </div>
                </div>
                {/foreach}
            </div>

            <button class="post-recipe-button" type="button" onclick="location.href='{$SCRIPT_NAME}?type=upload'">レシピを投稿する</button>
        </section>
        <a class="logout" href="{$SCRIPT_NAME}?type=logout">ログアウト</a>
    </main>
</body>
</html>
