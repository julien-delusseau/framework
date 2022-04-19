<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
       id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?= URL ?>/admin">
            <img src="<?= URL ?>/public/assets/img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">CMS Admin</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= URL ?>/admin/users">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Utilisateurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= URL ?>/admin/posts">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">feed</i>
                    </div>
                    <span class="nav-link-text ms-1">Articles</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= URL ?>/admin/comments">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">chat</i>
                    </div>
                    <span class="nav-link-text ms-1">Commentaires</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= URL ?>/admin/categories">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">class</i>
                    </div>
                    <span class="nav-link-text ms-1">Catégories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="<?= URL ?>/user/logout">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">logout</i>
                    </div>
                    <span class="nav-link-text ms-1">Se déconnecter</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn bg-gradient-primary mt-4 w-100"
               href="<?= URL ?>" >Retour au site</a>
        </div>
    </div>
</aside>