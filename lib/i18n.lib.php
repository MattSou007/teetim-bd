<?php

/*********************** Librairie des fonctions utiles à l'i18n ***********************/

/**
 * Obtient la listes des codes langues disponibles sur le site.
 * @return array Tableau des codes de langues.
 */
function obtenirLanguesDispo()
{
    /*** Tableau des codes de langues disponibles ***/
    $languesDispo = [];
    $contenuI18n = scandir('i18n');
    for ($i = 0; $i < count($contenuI18n); $i++) {
        $fichier = $contenuI18n[$i];
        if ($fichier != '.' && $fichier != '..') {
            $languesDispo[] = substr($fichier, 0, 2);
        }
    }

    return $languesDispo;
}

/**
 * Détermine la langue active du site.
 * @param array $languesPermisses Tableau des codes ISO639-1 des langues disponibles
 * @return string Code de la langue en 2
 */
function determinerLangue($languesPermisses)
{
    $langue = 'fr';

    if (isset($_COOKIE['choixLangue']) && in_array($_COOKIE['choixLangue'], $languesPermisses)) {
        $langue = $_COOKIE['choixLangue'];
    }

    if (isset($_GET['lan']) &&  in_array($_GET['lan'], $languesPermisses)) {
        $langue = $_GET['lan'];
        setcookie('choixLangue', $langue, time() + 30 * 24 * 3600);
    }

    return $langue;
}

/**
 * Retourne les textes statiques de la page désignée dans la langue indiquée.
 * @param string $codeLangue Code de la langue active.
 * @param string $nomPage Nom de la page requise.
 * @return array Tableau des textes statiques organisés par section dans un objet.
 */
function obtenirTxtStatiques($codeLangue, $nomPage)
{
    $textes = json_decode(file_get_contents("i18n/" . $codeLangue . ".json"));

    return [$textes->entete, $textes->pp, $textes->$nomPage];
}

/**
 * Détermine la direction d'écriture du texte.
 * @param string $codeLangue Code de la langue active.
 * @return 
 */
function obtenirDirectionTxt($codeLangue)
{
    return $directionEcriture = in_array($codeLangue, ["ar", "he", "fa", "ur", "dv", "ps", "ku"])
        ? 'rtl' : 'ltr';
}
