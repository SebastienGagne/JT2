<main style="margin:0px 20px 0px 20px;">
    <h2>Liste des banières</h2>
    <hr>
    <div>
    <?php 
    foreach ($affichage as $affichage_b) {
        echo '<div class="galerieB">';
        echo '<div style="width:15em;">'.$affichage_b['pres']."</div>";
        echo $affichage_b['ligne'];
        echo $affichage_b['lien'];
        echo '</div>';
        echo '<hr>';
    }
    ?>
    </div>
</main>










