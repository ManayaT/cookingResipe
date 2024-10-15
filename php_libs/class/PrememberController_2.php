<?php
class PrememberController_2 extends BaseController_2 {
    public function run(){
        if (isset($_GET['mail_address']) && isset($_GET['link_pass'])){
        // 必要なパラメータがある
            // データベースを操作
            $PrememberModel = new PrememberModel_2();
            $userdata = $PrememberModel->check_premember($_GET['mail_address'], $_GET['link_pass']);
            if(!empty($userdata) && count($userdata) >= 1){
            // パラメータが合致する
                // 仮登録テーブルから削除して、memberへデータを挿入する
                $PrememberModel->delete_premember_and_regist_member($userdata);
                $this->title = '登録完了画面';
                $this->message = '登録を完了しました。トップページよりログインしてください。';
            }else{
            // パラメータが合致しない
                $this->title = 'エラー画面';
                $this->message = 'このURLは無効です。';
            }
        }else{
        // 必要なパラメータがない
            $this->title = 'エラー画面';
            $this->message = 'このURLは無効です。';
        }
        $this->file = 'premember_2.tpl'; 
        $this->view_display();
    }    
    

}
