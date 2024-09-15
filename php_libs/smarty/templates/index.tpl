<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title}</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <h1>レシピ共有サイト</h1>
    </header>
    <main>
        <section class="admin-login">
        
            <!-- <form action="/index_2.php" method="post"> -->
            <!-- <label for="admin-name">メールアドレス</label>
                <input type="text" id="admin-name" name="mail_address" placeholder="AdmName">
            <label for="password">パスワード</label>
                <input type="password" id="password" name="password" placeholder="PassWord">
            </form> -->

            <form {$form.attributes}>
            <table>
          
            <div style="font-weight: bold;">{$form.mail_address.label}</div>
            {$form.mail_address.html}
            <div style="font-weight: bold;">{$form.password.label}</div>
            {$form.password.html}

<!--
            <tr>
              <td colspan="2" >
                <input type="hidden" name="type" value="{$type}">
                <div style="text-align:center;">{$form.submit.html}</div>

                <div style="color:red; font-size: smaller;"> {$auth_error_mess} </div></td>
            </tr>
-->
            <td colspan="2" >
                <input type="hidden" name="type" value="{$type}">
                <button type="submit" value="{$type}" name="submit" id="submit-0">ログイン</button>
                </td>
                <div style="color:red; font-size: smaller;"> {$auth_error_mess} </div>            
          </table>
	  </form>
            <!--
            <form action="/index_2.php?type=regist&action=form" method="post">
                <button type="submit">サインアップ</button>
            </form> -->

            <button type="button" onclick="location.href='/index_2.php?type=regist&action=form'">サインアップ</button>

        </section>
    </main>
</body>
</html>
