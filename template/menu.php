<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="ajout.php">Ajouter Voiture</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="afficher.php">Afficher Voiture</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="editer.php">Éditer Voiture</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="supprimer.php">Supprimer Voiture</a>
        </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="resultat.php" method="post">
          <input class="form-control mr-sm-2" type="search" name="recherche" placeholder="Marque, Type, Agence,..." aria-label="Search">
          <button class="btn btn-danger my-2 my-sm-0" type="submit">Recherche</button>
        </form>
    </div>
</nav>
</header>
