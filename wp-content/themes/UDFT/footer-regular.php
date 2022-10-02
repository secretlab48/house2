<?php
    global $post;
?>


<footer class="footer-regular" role="contentinfo">

    <div class="footer-bg"></div>

    <div class="footer-box container">
        <div class="footer-top">
            <div class="footer-copyright">© 2019 BUNDESDEUTSCHER SENIOREN-NOTRUF e.V. Bundesverband. Alle Rechte vorbehalten. </div>
            <?php wp_nav_menu( array( 'menu' => 'footer-menu-2', 'container_class' => 'footer-menu-box', 'menu_class' => 'footer-menu' ) ); ?>
        </div>

        <?php
            if ( is_singular() && $post->ID && $post->ID == 7 ){
                echo do_shortcode( '[get_donate_buttons]' );
            }
        ?>

        <ul class="footer-socials">
            <li class="fs-li"><a class="fs-link facebook" href="#"></a></li>
            <li class="fs-li"><a class="fs-link google-plus" href="#"></a></li>
            <li class="fs-li"><a class="fs-link twitter" href="#"></a></li>
            <li class="fs-li"><a class="fs-link instagram" href="#"></a></li>
            <li class="fs-li"><a class="fs-link un1" href="#"></a></li>
            <li class="fs-li"><a class="fs-link un2" href="#"></a></li>
            <li class="fs-li"><a class="fs-link linkedin" href="#"></a></li>
        </ul>
    </div>

</footer>

<?php wp_footer(); ?>

</div> <!-- site-wrapper -->

</body>
</html>