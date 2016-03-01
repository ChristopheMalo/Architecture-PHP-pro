/**
 * Script sql de création de la base
 * 
 * TP micro-CMS - Évoluez vers une architecture PHP professionnelle
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptise Pesquet
 */
-- --------------------------------------------
-- CREATION DE LA STRUCTURE DE LA TABLE article
-- --------------------------------------------
DROP TABLE if exists t_article;

CREATE TABLE t_article (
    art_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    art_title VARCHAR(100) NOT NULL,
    art_content VARCHAR(1000) NOT NULL
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_unicode_ci;