DROP TABLE IF EXISTS favorite;
CREATE TABLE favorite (
    id             MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id        SMALLINT,
    recipe_id      SMALLINT,
    PRIMARY KEY (id)
);
