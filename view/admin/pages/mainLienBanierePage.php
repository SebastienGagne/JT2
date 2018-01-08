<main style="margin:0px 20px 0px 20px;">
    <h2>Affectation des banières par page</h2>
    <hr>
    <form action="index.php?controller=baniere&action=affectation_banieres" method="post">
        <div>
        <?php 
            echo $table;
        ?>
        </div>
        <?php include_once("boutonvalider.php"); ?>
    </form>
</main>










