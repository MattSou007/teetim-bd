<?php

/** 
 * @var stdClass $_ : raccourci pour la section texte de cette page.
 * @var string $langue : langue du page
 */

// Définir la variable $page pour indiquer la page affichée.
$page = 'teeshirts';

include('parties-communes/entete.php');
include('lib/catalogue.lib.php');

$tri = (isset($_GET['tri'])) ? $_GET['tri'] : 'aleatoire';

[$themes, $produits] = trierProduits($page, $langue, $tri);

// Formatteur des montants d'argent
$formatteurMontants = new NumberFormatter($langue, NumberFormatter::CURRENCY);

?>

<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage ?></h1>
		<form class="controle">
			<div class="filtre">
				<label for="filtre">Filtrer par thème : </label>
				<select name="filtre" id="filtre">
					<option value="tous">Tous les produits</option>

					<!-- Gabarit d'une option de thème (example pour class) -->
					<?php foreach ($themes as $code => $nom) : ?>
						<option value="<?= $code; ?>"><?= $nom; ?></option>
					<?php endforeach; ?>

				</select>
			</div>
			<div class="tri">
				<label for="tri">Trier par : </label>
				<select name="tri" id="tri">
					<option <?php ($tri == 'aleatoire') ? 'selected' : ''; ?> value="aleatoire">Aléatoire</option>
					<option <?php ($tri == 'ventesDesc') ? 'selected' : ''; ?> value="ventesDesc">Meilleur vendeur</option>
					<option <?php ($tri == 'prixAsc') ? 'selected' : ''; ?> value="prixAsc">Prix / ascendant</option>
					<option <?php ($tri == 'prixDesc') ? 'selected' : ''; ?> value="prixDesc">Prix / descendant</option>
					<!-- deux options de tri alphébatique ne sont pas implémenté encore -->
					<!-- <option <?php ($tri == 'nomAsc') ? 'selected' : ''; ?> value="nomAsc">Alpha / ascendant</option>
					<option <?php ($tri == 'nomDesc') ? 'selected' : ''; ?> value="nomDesc">Alpha / descendant</option> -->
					<option <?php ($tri == 'dacDesc') ? 'selected' : ''; ?> value="dacDesc">Nouveauté</option>
				</select>
			</div>
		</form>
	</article>
	<article class="principal">
		<!-- Gabarit -->
		<?php foreach ($produits as $prd) : ?>
			<div class="produit">
				<span class="image">
					<img src="images/produits/teeshirts/<?= $prd->id; ?>.webp" alt="<?= $prd->nom->$langue; ?>">
				</span>
				<span class="nom"><?= $prd->nom->$langue; ?></span>
				<span class="prix"><?= $formatteurMontants->formatCurrency($prd->prix, 'CAD'); ?></span>
				<span><?= $prd->ventes; ?></span>
				<span><?= $prd->dac; ?></span>
			</div>
		<?php endforeach; ?>
	</article>
</main>
<?php include('parties-communes/pied2page.php'); ?>