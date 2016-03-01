/**
 * Script sql de création de la base
 * 
 * TP MicroCMS - Évoluez vers une architecture PHP professionnelle
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @update      01/03/2016
 * @version     1.0.1
 * @copyright   OpenClassrooms - Baptise Pesquet
 *
 * @commentaire v1.0.0 : coder la table article
 *              v1.0.1 : coder la table commentaire
 */
-- --------------------------------------------
-- CREATION DE LA STRUCTURE DE LA TABLE article
-- --------------------------------------------
DROP TABLE if exists t_comment;
DROP TABLE if exists t_article;

CREATE TABLE t_article (
    art_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    art_title VARCHAR(100) NOT NULL,
    art_content VARCHAR(1000) NOT NULL
) engine=innodb CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE t_comment (
    com_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    com_author VARCHAR(100) NOT NULL,
    comm_content VARCHAR(500) NOT NULL,
    art_id INTEGER NOT NULL,
    CONSTRAINT fk_com_art FOREIGN KEY(art_id) REFERENCES t_article(art_id)
) engine=innodb CHARACTER SET utf8 COLLATE utf8_unicode_ci;