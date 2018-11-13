<?php include("captcha.php"); ?>

<?php
    insert_figure(
        "images/margareta_tv_portrait.jpg", // src
        "portrait", // orientation
        "right", // float
        "Mátyás Margaréta fotó", // alt
        "Mátyás Margaréta", // title
        "") // figcaption
?>

<p>
<b>Mátyás Margaréta</b> Transzcendentális Meditáció tanár vagyok, akit Maharishi Mahesh Yogi képzett ki.
Ez teszi lehetővé, hogy a több mint 6000 éves hagyományt tisztán tovább tudjam adni.
</p>

<p>
Első diplomámat munkavállalási tanácsadóként szereztem, témája az <i>outplacement</i> rendszer hatékonysága volt.
Álláskeresési, pályaorientációs tanácsadóként és trénerként segítettem az embereknek eligazodni a munka világában.
</p>

<p class="clearfix">
A mesterképesítést vezetés és szervezés szakon, emberierőforrás-menedzsment és szervezetfejlesztés specializációval végeztem,
ahol a diplomám a <i>coaching</i> és az üzletviteli tanácsadás közös együttműködő munkájának eredményességéről szólt.
Executive coachként, trénerként, képzési menedszerként sok emberrel találkozva egy tartós és hathatós megoldást kerestem mindenki számára.
Így jutottam el a Transzcendentális Meditációhoz, melynek mind saját, mind pedig mások életében való eredményességét látva a technika tanárává váltam. Azóta e csodálatos technika tanításával foglalkozom, mely az élet minden területét valóban sikeresebbé, gazdagabbá és boldogabbá teszi.
</p>

<div id="contact" class="contact-container">
    <div class="card" onclick="showContact(this)">
        <div class="bg-line"></div>

        <div class="card-name">Mátyás &nbsp;Margaréta</div>
        <div class="card-job">Transzcendentális Meditáció tanár</div>
        <div class="card-email">
            <!-- <i class="material-icons">mail_outline</i> -->
            matyas.margareta@tm.org
        </div>
        <div class="card-phone">
            <!-- <i class="material-icons">phone</i> -->
            +36 70 554 3810
        </div>
        <div class="card-good-wish">Csodaszép napot!</div>
    </div>

    <div class="form-container">
        <form action="" method="POST" name="form-email">
            <fieldset>
                <div>
                    <input type="text" name="fullName" placeholder="Teljes név">
                </div>
                <div>
                    <input type="email" name="email" placeholder="Az Ön e-mail címe">
                </div>
                <div>
                    <textarea name="message" placeholder="Ide írhatja az üzenetet"></textarea>
                </div>
            
                <div class="captcha-container">
                    <img class="captcha-img" src="<?=captcha::image();?>" onclick="refreshCaptcha(this)" title="Új képhez kattints ide"/>
                    <span style="font-size:12px;">Írd be a képen látható karaktereket:</span>
                    <div class="captcha-info">(A képre kattintva újat kérhetsz.)</div>
                    <div id="captcha-code"><?=captcha::get_code();?></div>
                    <input class="captcha-text" type="text" name="code" placeholder="6 karakter" maxlength="6" onkeyup="gombAktivizal()"/>
                </div>

                <div class="clearfix">
                    <button id="btn-send-email" type="submit" onclick="sendEmail()" class="button-link left" disabled>Küldés</button>
                    <div class="mail-response alert"></div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<p style="text-align: center">
    <a href="other/adatvedelmi_nyilatkozat.pdf" target="_blank" class="link">Adatvédelmi nyilatkozat megtekintése (PDF)</a>
</p>