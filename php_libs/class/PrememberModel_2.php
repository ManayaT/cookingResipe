<?php

class PrememberModel_2 extends BaseModel {
    //----------------------------------------------------
    // 仮会員登録処理
    //----------------------------------------------------
    public function regist_premember($userdata){
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT  INTO premember_2 (mail_address, username, password, link_pass, reg_date )
            VALUES ( :mail_address, :username, :password, :link_pass, now() )";

            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':mail_address',   $userdata['mail_address'],   PDO::PARAM_STR );
            $stmh->bindValue(':username',   $userdata['username'],   PDO::PARAM_STR );
            $stmh->bindValue(':password',  $userdata['password'],  PDO::PARAM_STR );
            $stmh->bindValue(':link_pass',  $userdata['link_pass'],  PDO::PARAM_STR );
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 仮登録テーブル内にmail_addressが1個以上あればtrueが返る
    //----------------------------------------------------
    public function check_mail_address($userdata){
        try {
            $sql= "SELECT * FROM premember_2 WHERE mail_address = :mail_address ";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':mail_address',  $userdata['mail_address'], PDO::PARAM_STR );
            $stmh->execute();
            $count = $stmh->rowCount();
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        if($count >= 1){
            return true;
        }else{
            return false;
        }
    }

    //----------------------------------------------------
    // 登録確認のメールで送られたリンクをクリックしてアクセスしたときの処理
    //----------------------------------------------------
    public function check_premember($mail_address, $link_pass){
        $data = [];
        try {
            $sql= "SELECT * FROM premember_2 WHERE mail_address = :mail_address AND link_pass = :link_pass limit 1 ";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':mail_address',  $mail_address,  PDO::PARAM_STR );
            $stmh->bindValue(':link_pass', $link_pass, PDO::PARAM_STR );
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }

    //----------------------------------------------------
    // 仮登録会員の削除 & member_2テーブルへの登録
    //----------------------------------------------------
    public function delete_premember_and_regist_member($userdata){
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM premember_2 WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $userdata['id'], PDO::PARAM_INT );
            $stmh->execute();

            $sql = "INSERT  INTO member_2 (mail_address, username, password, reg_date, cancel_date)
            VALUES ( :mail_address, :username, :password, now(), now() )";
            
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':mail_address',   $userdata['mail_address'],   PDO::PARAM_STR );
            $stmh->bindValue(':username',   $userdata['username'],   PDO::PARAM_STR );
            $stmh->bindValue(':password',  $userdata['password'],  PDO::PARAM_STR );

            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // recipeテーブルへの登録
    //----------------------------------------------------
    public function regist_recipe($imagedata, $user_id, $recipe_path){
        try {
            $this->pdo->beginTransaction();

            $sql = "INSERT  INTO recipe (user_id, recipe_title, recipe_picture, recipe_text)
            VALUES (:user_id, :recipe_title, :recipe_picture, :recipe_text)";
            
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':user_id',   $user_id,   PDO::PARAM_INT );
            $stmh->bindValue(':recipe_title',   $imagedata['recipe_name'],   PDO::PARAM_STR );
            $stmh->bindValue(':recipe_picture',   $recipe_path,   PDO::PARAM_STR );
            $stmh->bindValue(':recipe_text',  $imagedata['recipe_text'],  PDO::PARAM_STR );

            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    
}