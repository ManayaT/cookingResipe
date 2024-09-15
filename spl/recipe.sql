DROP TABLE IF EXISTS recipe;
CREATE TABLE recipe (
    id              MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id        SMALLINT,
    recipe_title    VARCHAR(100),
    recipe_picture  VARCHAR(100),
    recipe_text     VARCHAR(4500),
    PRIMARY KEY (id)
);