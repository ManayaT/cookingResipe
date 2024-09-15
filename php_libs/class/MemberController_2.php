<?php

class MemberController_2 extends BaseController_2
{
    //----------------------------------------------------
    // 会員用メニュー
    //----------------------------------------------------
    public function run()
    {
        // セッション開始　認証に利用します。
        $this->auth = new Auth();
        $this->auth->set_authname(_MEMBER_AUTHINFO);
        $this->auth->set_sessname(_MEMBER_SESSNAME);
        $this->auth->start();

        if ($this->auth->check()) {
            // 認証済み
            $this->menu_member();
        } else {
            // 未認証
            $this->menu_guest();
        }
    }

    //----------------------------------------------------
    // 会員用メニュー
    //----------------------------------------------------
    public function menu_member()
    {
        switch ($this->type) {
            case "logout":
                $this->auth->logout();
                $this->screen_login();
                break;
            // 会員情報の修正（使わないかも）
            case "modify":
                //$this->screen_modify();
                break;
            case "delete":
                $this->screen_delete();
                break;

            // レシピの追加
            case "upload":
                $this->screen_regist_2();
                break;

            // レシピの閲覧
            case "view_recipe":
                $this->view_recipe();
                break;

            // お気に入り登録
            case "favorite":
                $this->regist_favorite();
                $this->view_recipe();
                break;

            // レシピの検索
            case "search":
                $this->recipe_top();
                break;

            // お気に入り一覧
            case "favorite_list":
                $this->favorite_top();
                break;

            default: // 会員トップ画面に飛ぶ？
                $this->screen_top();
        }
    }

    //----------------------------------------------------
    // ゲスト用メニュー
    //----------------------------------------------------
    public function menu_guest()
    {
        switch ($this->type) {
            case "regist": // 登録
                $this->screen_regist();
                break;
            case "authenticate": // 未認証
                $this->do_authenticate();
                break;
            default:
                $this->screen_login();
        }
    }
    //----------------------------------------------------
    // ログイン画面表示(07/11)
    //----------------------------------------------------
    public function screen_login()
    {
        $this->form->addElement('text', 'mail_address',     ['placeholder' => 'MailAddress'], [ 'label' => 'ユーザ名']);
        $this->form->addElement('password', 'password', ['placeholder' => 'PassWord'], [ 'label' => 'パスワード']);
        $this->form->addElement('submit', 'submit', ['value' =>'ログイン']);
        $this->title = 'ログイン画面';
        // 次ページのタイプを指定（認証のためにDBを叩く）
        $this->next_type = 'authenticate';
        $this->file = "index.tpl";
        $this->view_display();
    }

    // ログイン（やっと完成）
    public function do_authenticate()
    {
        // データベースを操作します。
        $MemberModel = new MemberModel_2();
        // 会員名から，ユーザ情報をDBより取得
        $userdata = $MemberModel->get_authinfo($_POST['mail_address']);

        // パスワード判定の後，ログインと認証を付与
        if (!empty($userdata['password']) && $this->auth->check_password($_POST['password'], $userdata['password'])) {
            $this->auth->auth_ok($userdata);
            
            // ユーザーIDをセッションに保存
            $_SESSION[_MEMBER_AUTHINFO]['user_id'] = $userdata['id'];
            $this->user_id = $userdata['id'];

            $this->screen_top();
        } else {
            $this->auth_error_mess = $this->auth->auth_no();
            $this->screen_login();
        }
    }

    //----------------------------------------------------
    // トップ画面（多分かんせい）
    //----------------------------------------------------
    public function screen_top()
    {
        $this->view->assign('username', $_SESSION[_MEMBER_AUTHINFO]['username']);
        $this->user_id = isset($_SESSION[_MEMBER_AUTHINFO]['user_id']) ? $_SESSION[_MEMBER_AUTHINFO]['user_id'] : null;
        $this->title = '会員トップ画面';
        
        // データベースを操作します。
        $MemberModel = new MemberModel_2();
        list($data, $count) = $MemberModel->get_recipe_list($this->user_id);
        list($data, $links) = $this->make_page_link($data);

        $this->view->assign('count', $count);
        $this->view->assign('data', $data);

        $this->file = 'user_top.tpl';
        $this->view_display();
    }

    //----------------------------------------------------
    // 会員登録画面(会員登録機能は完成7/28) 
    //----------------------------------------------------
    public function screen_regist($auth = "")
    {
        $btn = "";
        $btn2 = "";
        $this->file = "sign_up.tpl"; // デフォルト

        //$this->form->addDataSource(new HTML_QuickForm2_DataSource_Array(['birthday' => $date_defaults]));
        $this->make_form_controle(); // <-おそらくこいつが QuickForm2 の変数を定義している

        // フォームの妥当性検証(おそらくこのバリデートは入力不備の確認？)
        if (!$this->form->validate()) {
            $this->action = "form";
        }

        // formの入力に問題があった場合の処理
        if ($this->action == "form") {
            $this->title = '新規登録画面';
            $this->next_type = 'regist';
            //$this->next_action = 'confirm';
            $this->next_action = 'confirm';
            $btn = '確認画面へ';

        // formの入力に問題がない場合の処理
        } else {
            
            // 送信処理を行うためのフラグを管理
            if ($this->action == "confirm") {
                // 確認画面を通さないゆえに，どちらのaction変数も書き換える
                $this->action = "complete";
                $this->next_action = 'complete';
            }

            // 使用する箇所
            if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '登録') {
                
                /*
                // テスト用コード(要素のPOSTは正常に動いています！)
                $userdata = $this->form->getValue();
                echo $userdata['mail_address'];
                */
                
                // データベースを操作します。
                $PrememberModel = new PrememberModel_2();
                // データベースを操作します。
                $MemberModel = new MemberModel_2();
                $userdata = $this->form->getValue();
                if ($MemberModel->check_mail_address($userdata) || $PrememberModel->check_mail_address($userdata)) {
                    $this->title = '新規登録画面';
                    $this->message = "メールアドレスは登録済みです。";
                    $this->next_type = 'regist';
                    $this->next_action = 'confirm';
                    $btn = '確認画面へ';
                } else { //now

                    // システム側から利用するときに利用
                    if ($this->is_system && is_object($auth)) {
                        $userdata['password'] = $auth->get_hashed_password($userdata['password']);

                    // ただのpremember登録はこっち
                    } else {
                        $userdata['password'] = $this->auth->get_hashed_password($userdata['password']);
                    }

                    /*
                    $userdata['birthday'] = sprintf("%04d%02d%02d",
                        $userdata['birthday']['Y'],
                        $userdata['birthday']['m'],
                        $userdata['birthday']['d']);
                    */

                    // システム側から利用するときに利用
                    if ($this->is_system) {
                        //$MemberModel->regist_member($userdata);
                        $this->title = '登録完了画面';
                        $this->message = "登録を完了しました。";

                    // 仮登録処理
                    } else {
                        $userdata['link_pass'] = hash('sha256', uniqid(rand(), 1));
                        $PrememberModel->regist_premember($userdata);
                        $this->mail_to_premember($userdata);
                        $this->title = 'メール送信完了画面';
                        $this->message = "登録されたメールアドレスへ確認のためのメールを送信しました。<br>";
                        $this->message .= "メール本文に記載されているURLにアクセスして登録を完了してください。<br>";
                    }

                    $confirm = "<script type='text/javascript'>confirm('登録されたメールアドレスへ確認のためのメールを送信しました。\nメール本文に記載されているURLにアクセスして登録を完了してください。\n');</script>";
                    echo $confirm;

                    header("Location: /index_2.php");
                }
            }
        }

        // ページの繰り返し(今回は確認画面は必要ないので，ページの繰り返しは Validate に引っかかった時だけ)
        $this->next_action = 'confirm';

        $this->form->addElement('submit', 'submit', ['value' =>$btn]);
        $this->form->addElement('submit', 'submit2', ['value' =>$btn2]);
        $this->form->addElement('reset', 'reset', ['value' =>'取り消し']);
        $this->view_display();
    }


    //----------------------------------------------------
    // レシピ登録画面(完成)
    //----------------------------------------------------
    public function screen_regist_2($auth = '') // $auth = '' が不要になりそう
    {
        $btn = "";
        $btn2 = "";
        $this->file = "upload.tpl"; // デフォルト

        $this->make_form_controle_2(); // <-おそらくこいつが QuickForm2 の変数を定義している
                                     //   make_form_controle_2を新たに作成する必要あり

        // フォームの妥当性検証(おそらくこのバリデートは入力不備の確認？)
        if (!$this->form->validate()) {
            $this->action = "form";
        }

        // formの入力に問題があった場合の処理
        if ($this->action == "form") {
            $this->title = 'レシピ投稿画面';
            $this->next_type = 'upload';
            $this->next_action = 'confirm';

        // formの入力に問題がない場合の処理
        } else {
            // ここは確認画面の表示
            
            // 送信処理を行うためのフラグを管理
            if ($this->action == "confirm") {
                // 確認画面を通さないゆえに，どちらのaction変数も書き換える
                $this->action = "complete";
                $this->next_action = 'complete';
            }
            
            // 使用する箇所
            if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '投稿') {
                
                $this->view->assign('username', $_SESSION[_MEMBER_AUTHINFO]['username']);
                $this->user_id = isset($_SESSION[_MEMBER_AUTHINFO]['user_id']) ? $_SESSION[_MEMBER_AUTHINFO]['user_id'] : null;

                // データベースを操作します。
                $PrememberModel = new PrememberModel_2();
                $MemberModel = new MemberModel_2();

                $imagedata = $this->form->getValue();

                // 名前の取得
                $img_name = $_FILES['recipe_image']['name'];
                // 拡張子の取得
                $img_extension = '.' . substr(strrchr($img_name, '.'), 1);
                // 画像の名前をDBを参照して連番にする
                $temp_img_name = $MemberModel -> get_last_recipe_id();

                // ディレクトリが存在している場合は，画像の保存を実行（カレントディレクトリはhtdocsの模様）
                if (file_exists("images/")){
                    // imagesフォルダに画像を保存
                    // move_uploaded_file( ファイルの実体, ファイル名);
                    move_uploaded_file($_FILES['recipe_image']['tmp_name'], 'images/'. $temp_img_name['next_id'] . $img_extension);
                } else {
                    echo "権限が不足しています.";
                }

                // データベースを操作します。
                $PrememberModel->regist_recipe($imagedata, $this->user_id, 'images/'. $temp_img_name['next_id'] . $img_extension);
                
                $confirm = "<script type='text/javascript'>confirm('レシピを投稿しました');</script>";
                echo $confirm;

                // ほんとにindex.tplでいいのか？
                //$this->file = "user_top.tpl";
                //$this->screen_top();
                header("Location: /index_2.php");
            }
        }

        // ページの繰り返し(今回は確認画面は必要ないので，ページの繰り返しは Validate に引っかかった時だけ)
        $this->next_action = 'confirm';

        $this->form->addElement('submit', 'submit', ['value' =>$btn]);
        $this->form->addElement('submit', 'submit2', ['value' =>$btn2]);
        $this->form->addElement('reset', 'reset', ['value' =>'取り消し']);

        $this->view_display();
    }

    //----------------------------------------------------
    // レシピ表示（コメントとお気に入りの混在？）
    //----------------------------------------------------
    public function view_recipe()
    {
        /*
        // idの取得はこれでオッケー
        $temp = $_GET['id'];
        echo "レシピのidは" . $temp;
        */

        $this->user_id = isset($_SESSION[_MEMBER_AUTHINFO]['user_id']) ? $_SESSION[_MEMBER_AUTHINFO]['user_id'] : null;
        
        if ($this->user_id !== null) {
            $this->view->assign('username', $_SESSION[_MEMBER_AUTHINFO]['username']);
            $this->title = 'レシピ閲覧画面';

            // データベースを操作します。
            $MemberModel = new MemberModel_2();
            $recipe_data = $MemberModel->get_recipe($_GET['id']);
            
            $this->view->assign('data', $recipe_data);

            $this->file = "recipe.tpl";
            $this->view_display();
        } else {
            // ユーザーIDが設定されていない場合、ログイン画面にリダイレクトするなどの処理を追加します。
            $this->screen_login();
        }
    }


    //----------------------------------------------------
    // お気に入りレシピの登録（完成）
    //----------------------------------------------------
    public function regist_favorite(){
        /*
        $temp = $_GET['id'];
        echo "レシピのidは" . $_GET['id'];

        $this->user_id = isset($_SESSION[_MEMBER_AUTHINFO]['user_id']) ? $_SESSION[_MEMBER_AUTHINFO]['user_id'] : null;
        echo "ユーザのidは" . $this -> user_id;
        */

        $this->user_id = isset($_SESSION[_MEMBER_AUTHINFO]['user_id']) ? $_SESSION[_MEMBER_AUTHINFO]['user_id'] : null;

        $this->view->assign('username', $_SESSION[_MEMBER_AUTHINFO]['username']);

        // データベースを操作します。
        $MemberModel = new MemberModel_2();
        // 重複していない場合のみ追加
        if (!$MemberModel -> check_favorite($this -> user_id, $_GET['id'])){
            $MemberModel->set_favorite($this -> user_id, $_GET['id']);
        }
    }


    //----------------------------------------------------
    // 削除画面（完成）
    //----------------------------------------------------
    public function screen_delete()
    {
        
        $this->user_id = isset($_SESSION[_MEMBER_AUTHINFO]['user_id']) ? $_SESSION[_MEMBER_AUTHINFO]['user_id'] : null;
        // データベース
        $MemberModel = new MemberModel_2();

        if ($this->action == "complete") {

            /* 動作確認済み
            $alert = "<script type='text/javascript'>alert('削除を実行するよ');</script>";
            echo $alert;
            */

            $MemberModel->delete_recipe($_GET['id']);

            $confirm = "<script type='text/javascript'>confirm('レシピを削除しました');</script>";
            echo $confirm;

            header("Location: /index_2.php");

        } else {
            if ($this->user_id !== null) {
                $this->view->assign('username', $_SESSION[_MEMBER_AUTHINFO]['username']);
                $this->title = 'レシピ閲覧画面';
    
                // データベースを操作します。
                $recipe_data = $MemberModel->get_recipe($_GET['id']);
                
                $this->view->assign('data', $recipe_data);
    
                $this->file = "delete.tpl";
                $this->view_display();
            } else {
                // ユーザーIDが設定されていない場合、ログイン画面にリダイレクトするなどの処理を追加します。
                $this->screen_login();
            }
        }
    }

    //----------------------------------------------------
    // レシピ一覧&検索画面（完成）
    //----------------------------------------------------
    public function recipe_top()
    {
        
        $this->view->assign('username', $_SESSION[_MEMBER_AUTHINFO]['username']);
        $this->user_id = isset($_SESSION[_MEMBER_AUTHINFO]['user_id']) ? $_SESSION[_MEMBER_AUTHINFO]['user_id'] : null;
        
        $disp_search_key = "";
        $sql_search_key = "";

        // 'search_key' が $_POST 配列に存在するかどうかをチェック
        if (isset($_POST['search_key'])) {
            $disp_search_key = htmlspecialchars($_POST['search_key'], ENT_QUOTES);
            $sql_search_key = $_POST['search_key'];
        }
        
        // データベースを操作します。
        $MemberModel = new MemberModel_2();
        list($data, $count) = $MemberModel->get_recipe_all($sql_search_key);
        list($data, $links) = $this->make_page_link($data);

        $this->view->assign('count', $count);
        $this->view->assign('data', $data);
        $this->view->assign('search_key', $disp_search_key);
        $this->view->assign('links', $links['all']);
        $this->title = 'レシピ検索画面';
        
        $this->file = 'recipe_search.tpl';
        $this->view_display();
    }

    //----------------------------------------------------
    // お気に入り一覧画面（完成）
    //----------------------------------------------------
    public function favorite_top()
    {
        
        $this->view->assign('username', $_SESSION[_MEMBER_AUTHINFO]['username']);
        $this->user_id = isset($_SESSION[_MEMBER_AUTHINFO]['user_id']) ? $_SESSION[_MEMBER_AUTHINFO]['user_id'] : null;
        
        // データベースを操作します。
        $MemberModel = new MemberModel_2();
        list($data, $count) = $MemberModel->get_favorite_all($this->user_id);
        // list($data, $links) = $this->make_page_link($data);

        $this->view->assign('count', $count);
        $this->view->assign('data', $data);
        // $this->view->assign('search_key', $disp_search_key);
        // $this->view->assign('links', $links['all']);
        $this->title = 'お気に入りレシピ一覧';
        
        $this->file = 'favorite.tpl';
        $this->view_display();
    }

    //----------------------------------------------------
    // メール関係（多分 username 以外はいじらなくても大丈夫）
    //----------------------------------------------------
    //
    // 仮登録者へメール送信
    //
    public function mail_to_premember($userdata)
    {

        $path = pathinfo(_SCRIPT_NAME)['dirname'];

        $to = $userdata['mail_address'];
        $subject = "会員登録の確認";
        $message = <<<EOM
    {$userdata['username']}様

    会員登録ありがとうございます。
    下のリンクにアクセスして会員登録を完了してください。

    http://{$_SERVER['SERVER_NAME']}{$path}/premember_2.php?mail_address={$userdata['mail_address']}&link_pass={$userdata['link_pass']}

    このメールに覚えがない場合はメールを削除してください。


    --
    レシピ共有サイト

EOM;
        $add_header = "";

        //$add_header .= "From: xxxx@xxxxxxx\nCc: xxxx@xxxxxxx";

        mb_send_mail($to, $subject, $message, $add_header);

    }
}
