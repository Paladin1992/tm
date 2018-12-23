<p>
    <b>Mátyás Margaréta</b> TM&reg;-tanár vagyok, akit Maharishi Mahesh Yogi képzett ki arra,
    hogy a technikát tovább tudjam adni egy tanfolyam keretében, az alábbiak szerint:

    <ul class="tm-contact">
        <li>Bevezető és előkészítő előadás</li>
        <li>Személyes interjú</li>
        <li>Személyes tanulás</li>
        <li>1. ellenőrzési nap</li>
        <li>2. ellenőrzési nap</li>
        <li>3. ellenőrzési nap</li>
    </ul>
</p>

<p>
    A TM tanfolyam elvégzése után azt önállóan tudjuk gyakorolni,
    de a TM tanártól bármikor kérhetünk segítséget, útmutatást.
</p>

<p>
    A bevezető és előkészítő előadás <b>díjtalan</b>, melyre elérhetőségeimen jelentkezhet.
    Ezen való részvétel semmilyen kötelezettséggel nem jár.
</p>

<blockquote>
    <?php
        insert_raw_image(
            "images/portre.jpg", // src
            "portrait", // orientation
            "right", // float
            "Mátyás Margaréta fotó", // alt
            "Mátyás Margaréta", // title
            "orange-border"); // classes
    ?>

    <p>
        Első diplomámat munkavállalási tanácsadóként szereztem, témája az <i>outplacement</i> rendszer hatékonysága volt.
        Álláskeresési, pályaorientációs tanácsadóként és trénerként segítettem az embereknek eligazodni a munka világában.
    </p>

    <p class="clearfix">
        A mesterképesítést vezetés és szervezés szakon, emberierőforrás-menedzsment és szervezetfejlesztés specializációval végeztem,
        ahol a diplomám a <i>coaching</i> és az üzletviteli tanácsadás közös együttműködő munkájának eredményességéről szólt.
        Executive coachként, trénerként, képzési menedzserként sok emberrel találkoztam, és egy tartós, hathatós megoldást kerestem mindenki számára.
        Így jutottam el a Transzcendentális Meditációhoz, melynek mind saját, mind pedig mások életében való eredményességét látva a technika tanárává váltam.
        Azóta e csodálatos technika tanításával foglalkozom, mely az élet minden területét valóban sikeresebbé, gazdagabbá és boldogabbá teszi.
    </p>
</blockquote>

<div class="contact-arrow-container">
    <img src="images/nyil.png" alt="nyíl" class="contact-arrow">
</div>

<div id="contact" class="contact-container">
    <div class="card" onclick="showContact(this)" title="Kattintson a névjegykártyára!">
        <div class="bg-line"></div>

        <div class="card-name">Mátyás &nbsp;Margaréta</div>
        <div class="card-job">Transzcendentális Meditáció tanár</div>
        <div class="card-email">matyas.margareta@tm.org</div>
        <div class="card-phone">+36 70 554 3810</div>
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
            
                <div class="g-recaptcha" data-callback="checkSendButtonConditions" data-sitekey="6LeBM4QUAAAAAKRjyCW0Nl0bNUmEMoz9y3T58D2c"></div>

                <!-- <div class="captcha-container">    
                    <div class="captcha-info">Írja be számjegyekkel a képen látható művelet eredményét:</div>
                    <img class="captcha-img" src="" alt="CAPTCHA kép"/>
                    <button type="button" onclick="refreshCaptcha()" class="btn btn-primary button btn-refresh-captcha" title="Új képet kérek!">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </button>
                    
                    <input class="captcha-text" type="text" name="captcha" placeholder="Írja be az összeget" data-toggle="tooltip" data-placement="bottom" title="A mezőbe csak számot lehet beírni."/>
                    <input type="hidden" name="hash" class="captcha-hash">
                </div> -->

                <div class="gdpr-container">
                    <input type="checkbox" name="gdpr-rules" class="gdpr-real-checkbox">
                    <div class="material-icons gdpr-fake-checkbox">check_box_outline_blank</div>
                    <div class="gdpr-caption">Az <a href="other/adatvedelmi_nyilatkozat.pdf" target="_blank" class="link" title="Adatvédelmi nyilatkozat megtekintése (PDF)">adatvédelmi nyilatkozatot</a> megismertem és elfogadom.</div>
                </div>

                <div class="clearfix">
                    <button id="btn-send-email" type="submit" onclick="sendEmail()" class="btn btn-primary button left" disabled>Küldés</button>
                    <div class="mail-response alert"></div>
                </div>
            </fieldset>
        </form>
    </div>
</div>