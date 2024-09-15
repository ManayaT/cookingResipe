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
                <li><a href="{$SCRIPT_NAME}">トップ</a></li>
                <li><a href="{$SCRIPT_NAME}?type=search">レシピ検索</a></li>
                <li><a href="{$SCRIPT_NAME}?type=favorite_list">お気に入り</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="recipe-detail">
            <h1>{$data.recipe_title}</h1>
            <img class="recipe-photo" src={$data.recipe_picture}>
            <div class="recipe-content">
                <h2>レシピ</h2>
                <p>{$data.recipe_text}</p>
            </div>

            <button class="favorite-button" type="button" onclick="location.href='{$SCRIPT_NAME}?type=favorite&id={$data.id}'">☆お気に入り</button>

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
