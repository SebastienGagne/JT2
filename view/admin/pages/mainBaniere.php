<main style="margin:0px 20px 0px 20px;">
    <style type="text/css">
        .imgcol {
            width:500px;
        }
    </style>

    <form action="index.php?controller=baniere&action=modified&nomBaniere=<?php echo $nb; ?>" method="post" enctype='multipart/form-data'>
    	<input type="hidden" name="urlPhoto1_T" value="<?php echo $baniere->get('urlBaniere1'); ?>">
        <input type="hidden" name="urlPhoto2_T" value="<?php echo $baniere->get('urlBaniere2'); ?>">
        <input type="hidden" name="urlPhoto3_T" value="<?php echo $baniere->get('urlBaniere3'); ?>">
        <input type="hidden" name="urlPhoto4_T" value="<?php echo $baniere->get('urlBaniere4'); ?>">
            
        <div style="display:flex;flex-direction:row;justify-content:space-between;width:80%;margin-left:10%;margin-top:20px;">
            <fieldset style="display:flex;flex-direction:column;">
                <legend>Photos de la banière <?php echo $baniere->get('nomBaniere'); ?></legend>
                <div style="min-width:1000px;border-radius:2px;border:solid 1px grey; box-shadow: 1px 1px 1px grey;padding:5px;margin:10px 0px;display:flex;flex-direction: column;align-items: center;">
                    <div style="display:flex;flex-direction:row;justify-content: space-between;width:100%;">
                        <div style="margin:0px 3px;display:flex;flex-direction:column;justify-content:space-around;align-items: center;">
                            <img class="imgcol" src="<?php echo $baniere->get('urlBaniere1'); ?>">
                            <label>photo actuelle</label>
                        </div>
                        <div style="margin:0px 3px;display:flex;flex-direction:column;justify-content:space-around;align-items: center;">
                            <div id="imgstore1"></div>
                            <label id="labelNP1" style="display:none;">nouvelle photo</label>
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:row;">
                        <input type='file' name='urlBaniere1' id="getimage1" onclick="afficherLabelNP('1');">
                    </div>
                </div>
                <div style="min-width:1000px;border-radius:2px;border:solid 1px grey; box-shadow: 1px 1px 1px grey;padding:5px;margin:10px 0px;display:flex;flex-direction: column;align-items: center;">
                    <div style="display:flex;flex-direction:row;justify-content: space-between;width:100%;">
                        <div style="margin:0px 3px;display:flex;flex-direction:column;justify-content:space-around;align-items: center;">
                            <img class="imgcol" src="<?php echo $baniere->get('urlBaniere2'); ?>">
                            <label>photo actuelle</label>
                        </div>
                        <div style="margin:0px 3px;display:flex;flex-direction:column;justify-content:space-around;align-items: center;">
                            <div id="imgstore2"></div>
                            <label id="labelNP2" style="display:none;">nouvelle photo</label>
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:row;">
                        <input type='file' name='urlBaniere2' id="getimage2" onclick="afficherLabelNP('2');">
                    </div>
                </div>
                <div style="min-width:1000px;border-radius:2px;border:solid 1px grey; box-shadow: 1px 1px 1px grey;padding:5px;margin:10px 0px;display:flex;flex-direction: column;align-items: center;">
                    <div style="display:flex;flex-direction:row;justify-content: space-between;width:100%;">
                        <div style="margin:0px 3px;display:flex;flex-direction:column;justify-content:space-around;align-items: center;">
                            <img class="imgcol" src="<?php echo $baniere->get('urlBaniere3'); ?>">
                            <label>photo actuelle</label>
                        </div>
                        <div style="margin:0px 3px;display:flex;flex-direction:column;justify-content:space-around;align-items: center;">
                            <div id="imgstore3"></div>
                            <label id="labelNP3" style="display:none;">nouvelle photo</label>
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:row;">
                        <input type='file' name='urlBaniere3' id="getimage3" onclick="afficherLabelNP('3');">
                    </div>
                </div>
                <div style="min-width:1000px;border-radius:2px;border:solid 1px grey; box-shadow: 1px 1px 1px grey;padding:5px;margin:10px 0px;display:flex;flex-direction: column;align-items: center;">
                    <div style="display:flex;flex-direction:row;justify-content: space-between;width:100%;">
                        <div style="margin:0px 3px;display:flex;flex-direction:column;justify-content:space-around;align-items: center;">
                            <img class="imgcol" src="<?php echo $baniere->get('urlBaniere4'); ?>">
                            <label>photo actuelle</label>
                        </div>
                        <div style="margin:0px 3px;display:flex;flex-direction:column;justify-content:space-around;align-items: center;">
                            <div id="imgstore4"></div>
                            <label id="labelNP4" style="display:none;">nouvelle photo</label>
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:row;">
                        <input type='file' name='urlBaniere4' id="getimage4" onclick="afficherLabelNP('4');">
                    </div>
                </div>
            </fieldset>
        </div>
        
        <?php include_once("boutonvalider.php"); ?>
    </form>
</main>