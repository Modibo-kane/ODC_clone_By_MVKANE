<?php
session_start();

if (isset($_GET['id']) && isset($_GET['statut'])) {
    $id = $_GET['id'];
    $statutModifier = $_GET['statut'];
    include '../model/model.php';

    changerStatut("etudiant", $id, $statutModifier);
    header("location: ../view/apprenants.php");
    exit();
};

