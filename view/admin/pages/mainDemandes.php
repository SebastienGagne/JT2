<main style="margin:0px 20px 0px 20px;">
    <form action="index.php?controller=reservation&action=gererDemandes&gite=<?php echo $gite; ?>" method="post">
        <h2>Planning du gîte <?php echo $gite; ?></h2>
        <?php echo $cal['entete_gererDemandes']; ?>
        <?php echo $cal['affichage']; ?>
        <?php 
            echo $message_global;
            foreach ($tableau_messages_demandes as $key => $value) {
                echo $value;
            }
        ?>
    </form>
</main>