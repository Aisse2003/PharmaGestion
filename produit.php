<?php

define("JOURS_ALERTE", 90);

$reference = "P006";
$nom = "Ibuprofene 400 mg, boite de 20 comprimes";
$categorie_id = 10;
$prix_achat = 900;
$prix_vente = 1400;
$stock = 4;
$seuil = 10;
$jours_avant_peremption = 974;

$marge = $prix_vente - $prix_achat;


echo "
 <h2>LA CATEGORIE </h2> <br>
1- Douleur et fievre <br>
2- Rhume et allergies <br>
3- Digestion <br>
4- Vitamines et complements <br>
5- Soins du visage et du corps <br>
6- Hygiene <br>
7- Bebe et maman <br>
8- Premiers secours et prevention <br>
 Faite votre choix: $categorie_id <br>
 ";


 switch($categorie_id){
    case 1:
        echo "<mark>Douleur et fievre  </mark>";
        break;

    case 2:
        echo "<mark>Rhume et allergies </mark>";
        break;

    case 3:
        echo "<mark>Digestion </mark>";
        break;

    case 4:
        echo "<mark>Vitamines et complements </mark>";
        break;
    
    case 5:
        echo "<mark>Soins du visage et du corps</mark>";
        break;

    case 6:
        echo "<mark>Hygiene</mark>";
        break;

    case 7:
        echo "<mark>Bebe et maman </mark>";
        break;

    case 8:
        echo "<mark>Premiers secours et prevention </mark>";
        break;

    default:
    echo "Categorie inconnue <br><br>";
 }

 echo "<h2> La marge </h2>";
 echo "$prix_vente - $prix_achat = $marge <br>";


echo "<h2> La disponibilite </h2>";
echo $disponibilite = ($stock > 0 && $jours_avant_peremption >= 0) ? "Disponible" : "Sur commande";

if ($jours_avant_peremption < 0) {
    $alerte = "Périmé";
} elseif ($stock == 0) {
    $alerte = "Rupture";
} elseif ($jours_avant_peremption < JOURS_ALERTE) {
    $alerte = "Péremption dans moins de 90 jours";
} elseif ($stock < $seuil) {
    $alerte = "Stock faible";
} else {
    $alerte = "Aucune alerte";
}


if ($alerte == "Perime" || $alerte == "Rupture") {
    $couleur_alerte = "danger";
} elseif ($alerte == "Stock faible" || $alerte == "Peremption dans moins de 90 jours") {
    $couleur_alerte = "warning";
} else {
    $couleur_alerte = "success";
}

$ventes_possibles = 0;

while ($stock - $ventes_possibles > $seuil) {
    $ventes_possibles++;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche produit</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="index.html">PharmaGestion</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="catalogue.html">Catalogue</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Gestion/connexion.html">Gestion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-5">
    <h1 class="text-center mb-4">Fiche produit</h1>

    <div class="card shadow mx-auto" style="max-width: 800px;">
        
<div class="card-header bg-success text-white">
    <h2 class="h4 mb-0"><?= $nom ?></h2>
</div>

<div class="card-body">
    <p><strong>Reference :</strong> <?= $reference ?></p>
    <p><strong>Categorie_id :</strong> <?= $categorie_id ?></p>
    <p><strong>Prix d'achat :</strong> <?= $prix_achat ?> FCFA</p>
    <p><strong>Prix de vente :</strong> <?= $prix_vente ?> FCFA</p>
    <p><strong>Marge :</strong> <?= $marge ?> FCFA</p>
    <p><strong>Stock disponible :</strong> <?= $stock ?> boîte(s)</p>
    <p><strong>Seuil de stock :</strong> <?= $seuil ?> boîte(s)</p>
    <p><strong>Jours avant peremption :</strong> <?= $jours_avant_peremption ?></p>
    <p><strong>Disponibilite :</strong> <?= $disponibilite ?></p>
    <p>
        <strong>Alerte :</strong>
        <span class="badge text-bg-<?= $couleur_alerte ?>">
            <?= $alerte ?>
        </span>
    </p>
</div>
</div>

<div class="card shadow mx-auto mt-4" style="max-width: 800px;">
    <div class="card-header">
        <h2 class="h5 mb-0">Prix au comptoir</h2>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>Quantite</th>
                    <th>Total (FCFA)</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if ($disponibilite == "Disponible") {
                    for ($quantite = 1; $quantite <= 5 && $quantite <= $stock; $quantite++) {
                        echo "<tr>";
                        echo "<td>" . $quantite . "</td>";
                        echo "<td>" . ($quantite * $prix_vente) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='2'>Ce produit ne peut pas etre vendu.</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


    <div class="alert alert-info mx-auto mt-4" style="max-width: 800px;">
        Ventes possibles avant l'alerte de stock : <?= $ventes_possibles ?>
    </div>
</main>

<footer class="bg-black text-white p-3 mt-3">
    <div class="container">
        <div>Pharmacie Ndeye Coumba. Route principale, a cote du ront-point, Guediawaye</div>
        <div>Telephone : 77 000 00 00 . Ouvert du lundi au samedi, de 8h a 22h</div>
        <div>Projet pedagogique . structure fictive</div>
    </div>
</footer>



<script src="bootstrap.bundle.min.js"></script>
</body>
</html>