<?php
/**
 * Template Name: Front Page Template
 * The template for display About Page
 *
 */
get_header();

?>

<main>

    <section class="s1 fp-section">
        <div class="top-bg"></div>
        <div class="quiz-form-box container">
            <?php echo do_shortcode('[contact-form-7 id="44" html_class="quiz-form current-frame-1"]' ); ?>
        </div>
    </section>


    <section class="s2 fp-section exp">
        <div class="container">
            <h1 class="main-header section-header bold">So funktioniert der Anbieter-Vergleich</h1>
            <div class="vad-row row">
                <div class="vad-item-box col-12 col-sm-6 col-md-3">
                    <div class="vad-item">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon1.png">
                        <img class="img-hover" src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon1-hover.png">
                        <div class="vad-description light">Sie sagen uns, welche Notruflösung Sie benötigen</div>
                    </div>
                </div>
                <div class="vad-item-box col-12 col-sm-6 col-md-3">
                    <div class="vad-item">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon2.png">
                        <img class="img-hover" src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon2-hover.png">
                        <div class="vad-description light">Wir durchsuchen unsere Anbieter-Datenbank</div>
                    </div>
                </div>
                <div class="vad-item-box col-12 col-sm-6 col-md-3">
                    <div class="vad-item">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon3.png">
                        <img class="img-hover" src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon3-hover.png">
                        <div class="vad-description light">Anbieter werden nach Ihren Wünschen ausgesucht</div>
                    </div>
                </div>
                <div class="vad-item-box col-12 col-sm-6 col-md-3">
                    <div class="vad-item">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon4.png">
                        <img class="img-hover" src="<?php echo get_stylesheet_directory_uri(); ?>/img/icon4-hover.png">
                        <div class="vad-description light">Sie erhalten mindestens ein passendes Angebot</div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- https://finanzcode.club/newsspy2/images/de-1.mp4 -->

    <section class="s3 fp-section">
        <div class="video-container">
            <video class="video-js vjs-default-skin vjs-big-play-centered video" id="video" data-setup='{"controls": true, "preload": "metadata", "fluid": true, "poster": "<?php echo get_stylesheet_directory_uri(); ?>/img/poster.png"}'>
                <source src="<?php echo get_stylesheet_directory_uri(); ?>/img/main1.mp4" type="video/mp4">
            </video>
        </div>
    </section>



    <section class="s4 fp-section exp">
        <div class="container">
            <h2 class="section-header bold">IHRE VORTEILE BEI DER ANBIETERSUCHE</h2>
            <div class="exp-description">Ein Hausnotruf kann Leben retten, aber welchen Anbieter sollen Sie wählen? Im Notfall zählen vor allem Zuverlässigkeit und Geschwindigkeit. Es ist aber schwierig, sich fernab von Marketing-Versprechen über die tatsächliche Qualität zu informieren. Profitieren Sie deshalb von unserem Anbieter-Vergleich und lassen Sie sich bei Ihrer Suche helfen.</div>
            <div class="exp-items">
                <div class="exp-item-content">
                    <div class="exp-item">
                        <div class="exp-content bold">schnell</div>
                        <div class="exp-tooltip"><div class="exp-tool"></div>Nach ein paar kurzen Fragen erhalten Sie schnell und einfach Ihre beste Lösung</div>
                    </div>
                    <div class="exp-divider"></div>
                </div>
                <div class="exp-item-content">
                    <div class="exp-item">
                        <div class="exp-content bold">Unverbindlich</div>
                        <div class="exp-tooltip"><div class="exp-tool"></div>Sie gehen kein Risiko ein. Wir beraten Sie als Verein unverbindlich und kostenlos. Sie schließen keinen Vertrag mit Hausnotruf.de ab.</div>
                    </div>
                    <div class="exp-divider"></div>
                </div>
                <div class="exp-item-content has-decor1">
                    <div class="exp-item">
                        <div class="exp-content bold">Große Auswahl</div>
                        <div class="exp-tooltip"><div class="exp-tool"></div>Statt bei allen Anbietern einzeln anzufragen, bekommen Sie bei uns eine Übersicht  der geprüften Anbieter, die das anbieten, was Sie suchen.</div>
                    </div>
                </div>
                <div class="exp-item-content">
                    <div class="exp-item">
                        <div class="exp-content bold">transparenz</div>
                        <div class="exp-tooltip"><div class="exp-tool"></div>Sie bekommen sofort die transparenten Informationen über die geeigneten Anbieter</div>
                    </div>
                    <div class="exp-divider"></div>
                </div>
                <div class="exp-item-content has-decor2">
                    <div class="exp-item">
                        <div class="exp-content bold">Geprüfte Qualität</div>
                        <div class="exp-tooltip"><div class="exp-tool"></div>Jeder Anbieter wird hinsichtlich Qualität geprüft und einem Zertifizierungsverfahren unterzogen.</div>
                    </div>
                    <div class="exp-divider"></div>
                </div>
                <div class="exp-item-content">
                    <div class="exp-item">
                        <div class="exp-content bold">Anbieterunabhängige Beratung</div>
                        <div class="exp-tooltip"><div class="exp-tool"></div>Hausnotruf.de ist kein Anbieter. Als neutraler Verein ermitteln wir nach Ihrem Bedarf die richtigen Lösungen und informieren Sie.</div>
                    </div>
                    <div class="exp-divider"></div>
                </div>
            </div>
        </div>
    </section>


    <section class="s5 fp-section">
        <div class="container">
            <h2 class="section-header bold">Profitieren Sie von unserem bundesweiten Partner-Netzwerk</h2>
            <div class="prefs-row row">
                <div class="prefs-left-col col-12 col-lg-6">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/gm.png">
                </div>
                <div class="prefs-right-col col-12 col-lg-6">
                    <div class="p-desription">Erfahrung, Reaktionszeit und hohe fachliche Qualität zeichnet die Anbieter aus, mit denen wir zusammenarbeiten. Bei einem Notruf geht es um Leben und Tod, deshalb sollten Sie bei der Suche nach dem richtigen Hausnotruf keine Abstriche machen. Hilfe direkt aus Ihrer Region Deutschlandweit einzigartiges Anbieternetz Kostenlos & unverbindlich persönliche Angebote erhalten</div>
                    <ul class="p-items">
                        <li><span class="bold">Hilfe direkt aus Ihrer Region</span></li>
                        <li><span class="bold">Deutschlandweit einzigartiges Anbieternetz</span></li>
                        <li><span class="bold">Kostenlos & unverbindlich persönliche Angebote erhalten</span></li>
                    </ul>
                    <a class="btn green-btn bold smooth-btn" href="#top-bg">Jetzt anbieter vergleichen</a>
                </div>
            </div>
        </div>
    </section>



    <section class="s6 fp-section">
        <div class="container">
            <h2 class="section-header bold">Kundenstimmen</h2>
            <?php echo get_customer_references(); ?>
        </div>
    </section>


    <section class="s7 fp-section">
        <div class="container">
            <h2 class="section-header bold">FAQ</h2>
            <p class="nested-p">
                <span>Wie funktioniert ein Hausnotruf?</span>
                Ihren Hausnotruf können Sie jederzeit – also rund um die Uhr – per Knopfdruck mit Ihrem Hausnotruf-Gerät absetzen.
                Das Hausnotruf-Gerät stellt automatisch eine Verbindung zu unserer Hausnotruf Servicezentrale her. Unser medizinisch geschultes
                Personal klärt Ihre Bedarfssituation über eine direkte Sprechverbindung über das Hausnotruf-Gerät ab und schickt sofort geeignete
                Hilfe zu Ihnen. Auch wenn über die Sprechverbindung des Hausnotruf-Gerätes keine Antwort erhalten wird, werden die Maßnahmen
                eingeleitet. Der Hausnotruf ist also auch dann sicher.
            </p>
            <p class="nested-p">
                <span class="bold">Brauche ich unbedingt einen Telefonanschluss für mein Hausnotruf-Gerät?</span>
                Nein, es gibt auch Hausnotruf-Geräte die mit einer eingebauten Mobilfunkkarte den Hausnotruf absetzen können!
            </p>
            <p class="nested-p">
                <span class="bold">Was passiert, wenn ich versehentlich den Alarm vom Hausnotruf-Gerät betätige?</span>
                Wie bei einem normalen Alarm auch wird unsere Hausnotruf-Leitstelle mit Ihnen Kontakt aufzunehmen. Geben Sie einfach Bescheid,
                dass Sie keine Hilfe benötigen, wir freuen uns auch von Ihnen zu hören, wenn es Ihnen gut geht!
            </p>
            <p class="nested-p">
                <span class="bold">Kann bei Stromausfall ein Alarm vom Hausnotruf-Gerät ausgelöst werden?</span>
                Ja, sofern Ihr Telefonanschluss funktioniert; alle Hausnotruf-Geräte haben eine Notstrombatterie, die das Hausnotruf-Gerät für bis
                zu 3 Tage versorgen kann. Bei modernen Telefonanschlüssen wird oft ein sogenannter Router benutzt; in diesem Fall funktioniert
                eine Alarmübertragung bei angeschlossenen Hausnotruf-Geräten nur solange der Router mit Strom versorgt wird, beispielsweise
                bei der Installation einer sogenannten unterbrechungsfreie Stromversorgung. Alternativ kann bei Ihnen auch ein Hausnotruf-Gerät
                mit eingebauter Mobilfunkkarte installiert werden. Bei einem solchen Hausnotruf-Gerät funktioniert die Alarmübertragung unabhängig
                vom Telefonanschluss.
            </p>
            <p class="nested-p">
                <span class="bold">Was passiert, wenn plötzlich der Telefonanschluss nicht mehr funktioniert?</span>
                Die Hausnotruf-Geräte senden immer regelmäßig einen sogenannten Testalarm an unserer Hausnotruf - Servicezentrale. Bleibt ein
                solcher Testalarm aus, beispielsweise weil versehentlich der Telefonstecker aus der Telefondose gezogen worden ist, gibt es in der
                Hausnotruf - Servicezentrale einen entsprechenden Alarm und wir überprüfen die Ursache der fehlenden Verbindung zu Ihrem
                Hausnotruf-Gerät. Solange das Hausnotruf-Gerät nicht mit einem funktionierenden Telefonnetz verbunden ist, können Sie keinen
                Alarm abzusetzen. Bei einem Hausnotruf-Gerät mit eingebauter Mobilfunkkarte kann das nicht passieren: Solange das Mobilfunknetz
                funktioniert, haben diese Hausnotruf-Geräte immer eine funktionierende Telefonverbindung und können daher durchgehend Alarme
                senden. Fragen Sie uns bei der Auswahl Ihres Hausnotruf-Gerätes- Wir beraten Sie gern.
            </p>
            <a class="btn centered green-btn bold" href="/faq">MEHR INFORMATIONEN</a>
        </div>
    </section>



    <section class="s8 fp-section">
        <div class="container">
            <h2 class="section-header bold">überzeugen Sie sich selbst!</h2>
            <p>Reden kann jeder, deshalb lassen wir bei hausnotruf.de uns gerne an unseren Ergebnissen und Ihren Erfahrungen messen. Stellen Sie ganz einfach eine Anfrage und testen Sie unseren Vergleichs-Service - kostenlos und völlig unverbindlich. </p>
            <a class="btn green-btn bold smooth-btn" href="#top-bg">Jetzt anbieter vergleichen</a>
        </div>
    </section>

</main>


<?php
    get_footer('main' );
?>