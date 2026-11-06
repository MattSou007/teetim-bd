<?php

/*********************** Librairie de code pour gérer le catalogue des produits ***********************/

/**
 * Retourne les thèmes et les produits
 * @param string $categorie Catégorie de produits (ex: teeshirts, casquettes, etc.)
 * @param string $codeLangue Code en deux lettres de la langue d'affichages
 * @param string $critereTri Valeur du critère de tri.
 * @return array
 */
function obtenirCatalogue($categorie, $codeLangue, $critereTri)
{
    $catalog = json_decode(file_get_contents("data/$categorie.json"));

    $themes = [];
    $produits = [];

    foreach ($catalog as $codeTheme => $detailTheme) {
        $themes[$codeTheme] = $detailTheme->theme->$codeLangue;
        $produits = array_merge($produits, $detailTheme->produits);
    }

    if (function_exists($critereTri)) {
        usort($produits, $critereTri);
    } else {
        shuffle($produits);
    }

    return [$themes, $produits];
}

/**
 * Function de comparaison dees produits selon le critère de triage (Prix Descendants)
 * @param object $prd1 premier produit à comparer par prix descendants
 * @param object $prd2 deuxième produit à comparer par prix descendants
 * @return int nombre entier, positif, négatif ou 0 selon le résultat de comparaison
 */
function prixDesc($prd1, $prd2)
{
    if ($prd2->prix > $prd1->prix) {
        return 1;
    } else if ($prd2->prix < $prd1->prix) {
        return -1;
    } else {
        return 0;
    }

    // return $prd2->prix - $prd1->prix;
}

/**
 * Function de comparaison dees produits selon le critère de triage (Prix Ascendants)
 * @param object $prd1 premier produit à comparer par prix descendants
 * @param object $prd2 deuxième produit à comparer par prix descendants
 * @return int nombre entier, positif, négatif ou 0 selon le résultat de comparaison
 */
function prixAsc($prd1, $prd2)
{
    if ($prd1->prix > $prd2->prix) {
        return 1;
    } else if ($prd1->prix < $prd2->prix) {
        return -1;
    } else {
        return 0;
    }
}

// nom asc (plus tard)

// nom desc (plus tard)

/**
 * Function de comparaison dees produits selon le critère de triage (Ventes Descendants)
 * @param object $prd1 premier produit à comparer par prix descendants
 * @param object $prd2 deuxième produit à comparer par prix descendants
 * @return int nombre entier, positif, négatif ou 0 selon le résultat de comparaison
 */
function ventesDesc($prd1, $prd2)
{
    if ($prd2->ventes > $prd1->ventes) {
        return 1;
    } else if ($prd2->ventes < $prd1->ventes) {
        return -1;
    } else {
        return 0;
    }
}

/**
 * Function de comparaison dees produits selon le critère de triage (Date d'ajout Descendants)
 * @param object $prd1 premier produit à comparer par prix descendants
 * @param object $prd2 deuxième produit à comparer par prix descendants
 * @return int nombre entier, positif, négatif ou 0 selon le résultat de comparaison
 */
function dacDesc($prd1, $prd2)
{
    if ($prd2->dac > $prd1->dac) {
        return 1;
    } else if ($prd2->dac < $prd1->dac) {
        return -1;
    } else {
        return 0;
    }
}
