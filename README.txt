【実装方法】
1, MariaDBにRootユーザーでログイン

2, 管理者ユーザーの作成を行う
	create user 'issue'@'localhost' identified by 'password';

3, 作成したissueにUSE文を使用してデータベースの作成を行う。
	create database issuedb character set utf8 collate utf8_general_ci;
	grant all privileges ON issuedb.* TO 'issue'@'localhost';
	flush privileges;

4, 同梱の.splファイルを元に，データベースを作成する

5, htdocsディレクトリのimegesフォルダに権限を与える
	chmod 777 /Applications/XAMPP/xamppfiles/htdocs/images


【実行方法】
1, XAMPPを起動し全てのサーバーを実行可能状態とする
2, http://localhost/index_2.phpにアクセスする

【レシピ共有サイトの動作確認方法】
1, 会員登録を行う
2, 登録したメールアドレスとパスワードでログインを行う
3, トップ画面に遷移後，任意のボタンをクリックし，動作確認を行う