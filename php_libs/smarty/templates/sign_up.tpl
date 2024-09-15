<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title}</title>
    <script type="text/javascript" src="js/quickform.js" async></script>
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
            
            <form {$form.attributes}>
            {$form.hidden}
            <table>  <!--tableにsubmitとかをおかないと，エラーメッセージでないよ-->
                <div style="font-weight: bold;">{$form.username.label}</div>
                {if isset($form.username.error)}
                <div style="color:red; font-size: smaller;">{$form.username.error}</div>
                {/if}
                {$form.username.html}

                <div style="font-weight: bold;">{$form.mail_address.label}</div>
                {if isset($form.mail_address.error)}
                <div style="color:red; font-size: smaller;">{$form.mail_address.error}</div>
                {/if}
                {$form.mail_address.html}

                <div style="font-weight: bold;">{$form.password.label}</div>
                {if isset($form.password.error)}
                <div style="color:red; font-size: smaller;">{$form.password.error}</div>
                {/if}
                {$form.password.html}

                <td>
                <button type="submit" id="confilm_b" value="登録" name="submit">登録</button>
                {if ( $form.submit2.attribs.value != "" ) }
                {$form.reset.html}　<!--きっとこいつは入力フォームのリセット-->
                {/if}
                <input type="hidden" name="type" value="{$type}">
                <input type="hidden" name="action" value="{$action}">
                </td>
            </table>
            </form>
        </section>
    </main>
</div>
{if $form.javascript}
    {$form.javascript}
{/if}
</body>
</html>
