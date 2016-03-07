/**
 * Script sql de création de la base
 * Le code utilisateur doit être créé en remplaçant les données
 * 
 * TP micro-CMS - Évoluez vers une architecture PHP professionnelle
 * 
 * @author      Christophe Malo
 * @date        29/02/2016
 * @version     1.0.0
 * @copyright   OpenClassrooms - Baptise Pesquet
 */
-- --------------------------------------
-- CREATION DE LA BASE microcms
-- --------------------------------------
CREATE DATABASE if not exists microcms CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE microcms;

-- --------------------------------------
-- CREATION DU USER
-- --------------------------------------
GRANT all privileges ON microcms.* TO 'microcms_user'@'localhost' identified BY 'mdb_secret_cms';
