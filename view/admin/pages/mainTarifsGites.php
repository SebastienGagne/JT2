<main style="margin:0px 20px 0px 20px;">
    <form action="index.php?controller=pageAdmin&action=modified&nomPage=<?php echo $page->get('nomPage'); ?>" method="post" enctype='multipart/form-data'>
        <?php include_once("zone1.php"); ?>
        <?php include_once("photos.php"); ?>
        <fieldset class="fieldset_tarifs">
            <legend>Tarif des gîtes</legend>
            <table class="table_tarifs">
                <tr>
                    <th>gîte</th>
                    <th>basse saison</th>
                    <th>moyenne saison</th>
                    <th>haute saison</th>
                </tr>
                <?php 
                    foreach ($tarifGites as $i => $tabGite) {
                        $ligne  = "<td>".$tabGite['gite']."</td>";
                        $ligne .= "<td><input type='number' name='tarifBS".$i."' value='".$tabGite['tarifBS']."'> €</td>";
                        $ligne .= "<td><input type='number' name='tarifMS".$i."' value='".$tabGite['tarifMS']."'> €</td>";
                        $ligne .= "<td><input type='number' name='tarifHS".$i."' value='".$tabGite['tarifHS']."'> €</td>";
                        echo "<tr>".$ligne."</tr>";
                    }
                ?>
            </table>
        </fieldset>
        <?php include_once("boutonvalider.php"); ?>
    </form>
</main>