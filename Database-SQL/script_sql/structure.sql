/**
 * Script sql de création de la base
 * 
 * TP MicroCMS - Évoluez vers une architecture PHP professionnelle
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @update      04/03/2016
 * @version     1.0.2
 * @copyright   OpenClassrooms - Baptise Pesquet
 *
 * @commentaire v1.0.0 : coder la table article
 *              v1.0.1 : coder la table commentaire
 *              v1.0.2 : coder la table user - updater la table commentaire
 */
-- --------------------------------------------------
-- SUPPRIME LES TABLES SI ELLE EXISTE
-- --------------------------------------------------
DROP TABLE IF EXISTS t_comment;
DROP TABLE IF EXISTS t_user;
DROP TABLE IF EXISTS t_article;


-- --------------------------------------------------
-- CREATION DE LA STRUCTURE DE LA TABLE article
-- --------------------------------------------------
CREATE TABLE t_article (
    art_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    art_title VARCHAR(100) NOT NULL,
    art_content VARCHAR(2000) NOT NULL
) engine=innodb CHARACTER SET utf8 COLLATE utf8_unicode_ci;


-- --------------------------------------------------
-- CREATION DE LA STRUCTURE DE LA TABLE user
-- --------------------------------------------------
CREATE TABLE t_user (
    usr_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    usr_name VARCHAR(50) NOT NULL,
    usr_password VARCHAR(88) NOT NULL,
    usr_salt VARCHAR(23) NOT NULL,
    usr_role VARCHAR(50) NOT NULL
) engine=innodb CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- --------------------------------------------------
-- CREATION DE LA STRUCTURE DE LA TABLE commentaire
-- --------------------------------------------------
CREATE TABLE t_comment (
    com_id INTEGER NOT NULL PRIMARY KEY auto_increment,
    com_content VARCHAR(500) NOT NULL,
    art_id INTEGER NOT NULL,
    usr_id INTEGER NOT NULL,
    CONSTRAINT fk_com_art FOREIGN KEY(art_id) REFERENCES t_article(art_id),
    CONSTRAINT fk_com_usr FOREIGN KEY(usr_id) REFERENCES t_user(usr_id)
) engine=innodb CHARACTER SET utf8 COLLATE utf8_unicode_ci;