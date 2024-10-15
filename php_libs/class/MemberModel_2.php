<?php

class MemberModel_2 extends BaseModel {
    //----------------------------------------------------
    // 会員のメールアドレスと同じものがないか調べる
    //----------------------------------------------------
    public function check_mail_address($userdata){
        try {
            $sql= "SELECT * FROM member_2 WHERE mail_address = :mail_address ";
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
    // 会員情報をユーザー名（メールアドレス）で検索
    //----------------------------------------------------
    public function get_authinfo($mail_address){
        $data = [];
        try {
            // sql文章の作成
            $sql= "SELECT * FROM member_2 WHERE mail_address = :mail_address limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':mail_address',  $mail_address,  PDO::PARAM_STR );
            $stmh->execute();
            // ユーザが存在する場合，データが取得できる
            $data = $stmh->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        
        return $data;
    }

    //----------------------------------------------------
    // 会員情報をユーザーIDで検索
    //----------------------------------------------------
    public function get_member_data_id($id){
        $data = [];
        try {
            $sql= "SELECT * FROM member WHERE id = :id limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT );
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }

    //----------------------------------------------------
    // レシピの最終IDを取得
    //----------------------------------------------------
    public function get_last_recipe_id(){
        $data = [];
            try {
                // 次のIDを取得するSQLクエリ
                $sql = "SELECT COALESCE(MAX(id), 0) +1 AS next_id FROM recipe";
                $stmh = $this->pdo->prepare($sql);
                $stmh->execute();
                $data = $stmh->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $Exception) {
                print "エラー：" . $Exception->getMessage();
            }
            return $data;
    }

    //----------------------------------------------------
    // 会員情報を完全に削除する
    //----------------------------------------------------
    public function delete_member($id){
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM member WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT );
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、削除しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // レシピを削除する
    //----------------------------------------------------
    public function delete_recipe($recipe_id) {
        try {
            $this->pdo->beginTransaction();
            
            // お気に入りからレシピを削除
            $sql1 = "DELETE FROM favorite WHERE recipe_id = :recipe_id";
            $stmh1 = $this->pdo->prepare($sql1);
            $stmh1->bindValue(':recipe_id', $recipe_id, PDO::PARAM_INT);
            $stmh1->execute();
            
            // レシピを削除
            $sql2 = "DELETE FROM recipe WHERE id = :id";
            $stmh2 = $this->pdo->prepare($sql2);
            $stmh2->bindValue(':id', $recipe_id, PDO::PARAM_INT);
            $stmh2->execute();
    
            $this->pdo->commit();
            //print "データを" . $stmh2->rowCount() . "件、削除しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // レシピ一覧取得処理
    //----------------------------------------------------
    public function get_recipe_list($search_key){
        $sql = <<<EOS
        SELECT
            r.id as id,
            r.user_id as user_id,
            r.recipe_title as recipe_title,
            r.recipe_picture as recipe_picture,
            r.recipe_text as recipe_text
        FROM
            recipe r
        EOS;

        // レシピ検索機能用の条件式
        if($search_key != ""){
            $sql .= " WHERE r.user_id LIKE :user_id";
        }

        try {
            $stmh = $this->pdo->prepare($sql);
            // 情報検索機能用の条件式
            if($search_key != ""){
                $search_key = '%' . $search_key . '%'; 
                $stmh->bindValue(':user_id',  $search_key, PDO::PARAM_STR );
            }
            
            $stmh->execute();
            // 検索件数を取得
            $count = $stmh->rowCount();
            // 検索結果を多次元配列で受け取る
            $i=0;
            $data = [];
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)){
                foreach( $row as $key => $value){
                        $data[$i][$key] = $value;
                }
                $i++;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return [$data, $count];
    }

    //----------------------------------------------------
    // レシピ一覧取得処理
    //----------------------------------------------------
    public function get_recipe_all($search_key){
        $sql = <<<EOS
        SELECT
            r.id as id,
            r.user_id as user_id,
            r.recipe_title as recipe_title,
            r.recipe_picture as recipe_picture,
            r.recipe_text as recipe_text
        FROM
            recipe r
        EOS;

        // レシピ検索機能用の条件式
        if($search_key != ""){
            $sql .= " WHERE r.recipe_title LIKE :recipe_title";
        }

        try {
            $stmh = $this->pdo->prepare($sql);
            // 情報検索機能用の条件式
            if($search_key != ""){
                $search_key = '%' . $search_key . '%'; 
                $stmh->bindValue(':recipe_title',  $search_key, PDO::PARAM_STR );
            }
            
            $stmh->execute();
            // 検索件数を取得
            $count = $stmh->rowCount();
            // 検索結果を多次元配列で受け取る
            $i=0;
            $data = [];
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)){
                foreach( $row as $key => $value){
                        $data[$i][$key] = $value;
                }
                $i++;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return [$data, $count];
    }

    //----------------------------------------------------
    // お気に入りレシピ一覧取得処理
    //----------------------------------------------------
    public function get_favorite_all($user_id)
    {
        $sql = <<<EOS
        SELECT
            r.id as id,
            r.user_id as user_id,
            r.recipe_title as recipe_title,
            r.recipe_picture as recipe_picture,
            r.recipe_text as recipe_text
        FROM
            recipe r
        JOIN
            favorite f ON r.id = f.recipe_id
        WHERE
            f.user_id = :user_id
        EOS;

        try {
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            
            $stmh->execute();
            // 検索件数を取得
            $count = $stmh->rowCount();
            // 検索結果を多次元配列で受け取る
            $i = 0;
            $data = [];
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)){
                foreach($row as $key => $value){
                    $data[$i][$key] = $value;
                }
                $i++;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return [$data, $count];
    }

    //----------------------------------------------------
    // レシピ取得処理
    //----------------------------------------------------
    public function get_recipe($id){
        $data = [];
        try {
            $sql= "SELECT * FROM recipe WHERE id = :id limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT );
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);

            // 改行を<br>タグに変換
            $data['recipe_text'] = nl2br(htmlspecialchars($data['recipe_text'], ENT_QUOTES, 'UTF-8'));

            } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }

    //----------------------------------------------------
    // recipeテーブルへの登録
    //----------------------------------------------------
    public function set_favorite($user_id, $recipe_id){
        try {
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO favorite (user_id, recipe_id) VALUES (:user_id, :recipe_id)";

            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
            $stmh->bindValue(':recipe_id', (int)$recipe_id, PDO::PARAM_INT);

            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 会員のidとお気に入りidの組み合わせが重複しているものがないか調べる
    //----------------------------------------------------
    public function check_favorite($user_id, $recipe_id) {
        try {
            $sql = "SELECT * FROM favorite WHERE user_id = :user_id AND recipe_id = :recipe_id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmh->bindValue(':recipe_id', $recipe_id, PDO::PARAM_INT);
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
}
