DROP TABLE IF EXISTS premember_2;
CREATE TABLE premember_2 (
    id              MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    mail_address    VARCHAR(100),
    username   	    VARCHAR(50),
    password   	    VARCHAR(128),
    link_pass  	    VARCHAR(128),
    reg_date   	    DATETIME,
    PRIMARY KEY (id)
);
