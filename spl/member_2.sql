DROP TABLE IF EXISTS member_2;
CREATE TABLE member_2 (
    id          MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    mail_address    VARCHAR(100),
    username   	    VARCHAR(50),
    password   	    VARCHAR(128),
    reg_date   	    DATETIME, -- 登録日
    cancel_date     DATETIME, -- 退会日
    PRIMARY KEY (id) -- テーブルの主キー
);

INSERT INTO member_2 (mail_address, username, password, reg_date, cancel_date) 
VALUES ('sample@domain.com', 'sample', '$2y$10$Rpe1TAzuNoTn5w1pzU4Ah.HPG/LDTh/TuXyvPzHnLm1eJd4tDWLgW', NOW(), NOW());

-- パスワードは「hogehoge」をハッシュ化したものです．
-- ログイン画面では，メールアドレス「sample@domain.com」，パスワード「hogehoge」と入力してください
