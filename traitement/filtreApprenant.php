<?php
header('Content-Type: application/json');

// 1. Lire le contenu du fichier JSON
$fichier = '../db/etudiant.json';
$donnees = file_exists($fichier) ? json_decode(file_get_contents($fichier), true) : [];
// 3. Retourner les données au format JSON
echo json_encode(array_values($donnees), JSON_PRETTY_PRINT);
