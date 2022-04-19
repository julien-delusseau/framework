<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title ?? 'Bienvenue' ?> | <?= SITE_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Framework / PHP développé avec PHP 8.1">
    <meta name="author" content="Julien Delusseau">
    <!--OpenGraph meta -->
    <meta property="og:description" content="Framework / PHP développé avec PHP 8.1"/>
    <meta property="og:title" content="Framework / PHP" />
    <meta property="og:image" content="https://i.ibb.co/cx3mkkS/render.png"/>
    <meta property="og:url" content="https://framework.juliendelusseau.fr/" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet">
    <link href="<?= URL ?>/public/css/bootstrap.css" rel="stylesheet">
    <link href="<?= URL ?>/public/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?= URL ?>/public/css/docs.css" rel="stylesheet">
    <link href="<?= URL ?>/public/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= URL ?>/public/js/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="<?= URL ?>/public/css/style.css" rel="stylesheet">
    <link href="<?= URL ?>/public/color/default.css" rel="stylesheet">

    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="<?= URL ?>/public/assets/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= URL ?>/public/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= URL ?>/public/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= URL ?>/public/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= URL ?>/public/assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
<header>
    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <!-- logo -->
                <a class="brand logo" href="<?= URL ?>"><img width="100px" src="<?= URL ?>/public/assets/img/logo.png" alt="" /></a>
                <!-- end logo -->
                <!-- top menu -->
                <div class="navigation">
                    <nav>
                        <ul class="nav topnav">
                            <li class="<?= $_SERVER['REQUEST_URI'] === '/blog/' ? 'active' : null ?>">
                                <a href="<?= URL ?>">Accueil</a>
                            </li>
                            <li class="<?= $_SERVER['REQUEST_URI'] === '/blog/pages/contact' ? 'active' : null ?>">
                                <a href="<?= URL ?>/pages/contact">Contact</a>
                            </li>
                            <?php if(isGranted('admin')): ?>
                                <li>
                                    <a href="<?= URL ?>/admin">Panneau admin</a>
                                </li>
                            <?php endif; ?>
                            <?php if(isGranted('admin') || isGranted('author')): ?>
                                <li class="<?= $_SERVER['REQUEST_URI'] === '/blog/post/create' ? 'active' : null ?>">
                                    <a href="<?= URL ?>/post/create">Créer un article</a>
                                </li>
                            <?php endif; ?>

                            <?php if(isLoggedIn()): ?>
                                <li class="<?= $_SERVER['REQUEST_URI'] === '/blog/user/profil' ? 'active' : null ?>">
                                    <a href="<?= URL ?>/user/profil">Mon profil</a>
                                </li>
                                <li>
                                    <a href="<?= URL ?>/user/logout">Se déconnecter</a>
                                </li>
                            <?php else: ?>
                                <li class="<?= $_SERVER['REQUEST_URI'] === '/blog/user/login' ? 'active' : null ?>">
                                    <a href="<?= URL ?>/user/login">Se connecter</a>
                                </li>
                                <li class="<?= $_SERVER['REQUEST_URI'] === '/blog/user/register' ? 'active' : null ?>">
                                    <a href="<?= URL ?>/user/register">S'enregistrer</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
                <!-- end menu -->
            </div>
        </div>
    </div>
</header>
<!-- Subhead
================================================== -->
<section id="subintro">
    <div class="jumbotron subhead" id="overview">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="centered">
                        <h3><?= $title ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="maincontent">
    <div class="container">
        <div class="row">
            <div class="span4">
                <?php require_once ROOT . '/views/templates/second_theme_aside.php' ?>
            </div>

            <!-- MAIN CONTENT -->
            <div class="span8">
                <?= $pageContent ?>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
    </div>
</section>
<!-- Footer
================================================== -->
<footer class="footer">
    <div class="verybottom">
        <div class="container">
            <div class="row">
                <div class="span6">
                    <p>
                        &copy; 2022 - Tous droits réservés
                    </p>
                </div>
                <div class="span6">
                    <div class="credits">
                        <!--
                          All the links in the footer should remain intact.
                          You can delete the links only if you purchased the pro version.
                          Licensing information: https://bootstrapmade.com/license/
                          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Serenity
                        -->
                        Développé par <a target="_blank" href="https://juliendelusseau.fr/">Julien Delusseau</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- JavaScript Library Files -->
<script src="<?= URL ?>/public/js/jquery.min.js"></script>
<script src="<?= URL ?>/public/js/jquery.easing.js"></script>
<script src="<?= URL ?>/public/js/google-code-prettify/prettify.js"></script>
<script src="<?= URL ?>/public/js/modernizr.js"></script>
<script src="<?= URL ?>/public/js/bootstrap.js"></script>
<script src="<?= URL ?>/public/js/jquery.elastislide.js"></script>
<script src="<?= URL ?>/public/js/sequence/sequence.jquery-min.js"></script>
<script src="<?= URL ?>/public/js/sequence/setting.js"></script>
<script src="<?= URL ?>/public/js/jquery.prettyPhoto.js"></script>
<script src="<?= URL ?>/public/js/application.js"></script>
<script src="<?= URL ?>/public/js/jquery.flexslider.js"></script>
<script src="<?= URL ?>/public/js/hover/jquery-hover-effect.js"></script>
<script src="<?= URL ?>/public/js/hover/setting.js"></script>

<script src="https://cdn.tiny.cloud/1/p12rp1yuccuuv2dswhimi3coza0upkceemi08yzrwvod412r/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#article-editor',
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image',
        plugins: 'advlist link image lists'
    });
</script>

<!-- Template Custom JavaScript File -->
<script src="<?= URL ?>/public/js/custom.js"></script>


</body>

</html>
