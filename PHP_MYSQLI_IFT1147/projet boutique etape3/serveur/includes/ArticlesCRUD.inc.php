<body id ="articlesBody2" onLoad='initialiser(<?php echo "\"" . $msg . "\""; ?>);chargerArticles("A","../articles/liste.php");'>
    <?php
require_once("../../includes/menu_admin.inc.php");
?>
    <div id='contenu'></div>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-2">
                            <h2>Articles</h2>
                        </div>
                        <div class="col-sm-7">
                            <nav class="navbar">
                                <ul>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Catégories
                                        </a>
                                        <ul id="selCategs" class="dropdown-menu dropdown-menu-dark"
                                            aria-labelledby="navbarDarkDropdownMenuLink">
                                        </ul>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Trier par
                                        </a>
                                        <ul id="selCategs" class="dropdown-menu dropdown-menu-dark"
                                            aria-labelledby="navbarDarkDropdownMenuLink">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="javascript:obtenirXML('titre');" onclick="trier('nomarticle')">Titre</a>
                                                <a class="dropdown-item" href="javascript:obtenirXML('titre');" onclick="trier('prix')">Prix</a>
                                                <a class="dropdown-item"
                                                    href="javascript:obtenirXML('titre');" onclick="trier('ida')">Numéro</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="nav-item">
                                        <form class="form-inline" role="form">
                                            <div class="form-group">
                                                <div class="inner-addon right-addon">
                                                    <i class="loupe bi bi-search"></i>
                                                    <input id = "recherches1" type="text" oninput ="research()" class="form-control" placeholder="Recherche"/>
                                                </div>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class=" col-sm-3">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#modalAjouterArticles"><i class="bi bi-plus-circle"></i>
                                <span>Ajouter</span></button>
                            <button type="button" class="btn btn-danger" onclick="enleverMultiplesArticles()">
                                <i class="bi bi-dash-circle"></i> <span>Enlever</span></button>
                        </div>
                    </div>
                </div>
                <table id = "tableau" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll" onclick="checkAll()">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>Numéro</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Disponible</th>
                            <th>Seuil</th>
                        </tr>dd
                    </thead>
                    <tbody id="emp_body">
                    <tbody id="emp_body1">
                    </tbody>
                    <tfooter>
                        <tr>
                            <th colspan="11"> 
                                <div id="pager">
                                    <ul id="pagination" class="pagination-sm"></ul>
                                </div>
                            </th>
                        </tr>
                    </tfooter> 
            </table>

        </div>
    </div>
    </div>
    <!-- Ajouter film Modal HTML -->
    <div class="modal fade" id="modalAjouterArticles" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enregistrer un article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row  needs-validation" enctype="multipart/form-data"
                        action="../articles/enregistrer.php" method="POST">
                        <div class="col-md-12">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="desc" class="form-label">Description</label>
                            <input type="text" class="form-control" id="desc" name="desc" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="categ" class="form-label">Catégorie</label>
                            <select id="categ" name="categ" class="form-select form-select-sm"
                                aria-label=".form-select-sm example">
                                

                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="prix" class="form-label">Prix</label>
                            <input type="text" class="form-control" id="prix" name="prix" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="qted" class="form-label">Quantité</label>
                            <input type="text" class="form-control" id="qted" name="qted" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="seuil" class="form-label">Seuil</label>
                            <input type="text" class="form-control" id="seuil" name="seuil" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="img" class="form-label">Image</label>
                            <input type="file" class="form-control" id="img" name="img" value="">
                        </div>
                        <div class="col-12">
                            <span>&nbsp;</span>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div class="modal fade" id="modalEditerArticles" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier un article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row  needs-validation" enctype="multipart/form-data" action="../articles/modifier.php"
                        method="POST">
                        <div class="col-md-12">
                            <label for="ida_m" class="form-label"></label>
                            <input type="text" class="form-control" id="ida_m" name="ida_m" value="" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="nom_m" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom_m" name="nom_m" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="desc_m" class="form-label">Description</label>
                            <input type="text" class="form-control" id="desc_m" name="desc_m" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="categ_m" class="form-label">Catégorie</label>
                            <select id="categ_m" name="categ_m" class="form-select form-select-sm"
                                aria-label=".form-select-sm example">
                                <option value="arb">Articles de bureaux</option>
                                <option value="imp">Imprimantes</option>
                                <option value="cad">Cadres</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="prix_m" class="form-label">Prix</label>
                            <input type="text" class="form-control" id="prix_m" name="prix_m" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="qted_m" class="form-label">Quantité</label>
                            <input type="text" class="form-control" id="qted_m" name="qted_m" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="seuil_m" class="form-label">Seuil</label>
                            <input type="text" class="form-control" id="seuil_m" name="seuil_m" value="" required>
                        </div>
                        <div class="col-md-12">
                            <label for="img_m" class="form-label">Image</label>
                            <input type="file" class="form-control" id="img_m" name="img_m" value="">
                        </div>
                        <div class="col-12">
                            <span>&nbsp;</span>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div class="modal fade" id="supprimerMembreModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr que vous voulez désactiver ce Membre ?</p>

                    <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Annuler">
                    <input type="button" onClick="supprimer();" class="btn btn-danger" value="Supprimer">


                </div>
            </div>
        </div>
    </div>
    <!-- Formulaires -->

    <form id="formEnlever" action="../articles/enlever.php" method="POST">
        <input type="hidden" id="idar" name="idar" value="">
    </form>

    <form id="formulaire1" action="../articles/enleverMultiples.php" method="POST">
        <input type="hidden" id="idaM" name="idaM" value="">
    </form>

    <div class="toast-container posToast">
        <div id="toast" class="toast  align-items-center text-white bg-danger border-0" data-bs-autohide="false"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="../../../client/public/images/message.png" width=24 height=24 class="rounded me-2"
                    alt="message">
                <strong class="me-auto">Messages</strong>
                <small class="text-muted"></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="textToast" class="toast-body">
                <!-- texte du Toast -->
            </div>
        </div>
    </div>
    <form id="dc" action="../connexion/deconnecter.php" method="POST"></form>
</body>