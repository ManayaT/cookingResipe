<?php

class BaseController_2 {
    protected $type;
    protected $action;
    protected $next_type;
    protected $next_action;
    protected $file;
    protected $form;
    protected $renderer;
    protected $auth;
    protected $is_system = false;
    protected $view;
    protected $title;
    protected $message;
    protected $auth_error_mess;
    protected $login_state;
    protected $user_id;
    private   $debug_str;
    
    public function __construct($flag=false){
        $this->set_system($flag);
        // VIEWの準備
        $this->view_initialize();
    }
    

    public function set_system($flag){
        $this->is_system = $flag;
    }
    
    private function view_initialize(){
        // 画面表示クラス
        $this->view = new Smarty();
        // Smarty関連ディレクトリの設定
        $this->view->template_dir = _SMARTY_TEMPLATES_DIR;
        $this->view->compile_dir  = _SMARTY_TEMPLATES_C_DIR;
        $this->view->config_dir   = _SMARTY_CONFIG_DIR;
        $this->view->cache_dir    = _SMARTY_CACHE_DIR;

        // 入力チェック用クラス
        $this->form = new HTML_QuickForm2('Form');
        HTML_QuickForm2_Renderer::register('smarty','HTML_QuickForm2_Renderer_Smarty');
        $this->renderer  = HTML_QuickForm2_Renderer::factory('smarty');
        $this->renderer->setOption('old_compat', true);
        $this->renderer->setOption('group_errors', false);

        // リクエスト変数 typeとactionで動作を決めます。
        if(isset($_REQUEST['type'])){   $this->type   = $_REQUEST['type'];}
        if(isset($_REQUEST['action'])){ $this->action = $_REQUEST['action'];}

        // 共通の変数
        $this->view->assign('is_system',   $this->is_system );
        $this->view->assign('SCRIPT_NAME', _SCRIPT_NAME);
        $this->view->assign('add_pageID',  $this->add_pageID());
    }


    //----------------------------------------------------
    // フォームと変数を読み込んでテンプレートに組み込んで表示します。
    //----------------------------------------------------
    protected function view_display(){
        // セッション変数などの内容の表示
        $this->debug_display();

        // ログイン状況の表示
        $this->disp_login_state();
        
        $this->view->assign('title', $this->title);
        $this->view->assign('auth_error_mess', $this->auth_error_mess);
        $this->view->assign('message', $this->message);
        $this->view->assign('disp_login_state', $this->login_state);
        $this->view->assign('type',    $this->next_type);
        $this->view->assign('action',  $this->next_action);
        $this->view->assign('debug_str', $this->debug_str);

        $this->view->assign('form', $this->form->render($this->renderer)->toArray());
        $this->view->display($this->file);

        // デバッグ用
        //echo "<b>toArray()</b><pre>";var_dump($this->renderer->toArray());echo "</pre>";
        //print "<hr>";
        //echo "<b>form</b><pre>";var_dump($this->form);echo "</pre>";

    }
    
    //----------------------------------------------------
    // ログイン中の表示
    //----------------------------------------------------
    private function disp_login_state(){
        if(is_object($this->auth) && $this->auth->check()){
            $this->login_state = ($this->is_system)? '管理者ログイン中' : '会員ログイン中';
        }
    }    
    
    //----------------------------------------------------
    // 会員情報入力項目と入力ルールの設定
    //----------------------------------------------------
    public function make_form_controle(){

        $options = [
            'format'    => 'Ymd',
            'minYear'   => 1950,
            'maxYear'   => date("Y"),
        ];

        // formの要素
        $username =  $this->form->addElement('text',  'username', ['placeholder' => 'UserName'], ['label' => 'ユーザ名']);
        $mail_address = $this->form->addElement('text',  'mail_address', ['placeholder' => 'MailAddress'], ['label' => 'メールアドレス']);
        $password =  $this->form->addElement('password',  'password', ['placeholder' => 'PassWord'], ['label' => 'パスワード']);

        // 入力規則
        $username->addRule('required', 'ユーザ名を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $mail_address->addRule('required', 'メールアドレスを入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $mail_address->addRule('email',  'メールアドレスの形式が不正です。',    null, HTML_QuickForm2_Rule::SERVER);
        $password->addRule('required',  'パスワードを入力してください。',      null, HTML_QuickForm2_Rule::SERVER);
        $password->addRule('length',  'パスワードは8文字から16文字の範囲で入力してください。', [8, 16], HTML_QuickForm2_Rule::SERVER);
        $password->addRule('regex',  'パスワードは半角の英数字、記号（ _ - ! ? # $ % & ）を使ってください。', '/^[a-zA-z0-9_\-!?#$%&]*$/', HTML_QuickForm2_Rule::SERVER);
        
        $this->form->addRecursiveFilter('trim');
    }
    

    //----------------------------------------------------
    // 会員情報入力項目と入力ルールの設定
    //----------------------------------------------------
    public function make_form_controle_2(){

        $options = [
            'format'    => 'Ymd',
            'minYear'   => 1950,
            'maxYear'   => date("Y"),
        ];

        // formの要素
        $recipe_name =  $this->form->addElement('text',  'recipe_name', ['placeholder' => 'recipe_name'], ['label' => 'レシピ名']);
        $recipe_image = $this->form->addElement('file', 'recipe_image');
        $recipe_text =  $this->form->addElement('textarea',  'recipe_text', ['placeholder' => 'recipe_text'], ['label' => 'レシピ本文']);

        // 入力規則
        $recipe_name->addRule('required', 'レシピ名を入力してください。', null, HTML_QuickForm2_Rule::SERVER);

        // 画像ファイルの MIME タイプを検証するルールを追加
        // 別に，標準でバリデートのチェックが行われるのがサーバーサイドであるため
        // わざわざ(null, HTML_QuickForm2_Rule::SERVER)を明示的に記述する必要はない
        $recipe_image->addRule('mimetype', 'アップロードできるのは画像ファイルのみです。', array('image/jpeg', 'image/png', 'image/gif'));
        $recipe_image->addRule('required', '画像ファイルをアップロードしてください。', null, HTML_QuickForm2_Rule::SERVER);

        $recipe_text->addRule('required',  'レシピを入力してください。',      null, HTML_QuickForm2_Rule::SERVER);
        $recipe_text->addRule('length',  'レシピは1文字から1200文字の範囲で入力してください。', [1, 1200], HTML_QuickForm2_Rule::SERVER);

        $this->form->addRecursiveFilter('trim');
    }

    //----------------------------------------------------
    // 検索処理関係
    //----------------------------------------------------
    //
    // pageIDをURLに追加。
    //
    public function add_pageID(){
        if( !($this->is_system && $this->type == 'list') ){ return;}

        $add_pageID = "";
        if(isset($_GET['pageID']) && $_GET['pageID'] != ""){
            $add_pageID = '&pageID=' . $_GET['pageID'];
            $_SESSION['pageID'] = $_GET['pageID'];
        }else if(isset($_SESSION['pageID']) && $_SESSION['pageID'] != ""){
            $add_pageID = '&pageID=' . $_SESSION['pageID'];
        }
        return $add_pageID;
    }

    //----------------------------------------------------
    // ページ分割処理（検索画面の話）
    //----------------------------------------------------
    public function make_page_link($data){
        // Slindingを使用する場合
        //require_once('Pager/Sliding.php');

        // Jumpingを使用する場合
        require_once('Pager/Jumping.php');

        $params = [
            'mode'      => 'Jumping',
            'perPage'   => 10,
            'delta'     => 10,
            'itemData'  => $data
        ];

        // Slindingを使用する場合
        //$pager = new Pager_Sliding($params);

        // Jumpingを使用する場合
        $pager = new Pager_Jumping($params);

        $data  = $pager->getPageData();
        $links = $pager->getLinks();
        return [$data, $links];
    }    

    //----------------------------------------------------
    // デバッグ用表示処理
    //----------------------------------------------------
    public function debug_display(){
        if(_DEBUG_MODE){
            $this->debug_str = "";
            if(isset($_SESSION)){
                $this->debug_str .= '<br><br>$_SESSION<br>';
                $this->debug_str .= var_export($_SESSION, TRUE);
            }
            if(isset($_POST)){
                $this->debug_str .= '<br><br>$_POST<br>';
                $this->debug_str .= var_export($_POST, TRUE);
            }
            if(isset($_GET)){
                $this->debug_str .= '<br><br>$_GET<br>';
                $this->debug_str .= var_export($_GET, TRUE);
            }
            // smartyのデバッグモード設定 ポップアップウィンドウにテンプレート内の変数を
            // 表示します。
            $this->view->debugging = _DEBUG_MODE;
        }
    }
}
