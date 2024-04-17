<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Page de Présentation</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Au fil des contes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto"> <!-- Alignement à droite -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('caverne.index') }}">Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Présentation du Projet -->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6">
            <h2>Au file des contes</h2>
            <p>
                Bienvenue dans un univers magique où chaque jour est une nouvelle aventure,où
                 l imagination prend son envol ! Avec "Au Fil des Contes", préparez-vous à vivre
                 des moments de pur bonheur
                 et à explorer un monde rempli de surprises et de fantaisie !
            </p>
            <a href="#" class="btn btn-primary">Télécharger l Application</a>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('images/livredor.png')}}" alt="Image du Projet" class="img-fluid">
        </div>
    </div>
</div>

<!-- Section Commentaires -->
<section id="commentaires" class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-4">Livre d&#039or</h2>
        <div class="row">

            @foreach ( $commentaires as $commentaire )


            <div class="col-md-6">
                <div class="card mb-4">
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $commentaire->pseudo }}</h5>
                        <p class="card-text"> {{ $commentaire->commentaire }}</p>
                    </div>
                </div>
            </div>
            @endforeach


            <!-- Ajoutez plus de cartes selon le besoin -->
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
