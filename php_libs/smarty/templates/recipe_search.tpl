<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レシピ検索</title>
    <link rel="stylesheet" href="resipi_search.css">
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

        <section class="search-bar">
        <form method="post" id="Form" action="/index_2.php?type=search">
        <input type="text" placeholder="レシピを検索" name="search_key" value="{$search_key}">
        <button class="search-button">検索</button>
        </form>
        </section>

        <!-- 投稿レシピ表示OK -->
        <section class="recipe-list">
        {foreach item=item from=$data}
        <div class="recipe-item">
            <img class="recipe-photo" src={$item.recipe_picture}>
                <!-- 料理表示ページへのリンク -->
                <p><a class="recipe-name" href="{$SCRIPT_NAME}?type=view_recipe&id={$item.id}">{$item.recipe_title|escape:"html"}</a></p>
        </div>
        {/foreach}
        </section>
<!--
        <section class="recipe-list">
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
