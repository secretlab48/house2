
			<footer class="footer-main" role="contentinfo">

                <!--<div class="footer-bg"></div>-->

                <div class="footer-box container">
                    <?php wp_nav_menu( array( 'menu' => 'footer-menu', 'container_class' => 'footer-menu-box', 'menu_class' => 'footer-menu' ) ); ?>
                    <!--<div class="footer-buttons">
                        <a class="btn footer-button bold" href="#">Wie kann ich Partner werden?</a>
                        <a class="btn footer-button bold" href="#">Jetzt Spenden</a>
                    </div>-->
                    <?php
                        echo do_shortcode( '[get_donate_buttons]' );
                    ?>
                    <div class="footer-copyright">© 2019 BUNDESDEUTSCHER SENIOREN-NOTRUF e.V. Bundesverband. Alle Rechte vorbehalten. </div>
                    <ul class="footer-socials">
                        <li class="fs-li"><a class="fs-link facebook" href="#"></a></li>
                        <li class="fs-li"><a class="fs-link youtube" href="#"></a></li>
                        <li class="fs-li"><a class="fs-link xing" href="#"></a></li>
                        <li class="fs-li"><a class="fs-link linkedin" href="#"></a></li>
                    </ul>
                </div>

			</footer>

            <?php wp_footer(); ?>

		</div> <!-- site-wrapper -->

	</body>
</html>
