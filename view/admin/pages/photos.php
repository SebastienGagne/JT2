<input type="hidden" name="urlPhoto1_T" value="<?php echo $page->get('urlPhoto1'); ?>">
<input type="hidden" name="urlPhoto2_T" value="<?php echo $page->get('urlPhoto2'); ?>">
<input type="hidden" name="urlPhoto3_T" value="<?php echo $page->get('urlPhoto3'); ?>">
<input type="hidden" name="urlPhoto4_T" value="<?php echo $page->get('urlPhoto4'); ?>">
<input type="hidden" name="urlPhoto5_T" value="<?php echo $page->get('urlPhoto5'); ?>">
<input type="hidden" name="urlPhoto6_T" value="<?php echo $page->get('urlPhoto6'); ?>">

<div class="div1_photos_C">
    <fieldset class="fieldset1_photos_C">
        <legend><?php echo $texte1; ?></legend>
        <div class="div2_photos_C">
            <div class="div3_photos_C">
                <div class="div4_photos_C">
                    <img class="imgcol" src="<?php echo $page->get('urlPhoto1'); ?>">
                    <label>photo actuelle</label>
                </div>
                <div class="div4_photos_C">
                    <div id="imgstore1"></div>
                    <label id="labelNP1" class="label_nouvelle_photo">nouvelle photo</label>
                </div>
            </div>
            <div class="div_label_photos_C">
                <input type='file' name='urlPhoto1' id="getimage1" onclick="afficherLabelNP('1');">
            </div>
        </div>
        <div class="div2_photos_C">
            <div class="div3_photos_C">
                <div class="div4_photos_C">
                    <img class="imgcol" src="<?php echo $page->get('urlPhoto2'); ?>">
                    <label>photo actuelle</label>
                </div>
                <div class="div4_photos_C">
                    <div id="imgstore2"></div>
                    <label id="labelNP2" class="label_nouvelle_photo">nouvelle photo</label>
                </div>
            </div>
            <div class="div_label_photos_C">
                <input type='file' name='urlPhoto2' id="getimage2" onclick="afficherLabelNP('2');">
            </div>
        </div>
        <div class="div2_photos_C">
            <div class="div3_photos_C">
                <div class="div4_photos_C">
                    <img class="imgcol" src="<?php echo $page->get('urlPhoto3'); ?>">
                    <label>photo actuelle</label>
                </div>
                <div class="div4_photos_C">
                    <div id="imgstore3"></div>
                    <label id="labelNP3" class="label_nouvelle_photo">nouvelle photo</label>
                </div>
            </div>
            <div class="div_label_photos_C">
                <input type='file' name='urlPhoto3' id="getimage3" onclick="afficherLabelNP('3');">
            </div>
        </div>
    </fieldset>
    <fieldset class="fieldset1_photos_C">
        <legend><?php echo $texte2; ?></legend>
        <div class="div2_photos_C">
            <div class="div3_photos_C">
                <div class="div4_photos_C">
                    <img class="imgcol" src="<?php echo $page->get('urlPhoto4'); ?>">
                    <label>photo actuelle</label>
                </div>
                <div class="div4_photos_C">
                    <div id="imgstore4"></div>
                    <label id="labelNP4" class="label_nouvelle_photo">nouvelle photo</label>
                </div>
            </div>
            <div class="div_label_photos_C">
                <input type='file' name='urlPhoto4' id="getimage4" onclick="afficherLabelNP('4');">
            </div>
        </div>
        <div class="div2_photos_C">
            <div class="div3_photos_C">
                <div class="div4_photos_C">
                    <img class="imgcol" src="<?php echo $page->get('urlPhoto5'); ?>">
                    <label>photo actuelle</label>
                </div>
                <div class="div4_photos_C">
                    <div id="imgstore5"></div>
                    <label id="labelNP5" class="label_nouvelle_photo">nouvelle photo</label>
                </div>
            </div>
            <div class="div_label_photos_C">
                <input type='file' name='urlPhoto5' id="getimage5" onclick="afficherLabelNP('5');">
            </div>
        </div>
        <div class="div2_photos_C">
            <div class="div3_photos_C">
                <div class="div4_photos_C">
                    <img class="imgcol" src="<?php echo $page->get('urlPhoto6'); ?>">
                    <label>photo actuelle</label>
                </div>
                <div class="div4_photos_C">
                    <div id="imgstore6"></div>
                    <label id="labelNP6" class="label_nouvelle_photo">nouvelle photo</label>
                </div>
            </div>
            <div class="div_label_photos_C">
                <input type='file' name='urlPhoto6' id="getimage6" onclick="afficherLabelNP('6');">
            </div>
        </div>
    </fieldset>
</div>