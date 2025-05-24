<?php 
    $fichier='../db/etudiant.json';
      $data= file_exists($fichier) ? json_decode(file_get_contents($fichier), true): [];
?>
<table id="ListeRetenuTableau">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Matricule</th>
            <th>Nom Complet</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Référentiel</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
    </thead> 
    <tbody id="corpsTableau">                    
        
    </tbody>
</table>
<br>
<div class="sousTableauApprenant"><div id="pagination"></div></div>
       
