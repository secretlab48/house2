<?php

$top_bg_style = ' style="background-image:url(' . get_stylesheet_directory_uri() . '/img/slide1-regular.jpg);"';
get_header();

?>

<main>

    <section class="top-section">
        <div class="top-bg"<?php echo $top_bg_style; ?>></div>
        <div class="top-header">
            <h1 class="bold">404</h1>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <p class="404-top">Die Seite kann leider nicht angezeigt werden, weil;</p>
            <p class="404-middle">Sie eine falsche Adresse aufgerufen haben.<br>Die angefragte Quelle wurde nicht gefunden!</p>
            <p class="404-bottom">Bitte eine der folgenden Seiten ausprobieren: <a class="light-green-link" href="<?php echo site_url(); ?>">Startseite</a></p>
        </div>
    </section>



</main>


<?php
get_footer( 'main' );
?>
