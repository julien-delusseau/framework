<?php

/*
 * -----------------------------------------------------
 * NOM DU SITE
 * -----------------------------------------------------
 */

// Le nom du site
const SITE_NAME = "Framework CMS";

/*
 * -----------------------------------------------------
 * ADMINISTRATEUR
 * -----------------------------------------------------
 */

// Nom et email de l'administrateur principal
const ADMIN = "Julien Delusseau";
const ADMIN_EMAIL = "julien.delusseau@gmail.com";

/*
 * -----------------------------------------------------
 * BASE DE DONNÉES
 * -----------------------------------------------------
 */

// Accès à la base de données
const DB_HOST = 'localhost';
const DB_NAME = 'framework';
const DB_USER = 'root';
const DB_PASS = '';

/*
 * -----------------------------------------------------
 * INFORMATIONS PERSONNELLES
 * -----------------------------------------------------
 */

// Réseaux sociaux
const EMAIL = "";
const LINKEDIN = "";
const GITHUB = "";
const TWITTER = "";
const FACEBOOK = "";

/*
 * -----------------------------------------------------
 * GOOGLE MAP
 * -----------------------------------------------------
 */

// Intégration de la Google Map pour la page de contact
const GOOGLE_MAP = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d90493.79681550649!2d-0.6560518357303055!3d44.863696395642926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5527e8f751ca81%3A0x796386037b397a89!2sBordeaux!5e0!3m2!1sfr!2sfr!4v1650039920367!5m2!1sfr!2sfr" width="100%" height="380" style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';

/*
 * -----------------------------------------------------
 * MAILER
 * -----------------------------------------------------
 */

// DSN de votre boîte email
// Merci de vous référer à ce lien: https://symfony.com/doc/current/mailer.html
const DSN_EMAIL = "julien.delusseau@gmail.com";
const DSN_PASS = "ielqaipowfwaahqn";
const MAILER_DSN = "gmail+smtp://".DSN_EMAIL.":".DSN_PASS."@default";