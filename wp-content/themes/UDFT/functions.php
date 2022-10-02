<?php
/*
 *  Author: CA
 *  Custom functions, support, custom post types and more.
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/*------------------------------------*\
	Functions
\*------------------------------------*/


add_action( 'init', 'udft::init' );

class UDFT
{

    static function init()
    {

        if (function_exists('add_theme_support')) {

            add_theme_support('menus');
            add_theme_support('widgets');

            add_theme_support('post-thumbnails');
            add_image_size('large', 700, 420, true);

            load_theme_textdomain('tpl', get_template_directory() . '/languages');
        }


        add_post_type_support( 'page', 'excerpt' );
        add_post_type_support( 'post', 'excerpt' );

        add_filter('widget_text', 'do_shortcode');

        wp_enqueue_style('grid_css', get_template_directory_uri() . '/css/grid.css');
        //wp_enqueue_style('animate_css', get_template_directory_uri() . '/css/animate.css');
        //wp_enqueue_style('grid_css', get_template_directory_uri() . '/css/select2.css');
        wp_enqueue_style('custom_css', get_template_directory_uri() . '/css/custom.css');
        wp_enqueue_style('fontawesome_css', get_template_directory_uri() . '/css/font-awesome.css');
        wp_enqueue_style('video_css', get_template_directory_uri() . '/css/video-js.css');
        wp_enqueue_style('slick_css', get_template_directory_uri() . '/inc/slick/slick.css');
        wp_enqueue_style('slick__theme_css', get_template_directory_uri() . '/inc/slick/slick-theme.css');

        wp_register_script('video_js', get_template_directory_uri() . '/js/video.js', array('jquery'), false, true);
        wp_enqueue_script('video_js');
        //wp_register_script('select2_js', get_template_directory_uri() . '/js/select2.full.js', array('jquery'), false, true);
        //wp_enqueue_script('select2_js');
        wp_register_script('slick_js', get_template_directory_uri() . '/inc/slick/slick.js', array('jquery'), false, true);
        wp_enqueue_script('slick_js');
        wp_register_script('custom_js', get_template_directory_uri() . '/js/custom.js', array('jquery'), false, true);
        wp_enqueue_script('custom_js');



        register_nav_menus(array(
            'header-location' => 'Top Memu',
            'footer-location' => 'Footer Menu',
            'footer-location2' => 'Second Footer Menu'
        ));

        add_filter('body_class', 'udft::custom_class_names');

        add_action('wp_enqueue_scripts', array('UDFT', 'add_ajax_data'), 99);

        add_action( 'wp_ajax_get_form_data', array( 'UDFT', 'get_form_data' ) );
        add_action( 'wp_ajax_nopriv_get_form_data', array( 'UDFT', 'get_form_data' ) );

        add_shortcode( 'get_donate_buttons', array( 'UDFT', 'get_donate_buttons' ) );

        //self::custom_get_styles();
        //wp_enqueue_style('grid_css', get_template_directory_uri() . '/css/prod.css');

        //add_action('after_setup_theme','UDFT::footer_enqueue_scripts');

        //self::custom_get_scripts();

        //wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
        //wp_enqueue_script( 'jquery' );

        //wp_register_script('prod_js', get_template_directory_uri() . '/js/prod.js', array(), false, true);
        //wp_enqueue_script('prod_js');


    }



    static function footer_enqueue_scripts(){
        remove_action('wp_head','wp_print_scripts');
        remove_action('wp_head','wp_print_head_scripts',9);
        remove_action('wp_head','wp_enqueue_scripts',1);
        add_action('wp_footer','wp_print_scripts',5);
        add_action('wp_footer','wp_enqueue_scripts',5);
        add_action('wp_footer','wp_print_head_scripts',5);
    }


    static function custom_get_scripts() {

        $wp_include_dir =  preg_replace('/wp-content$/', 'wp-includes', WP_CONTENT_DIR );
        $wp_plugins_dir = WP_CONTENT_DIR . '/plugins';

        //file_get_contents( $wp_include_dir . '/jquery/jquery.js' ) .

        $out =
            file_get_contents( get_template_directory() . '/js/video.js' ) .
            file_get_contents( get_template_directory() . '/inc/slick/slick.js' ) .
            file_get_contents( get_template_directory() . '/js/custom.js' );


        file_put_contents( get_stylesheet_directory() . '/js/prod.js', $out );

    }


    static function custom_get_styles() {

        $out = file_get_contents( get_template_directory() . '/css/grid.css' ) .
            file_get_contents( get_template_directory() . '/css/custom.css' ) .
            file_get_contents( get_template_directory() . '/css/font-awesome.css' ) .
            file_get_contents( get_template_directory() . '/inc/slick/slick.css' ) .
            file_get_contents( get_template_directory() . '/inc/slick/slick-theme.css' ) .
            file_get_contents( get_template_directory() . '/css/video-js.css' );

        $out = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out );
        $out = str_replace(': ', ':', $out );
        $out = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $out );

        file_put_contents( get_stylesheet_directory() . '/css/prod.css', $out );

        //echo '<style>' . $out . '</style>';

    }


    static function add_ajax_data()
    {

        //wp_deregister_script( 'jquery' );
        //wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
        //wp_enqueue_script( 'jquery' );

        wp_localize_script('jquery', 'ajaxdata',
            array(
                'url' => admin_url('admin-ajax.php'),
            )
        );
    }


    static function custom_class_names($classes)
    {

        global $post;

        if (is_page()) {
            $classes[] = 'customized-page';
            if ($post && is_int($post->ID)) {
                $classes[] = 'page-' . strtolower(preg_replace(array('/\s/', '/,|\.|\"|\'/'), array(
                        '-',
                        ''
                    ), custom_sanitize_title($post->post_title)));
            }
        }

        if ($post && $post->post_type && $post->post_type == 'post') {
            $classes[] = 'customized-post';
        }

        return $classes;

    }

    static function get_template_part($template, $part_name = null, $mode = 'return')
    {

        if ($mode == 'return') {
            ob_start();
            get_template_part($template, $part_name);
            $out = ob_get_contents();
            ob_end_clean();

            return $out;
        } else {
            get_template_part($template);
        }

    }



    static function get_form_data() {



        $headers = array(
            'From: Contact Form <wordpress@' . $_SERVER['HTTP_HOST'] . '>',
        );

        //$prefix = isset( $_POST['prefix'] ) ? $_POST['prefix'] : '049';
        //var_dump($_POST);
        $data = array();

        $data['quiz-form'] =
            array(
                'post-code' => array( 'idx' => 'Postcode', 'val' => isset( $_POST['post-code'] ) ? $_POST['post-code'] : '' ),
                'city' => array( 'idx' => 'Wohnort', 'val' => isset( $_POST['city'] ) ? $_POST['city'] : '' ),
                'in-home' => array( 'idx' => 'Hause Nutzen', 'val' => isset( $_POST['in-home'] ) ? $_POST['city'] : '' ),
                'user' => array( 'idx' => 'Soll Nutzen', 'val' => isset( $_POST['user'] ) ? $_POST['user'] : '' ),
                'service' => array( 'idx' => 'Service Helfen', 'val' => isset( $_POST['service'] ) ? $_POST['service'] : '' ),
                'medical' => array( 'idx' => 'Pflegegrad', 'val' => isset( $_POST['medical'] ) ? $_POST['medical'] : '' ),
                'gender' => array( 'idx' => 'Gender', 'val' => isset( $_POST['gender'] ) ? $_POST['gender'] : '' ),
                'vorname' => array( 'idx' => 'Vorname', 'val' => isset( $_POST['vorname'] ) ? $_POST['vorname'] : '' ),
                's-name' => array( 'idx' => 'Second Name', 'val' => isset( $_POST['s-name'] ) ? $_POST['s-name'] : '' ),
                'email' => array( 'idx' => 'E-mail', 'val' => isset( $_POST['email'] ) ? $_POST['email'] : '' ),
                'phone' => array( 'idx' => 'Telefon', 'val' => isset( $_POST['phone'] ) ? $_POST['phone'] : '' ),
            );
        $data['popup-form'] =
            array(
                'name' => array( 'idx' => 'Name', 'val' => isset( $_POST['name'] ) ? $_POST['name'] : '' ),
                'phone' => array( 'idx' => 'Telefon', 'val' => isset ( $_POST['phone'] ) ? $_POST['phone'] : '' ),
                'email' => array( 'idx' => 'Email', 'val' => isset( $_POST['email'] ) ? $_POST['email'] : '' ),
                'comment' => array( 'idx' => 'Kommentarfeld', 'val' => isset( $_POST['comment'] ) ? $_POST['comment'] : '' ),
            );
        $data['main-form'] =
            array(
                'name' => array( 'idx' => 'Name', 'val' => isset( $_POST['name'] ) ? $_POST['name'] : '' ),
                'email' => array( 'idx' => 'Email', 'val' => isset( $_POST['email'] ) ? $_POST['email'] : '' ),
                'phone' => array( 'idx' => 'Telefon', 'val' => isset( $_POST['phone'] ) ? $_POST['phone'] : '' ),
                'type' => array( 'idx' => 'Type', 'val' => isset( $_POST['type'] ) ? $_POST['type'] : 'none' ),
                'function' => array( 'idx' => 'Funktion', 'val' => isset( $_POST['function'] ) ? $_POST['function'] : '' ),
                'www' => array( 'idx' => 'Site', 'val' => isset( $_POST['www'] ) ? $_POST['www'] : '' ),
                'plz' => array( 'idx' => 'PLZ', 'val' => isset( $_POST['plz'] ) ? $_POST['plz'] : '' ),
                'ort' => array( 'idx' => 'ORT', 'val' => isset( $_POST['ort'] ) ? $_POST['ort'] : '' ),
                'strasse' => array( 'idx' => 'Strasse', 'val' => isset( $_POST['strasse'] ) ? $_POST['strasse'] : '' ),
                'housnummer' => array( 'idx' => 'Housenummer', 'val' => isset( $_POST['housnummer'] ) ? $_POST['housnummer'] : '' ),
                'comment' => array( 'idx' => 'Kommentarfeld', 'val' => isset( $_POST['comment'] ) ? $_POST['comment'] : '' ),
                'sonstiges' => array( 'idx' => 'Sonstiges', 'val' => isset( $_POST['sonstiges'] ) ? $_POST['sonstiges'] : '' )
            );

        if ( $data[ $_POST['form-type'] ] ) {
            $message =
                '<div class="mail-box">';
            foreach ($data[$_POST['form-type']] as $index => $set) {
                if (isset($_POST[$index])) {
                    $message .=
                        '<div class="' . $set['idx'] . '">' . $set['val'] . '</div>';
                }
            }

            $message .=
                '</div>';
        }

        $result = wp_mail( array( 'smarty.t62a.1@gmail.com' ), $_SERVER['HTTP_HOST'] . ' - Contact Form Message', $message, $headers );

        if ( $result == 1 )
            $result = array( 'result' => 1, 'title' => 'Anfrage akzeptiert', 'message' => '<strong style="display:block; text-aling:center; font-size:20px; text-transform:uppercase;">Vielen Dank für die Bewerbung!</strong><br>Ihre Anfrage wurde gesendet, unsere Spezialisten werden sich innerhalb von 3 Stunden bei Ihnen melden' );
        else
            $result = array( 'result' => 0, 'title' => 'ein Fehler', 'message' => 'Beim Senden einer Anfrage ist ein Absturz aufgetreten. Versuchen Sie es in einer Minute erneut' );

        echo json_encode( $result );
        wp_die();

    }


    static function get_donate_buttons() {

        $out =
            '<div class="spr-buttons">
                 <!--<a class="paypal-btn spend-btn bold" href="#">spenden</a>-->
                <form class="spend-btn paypal-btn" target="_blank" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_donations" />
                    <input type="hidden" name="business" value="secretlab48@gmail.com" />
                    <input type="hidden" name="currency_code" value="USD" />
                    <!--<input type="image" src="https://housenotruf.hosting1.tn-rechenzentrum1.de/wp-content/themes/UDFT/img/paypal.jpg" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />-->
                    <button class="paypal-btn-button bold" type="submit">spenden</button>
                    <img alt="" border="0" src="https://www.paypal.com/en_RU/i/scr/pixel.gif" width="1" height="1" />
                </form>
                 <a class="card-btn spend-btn bold" href="#">spenden</a>
            </div>';

        return $out;

    }


}


/* CUSTOM */

add_action( 'wp_footer', 'get_modals' );

function get_modals () {

    global $post;

    $out =
        '<div class="modal-box">
            <div class="modal-content-box">
                <div class="modal-content">
                    <div class="form-messages">
                        <div class="modal-close"></div>
                        <div class="fm-content">
                            <div class="fm-icon"></div>
                            <div class="fm-title"></div>
                            <div class="fm-text"></div>
                            <a class="fm-btn">ok</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

    /*if ( !isset( $_COOKIE['approved-cookie'] ) || ( isset ( $_COOKIE['approved-cookie'] ) && !$_COOKIE['approved-cookie'] ) ) {
        $out .=
            '<div class="cookie-notice">
             <div class="cn-close fa fa-times"></div>
             <div class="cn-content">Cookies helfen uns bei der Bereitstellung unserer Dienste. Durch die Nutzung unserer Dienste erklären Sie sich damit einverstanden, dass wir Cookies setzen. <a class="cookie-link" href="/datenschutz">Hier</a> finden Sie weitere Informationen zu Cookies und wie Sie diese ablehnen.</div>
             <a class="cn-btn">Ich stimme zu</a>
         </div>';
    }*/


    /*$out .=
        '<div class="popup-box">
             <div class="popup-button"></div>
             <form class="popup-form" data-form-type="popup-form">
                 <div class="pf-close"></div>
                 <div class="pf-title bold">Sie haben Fragen zum Hausnotruf oder wünschen persönliche Beratung.<span>Unser Verein hilft Ihnen gern:</span></div>
                 <div class="pf-input-box">
                     <div class="pf-input-title">Name</div>
                     <input class="pf-input" name="name">
                 </div> 
                 <div class="pf-input-box">
                     <div class="pf-input-title">Telefon Nummer</div>
                     <input class="pf-input" name="phone">
                 </div> 
                 <div class="pf-input-box">
                     <div class="pf-input-title">E-mail Adresse</div>
                     <input class="pf-input" name="email">
                 </div> 
                 <div class="pf-input-box">
                     <div class="pf-input-title">Ihre Nachricht</div>
                     <textarea class="pf-comment" name="comment"></textarea>
                 </div>
                 <a class="pf-daten" href="#">Datenschutzbestätigung</a> 
                 <button class="pf-submit green-btn" type="submit">absenden</button>
             </form>
         <div>';*/

    if ( is_front_page() ) {
        $out .=
            '<div class="popup-box">
             <div class="popup-button"></div>' .
            do_shortcode('[contact-form-7 id="43" html_class="popup-form"]') .
            '</div>';
    }

    if ( $post && $post->ID == 10 ) {
        $out .= '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBozjQOaVVSQC7LVV6y52na6-zXWf1bmOU" async defer></script>';
    }

    echo $out;

}





//add_action('phpmailer_init','send_smtp_email');
function send_smtp_email( $phpmailer )
{
    $phpmailer->SMTPDebug = 0;
    $phpmailer->isSMTP();
    $phpmailer->Host = "smtp.gmail.com";
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = "465";
    $phpmailer->Username = "zhekas361@gmail.com";
    $phpmailer->Password = "ab124578";
    $phpmailer->SMTPSecure = "ssl";
    $phpmailer->CharSet = 'UTF-8';

    /*$phpmailer->SMTPDebug = 0;
    $phpmailer->isSMTP();
    $phpmailer->Host = "smtp-pulse.com";
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = "465";
    $phpmailer->Username = "secretlab48@gmail.com";
    $phpmailer->Password = "qQrpg2H75J8He";
    $phpmailer->SMTPSecure = "ssl";
    $phpmailer->CharSet = 'UTF-8';*/

    $phpmailer->isHTML( true );

    $phpmailer->smtpConnect(
        array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        )
    );


    $phpmailer->setFrom( 'anfrage@hausnotruf.de', 'Service', true );
    $phpmailer->addReplyTo( 'anfrage@hausnotruf.de', 'Information1' );
    $phpmailer->Sender = 'anfrage@hausnotruf.de';

    //$phpmailer->Subject = 'New Lead1';


}


function admin_trainer_set_content_type(){
    return "text/html";
}
//add_filter( 'wp_mail_content_type','admin_trainer_set_content_type' );





add_shortcode( 'get_main_form', 'get_main_form' );

function get_main_form() {

    $out =
        '<div class="main-form-box">' .
            do_shortcode( '[contact-form-7 id="45" html_class="main-form"]' ) .
            '<!--<form class="main-form" action="" method="POST" data-form-type="main-form">
                 <div class="input-block">
                     <div class="input-box">
                         <div class="input-title">name</div>
                         <input class="inpt" name="name">
                     </div>
                     <div class="input-box">
                         <div class="input-title">e-mail</div>
                         <input class="inpt" name="email">
                     </div>
                 </div>
                 <div class="input-block">
                     <div class="radios-box">
                         <div class="radio-box">
                             <input type="radio" name="type">
                             <div class="radio-title">firma</div>
                         </div>
                         <div class="radio-box">
                             <input type="radio" name="type">
                             <div class="radio-title">verein</div>
                         </div>
                     </div>
                     <div class="input-box">
                         <div class="input-title">telefon</div>
                         <input class="inpt" name="phone">
                     </div>
                 </div>
                 <div class="input-block">
                     <div class="input-box">
                         <div class="input-title">function</div>
                         <input class="inpt" name="function">
                     </div>
                     <div class="input-box">
                         <div class="input-title lowercase">www</div>
                         <input class="inpt" name="www">
                     </div>
                 </div>
                 <div class="input-block">
                     <div class="input-box">
                         <div class="nested-inputs left">
                             <div class="input-box plz">
                                 <div class="input-title uppercase">plz</div>
                                 <input class="inpt" name="plz">
                             </div>
                             <div class="input-box ort">
                                 <div class="input-title">ort</div>
                                 <input class="inpt" name="ort">
                             </div>
                         </div>
                         <div class="nested-inputs right">
                             <div class="input-box strasse">
                                 <div class="input-title">strasse</div>
                                 <input class="inpt" name="strasse">
                             </div>
                             <div class="input-box hausenummer">
                                 <div class="input-title">hausnummer</div>
                                 <input class="inpt" name="housnummer">
                             </div>
                         </div>
                     </div>
                     <div class="input-box">
                         <div class="input-title">Kommentarfeld</div>
                         <textarea name="comment"></textarea>
                     </div>
                 </div>
                 <div class="input-title orphant bold">Ich bin Anbieter von:</div>
                 <div class="radios-box full-width">
                     <div class="radio-box">
                         <input type="radio" name="proffession">
                         <div class="radio-title"> Geräten und Technik</div>
                     </div>
                     <div class="radio-box">
                         <input type="radio" name="proffession">
                         <div class="radio-title">Pflege und Service</div>
                     </div>
                     <div class="radio-box">
                         <input type="radio" name="proffession">
                         <div class="radio-title">Hausnotruf</div>
                     </div>
                     <div class="radio-box">
                         <input type="radio" name="proffession">
                         <div class="radio-title">Rettungsdienst</div>
                     </div>
                 </div>
                 <div class="input-box full-width">
                     <div class="input-title">Sonstiges</div>
                     <input class="inpt" name="sonstiges">
                 </div>
                 <a class="daten-redirect" href="#">datenschutzbestätigung</a>
                 <button class="form-btn bold" type="submit">Absenden</button>
            </form>-->
        </div>';

    return $out;

}



add_shortcode(  'get_customer_references', 'get_customer_references' );

function get_customer_references() {

    $out =
            '<div class="tsts-box">
                <div class="tst-box">
                    <div class="tst-content">
                        <div class="stars-box">
                            <div class="single-star"></div>
                        </div>
                        <div class="tst-description">Es war ganz einfach und ich fühle mich mit meinem Hausnotruf daheim wieder sicher.</div>
                        <div class="tst-name bold">Ilse M.,</div>
                        <div class="tst-city">Saarbrücken</div>
                    </div>
                </div>

                <div class="tst-box">
                    <div class="tst-content">
                        <div class="stars-box">
                            <div class="single-star"></div>
                        </div>
                        <div class="tst-description">Ich wusste nicht dass Notrufgeräte auch unterwegs funktionieren. Jetzt fühle ich mich überall beschützt und gehe gern wieder raus.</div>
                        <div class="tst-name bold">Franziska W.,</div>
                        <div class="tst-city">Bad Hersfeld</div>
                    </div>
                </div>

                <div class="tst-box">
                    <div class="tst-content">
                        <div class="stars-box">
                            <div class="single-star"></div>
                        </div>
                        <div class="tst-description">Die Mitglieder von Hausnotruf.de haben mich ausführlich und geduldig beraten bis wir die richtige Lösung für mich gefunden haben. Herzlichen Dank.</div>
                        <div class="tst-name bold">Elise P.,</div>
                        <div class="tst-city">Leipzig</div>
                    </div>
                </div>

                <div class="tst-box">
                    <div class="tst-content">
                        <div class="stars-box">
                            <div class="single-star"></div>
                        </div>
                        <div class="tst-description">Meine Mutter kommt gut mit dem Gerät zurecht. Und wenn sie mal aus Versehen drückt ist immer jemand für sie da. Das ist ein gutes Gefühl.</div>
                        <div class="tst-name bold">Petra S.,</div>
                        <div class="tst-city">Augsburg</div>
                    </div>
                </div>

                <div class="tst-box">
                    <div class="tst-content">
                        <div class="stars-box">
                            <div class="single-star"></div>
                        </div>
                        <div class="tst-description">Wir wurden gut beraten und haben jetzt ein tolles Gerät zum günstigen Preis. Die Leute sind sehr nett und es ging ganz einfach</div>
                        <div class="tst-name bold">Hildegard B.,</div>
                        <div class="tst-city">Berlin</div>
                    </div>
                </div>
                
                <div class="tst-box">
                    <div class="tst-content">
                        <div class="stars-box">
                            <div class="single-star"></div>
                        </div>
                        <div class="tst-description">Mein Mann und ich haben jetzt jeder einen Notrufknopf aber wir brauchen nur ein Gerät. Herzlichen Dank für die gute Beratung.</div>
                        <div class="tst-name bold">Waltraud und Günther R.,</div>
                        <div class="tst-city">Hannover</div>
                    </div>
                </div>                

            </div>';

    return $out;


}






function custom_sanitize_title($title) {
    global $wpdb;

    $iso9_table = array(
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G',
        'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
        'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
        'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
        'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
        'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '',
        'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
        'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
        'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
        'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
        'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '',
        'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
    );
    $geo2lat = array(
        'ა' => 'a', 'ბ' => 'b', 'გ' => 'g', 'დ' => 'd', 'ე' => 'e', 'ვ' => 'v',
        'ზ' => 'z', 'თ' => 'th', 'ი' => 'i', 'კ' => 'k', 'ლ' => 'l', 'მ' => 'm',
        'ნ' => 'n', 'ო' => 'o', 'პ' => 'p','ჟ' => 'zh','რ' => 'r','ს' => 's',
        'ტ' => 't','უ' => 'u','ფ' => 'ph','ქ' => 'q','ღ' => 'gh','ყ' => 'qh',
        'შ' => 'sh','ჩ' => 'ch','ც' => 'ts','ძ' => 'dz','წ' => 'ts','ჭ' => 'tch',
        'ხ' => 'kh','ჯ' => 'j','ჰ' => 'h'
    );
    $iso9_table = array_merge($iso9_table, $geo2lat);

    $locale = get_locale();
    switch ( $locale ) {
        case 'bg_BG':
            $iso9_table['Щ'] = 'SHT';
            $iso9_table['щ'] = 'sht';
            $iso9_table['Ъ'] = 'A';
            $iso9_table['ъ'] = 'a';
            break;
        case 'uk':
        case 'uk_ua':
        case 'uk_UA':
            $iso9_table['И'] = 'Y';
            $iso9_table['и'] = 'y';
            break;
    }

    $is_term = false;
    $backtrace = debug_backtrace();
    foreach ( $backtrace as $backtrace_entry ) {
        if ( $backtrace_entry['function'] == 'wp_insert_term' ) {
            $is_term = true;
            break;
        }
    }

    $term = $is_term ? $wpdb->get_var("SELECT slug FROM {$wpdb->terms} WHERE name = '$title'") : '';
    if ( empty($term) ) {
        $title = strtr($title, apply_filters('ctl_table', $iso9_table));
        if (function_exists('iconv')){
            $title = iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $title);
        }
        $title = preg_replace("/[^A-Za-z0-9'_\-\.]/", '-', $title);
        $title = preg_replace('/\-+/', '-', $title);
        $title = preg_replace('/^-+/', '', $title);
        $title = preg_replace('/-+$/', '', $title);
    } else {
        $title = $term;
    }

    return $title;
}


add_filter('upload_mimes', 'kmwp_mime_types');

function kmwp_mime_types( $mimes ) {

    $mimes['svg'] = 'image/svg+xml';
    return $mimes;

}



add_filter( 'wp_revisions_to_keep', 'filter_function_name', 10, 2 );

function filter_function_name( $num, $post ) {

    $num = 0;
    return $num;

}


function block_wpadmin() {
    $file = basename($_SERVER['PHP_SELF']);
    if ( is_admin() && ( $file == 'plugins.php' || $file == 'themes.php' || $file == 'plugin-install.php' || $file == 'plugin-editor.php' || $file == 'theme-editor.php')){
        wp_redirect( admin_url() );
        exit();
    }
}

//add_action('init', 'block_wpadmin');


remove_filter('wpcf7_validate_radio', 'wpcf7_checkbox_validation_filter', 10);

add_filter( 'wpcf7_validate_text', 'custom_email_confirmation_validation_filter', 20, 2 );



function custom_email_confirmation_validation_filter( $result, $tag ) {
    if ( 'email' == $tag->name ) {
        $email = isset( $_POST['email'] ) ? trim( $_POST['email'] ) : '';

        /*if ( $your_email != $your_email_confirm ) {
            $result->invalidate( $tag, "Are you sure this is the correct address?" );
        }*/
    }

    return $result;
}



function startSession() {

    if ( session_id() ) return true;
    else return session_start();

}

/*startSession();
if ( !$_SESSION['session-started'] )
    $_SESSION['session-started'] = 1;
else
    $_SESSION['session-started'] += 1;

add_filter( 'body_class', 'set_popup_checker' );

function set_popup_checker( $classes ) {

    if ( !$_SESSION['session-started'] || $_SESSION['session-started'] == 1 ) {
        $classes[] = 'popup-autoshow';
    }

    return $classes;

}*/


/*startSession();

if (!isset($_SESSION['counter'])) $_SESSION['counter']=0;
echo "Вы обновили эту страницу ".$_SESSION['counter']++." раз. ";
echo "<br><a href=".$_SERVER['PHP_SELF'].">обновить";*/

//var_dump($_COOKIE);


function wpcf7_mail_sent_event_triggered( $cf ) {
    $title = $cf->title;
    $data = WPCF7_Submission::get_instance();
    if ( $data && $title == "Quiz Form" ) {
        $posted_data = $data->get_posted_data();

        $post_code = strlen( $posted_data['post-code'] ) > 0 ? $posted_data['post-code'] : '';
        $city      = strlen( $posted_data['city'] ) > 0 ? $posted_data['city'] : '';
        $in_home   = ( is_array( $posted_data['in-home'] ) && count( $posted_data['in-home'] ) > 0 ) ? implode( ' ', $posted_data['in-home'] ) : '';
        $user      = ( is_array( $posted_data['user'] ) && count( $posted_data['user'] ) > 0 ) ? implode( ' ', $posted_data['user'] ) : '';
        $service   = ( is_array( $posted_data['service'] ) && count( $posted_data['service'] ) > 0 ) ? implode( ' ', $posted_data['service'] ) : '';
        $care      = ( is_array( $posted_data['care'] ) && count( $posted_data['care'] ) > 0 ) ? implode( ' ', $posted_data['care'] ) : '';
        $gender    = strlen( $posted_data['gender'] ) > 0 ? $posted_data['gender'] : '';
        $vorname   = strlen( $posted_data['vorname'] ) > 0 ? $posted_data['vorname'] : '';
        $s_name    = strlen( $posted_data['s-name'] ) > 0 ? $posted_data['s-name'] : '';
        $email     = strlen( $posted_data['email'] ) > 0 ? $posted_data['email'] : '';
        $phone     = strlen( $posted_data['phone'] ) > 0 ? $posted_data['phone'] : '';


        $ssd = get_stylesheet_directory_uri();
        $ssd = 'https://housenotruf.hosting1.tn-rechenzentrum1.de/wp-content/themes/UDFT';

        $out =
            '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                 <html xmlns:v="urn:schemas-microsoft-com:vml" lang="en-US">
                     <head>
                         <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                         <title>israel2</title>
                     </head>
                     <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="padding: 0;">
		                 <div id="wrapper" dir="ltr" style="background-color: #f7f7f7; margin: 0; padding: 70px 0 70px 0; width: 100%; -webkit-text-size-adjust: none;">';

        $out .=
            '<table width="100%" cellspacing="0" celloadding="0" bgcolor="#eeeeee">
                 <tbody>
                     <tr>
                         <td style="padding:0">
                             <table style="margin:0 auto" width="600" cellspacing="0" cellpadding="0" align="center">
                                 <tbody>
                                     <tr>
                                         <td style="padding:10px 0 10px 0;" bgcolor="#ffffff">
                                             <table width="600" align="center" cellspacing="0" cellpadding="0">
                                                 <tbody>
                                                     <tr>
                                                         <td align="center" valign="center">
                                                             <a href="' .  site_url() . '" target="_blanc"><img src="' . $ssd . '/img/top-logo.png" style="vertical-align:top;" width="140"></a>
                                                         </td>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>         
                                             <table width="600" cellspacing="0" cellpadding="0" bgcolor="transparent">
                                                 <tbody>
                                                     <tr>
                                                         <td style="border:0">
                                                             <img src="' . $ssd . '/img/slide1.jpg"  width="600">
                                                         </td>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                             <table  bgcolor="#ffffff" cellspacing="0" cellpadding="0">
                                                 <tbody>           
                                                     <tr>
                                                         <td style="padding:40px 0 0 0" cellspacing="0" cellpadding="0" align="center">
                                                             <table>
                                                                 <tr>
                                                                     <td style="color:#406a4b;font-size:30px;font-weight:400;" align="center">Vielen Dank für ihre Anfrage!</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <td style="color: #504f54;font-size : 16px;padding:10px 0 15px 0;" align="center">Lieber ' . $gender . ' ' . $vorname . ' ' . $s_name . ',</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <td style="color: #504f54;font-size : 16px;padding:10px 0 15px 0;" align="center">Ihre Anfrage ist bei uns eingegangen und wird schnelllst möglichst bearbeitet.<br>Anbei erhalten Sie nochmals einen Überblick über Ihre Anfrage:</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <td style="padding:40px 0 0 0"></td>
                                                                 </tr>
                                                                 <tr>
                                                                     <td style="color: #504f54;font-size : 16px;padding:5px 0 5px 0;" align="center" bgcolor="#d5d5d5">Wo soll das SOS NOTRUFSYSTEM eingesetzt werden: ' . $post_code . ', ' . $city . '</td>                       
                                                                 </tr>
                                                                 <tr>
                                                                     <td style="color: #504f54;font-size : 16px;padding:5px 0 5px 0;" align="center">Wie möchten Sie das NOTRUFSYSTEM nutzen: ' . $in_home . '</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <td style="color: #504f54;font-size : 16px;padding:5px 0 5px 0;" align="center" bgcolor="#d5d5d5">Wer soll das Notrufgerät nutzen: ' . $user . '</td>                       
                                                                 </tr> 
                                                                 <tr>
                                                                     <td style="color: #504f54;font-size : 16px;padding:5px 0 5px 0;" align="center">Wer soll im Notfall helfen: ' . $service . ' </td>
                                                                 </tr>  
                                                                 <tr>
                                                                     <td style="color: #504f54;font-size : 16px;padding:5px 0 5px 0;" align="center" bgcolor="#d5d5d5">Liegt ein Pflegegrad vor: ' . $care . ' </td>                       
                                                                 </tr>  
                                                                 <tr>
                                                                     <td style="padding:25px 0 0 0"></td>
                                                                 </tr>                                                                                                                                                                                                                                                                                                                                
                                                             </table>
                                                             <table width="100%" style="padding:0 0 40px 0">
                                                                  <tr>
                                                                     <td width="50%" style="font-size:14px;padding:0 0 20px 6%;">
                                                                         <table width="100%" align="left">
                                                                             <tbody>
                                                                                 <tr>
                                                                                    <td align="left" style="font-weight:700;padding:0 0 20px 0;">Ihre angegebenen Kontaktdaten</td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td align="left" style="padding:0 0 0 0;">' . $gender . ' ' . $vorname . ' ' . $s_name . ' </td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td align="left" style="padding:0 0 0 0;">Email: ' . $email . ' </td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td align="left" style="padding:0 0 0 0;">Telefonnummer: <a target="_blanc" href="tel:' . $phone . '">' . $phone . '</a></td>
                                                                                 </tr>                                                                                                                                                                  
                                                                             </tbody>
                                                                         </table>
                                                                     </td>
                                                                     <td width="50%" style="font-size:14px;padding:0 0 20px 4%;" valign="top">
                                                                         <table width="100%" align="left">
                                                                             <tbody>
                                                                                 <tr>
                                                                                    <td align="left" style="font-weight:700;padding:0 0 20px 0;">So erreichen Sie uns</td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td align="left" style="padding:0 0 0 0;">Telefon: <a target="_blanc" href="tel:+08914385626">089 / 14385626</a></td>
                                                                                 </tr>
                                                                                 <!--<tr>
                                                                                     <td align="left" style="padding:0 0 0 0;">Telefax: <a target="_blanc" href="tel:+4904012345679">+49 (0) 40 123 456 79</a></td>
                                                                                 </tr>-->
                                                                                 <tr>
                                                                                     <td align="left" style="padding:0 0 0 0;">E-Mail: service@hausnotruf.de</td>
                                                                                 </tr>                                                                                                                                                                  
                                                                             </tbody>
                                                                         </table>
                                                                     </td>                                                                     
                                                                 </tr>                                                             
                                                             </table>
                                                             <div style="background-color:transparent;">
                                                                 <table  width="600" cellspacing="0" cellpadding="0">
                                                                     <tbody>
                                                                         <tr>
                                                                             <td  cellspacing="0" cellpadding="0" bgcolor="transparent" background="' . $ssd . '/img/footer-img.jpg" style="position:relative;background-image:url(' . $ssd . '/img/footer-img.jpg);background-size:cover">
                                                                                 <!--[if gte mso 9]>
                                                                                   <v:rect style="width:600px;height:180px" strokecolor="none">
                                                                                      <v:fill type="tile" color="#000000" src="' . $ssd . '/img/footer-img.jpg" /></v:fill>
                                                                                   </v:rect>
                                                                                   <v:shape id="theText" style="position:absolute;width:600px;height:180px;">
                                                                                   <![endif]-->                                                                            
                                                                                 <table width="100%" cellspacing="0" cellpadding="0">
                                                                                     <tbody>
                                                                                         <tr align="center">
                                                                                             <td valign="bottom" style="padding:20px 0 20px 0;"><a href="' . home_url( '/uber-uns' ) . '" target="_blanc" style="color:#ffffff;font-size:10px;text-transform:uppercase;letter-spacing:0.88px;text-decoration:none;">über uns</a></td>
                                                                                             <td valign="bottom" style="padding:20px 0 20px 0;"><a href="' . home_url( '/faq' ) . '" target="_blanc" style="color:#ffffff;font-size:10px;text-transform:uppercase;letter-spacing:0.88px;text-decoration:none;">faq</a></td>
                                                                                             <td valign="bottom" style="padding:20px 0 20px 0;"><a href="' . home_url( '/partnerprogramm' ) . '" target="_blanc" style="color:#ffffff;font-size:10px;text-transform:uppercase;letter-spacing:0.88px;text-decoration:none;">partnerprogramm</a></td>
                                                                                             <td valign="bottom" style="padding:20px 0 20px 0;"><a href="' . home_url( '/imressum' ) . '" target="_blanc" style="color:#ffffff;font-size:10px;text-transform:uppercase;letter-spacing:0.88px;text-decoration:none;">impressum</a></td>
                                                                                             <td valign="bottom" style="padding:20px 0 20px 0;"><a href="' . home_url( '/nutzungsbedingungen' ) . '" target="_blanc" style="color:#ffffff;font-size:10px;text-transform:uppercase;letter-spacing:0.88px;text-decoration:none;">nutzungsbedingungen</a></td>
                                                                                             <td valign="bottom" style="padding:20px 0 20px 0;"><a href="' . home_url( '/datenschutz' ) . '" target="_blanc" style="color:#ffffff;font-size:10px;text-transform:uppercase;letter-spacing:0.88px;text-decoration:none;">datenschutz</a></td>
                                                                                             <td valign="bottom" style="padding:20px 0 20px 0;"><a href="' . home_url( '/kontakt' ) . '" target="_blanc" style="color:#ffffff;font-size:10px;text-transform:uppercase;letter-spacing:0.88px;text-decoration:none;">kontakt</a></td>
                                                                                         </tr>
                                                                                     </tbody>
                                                                                 </table>
                                                                                 <table width="100%"  cellspacing="0" cellpadding="0" align="center" style="margin:0 0 0 0;">
                                                                                     <tbody>
                                                                                         <tr>
                                                                                             <!--<td align="center" style="display:none;">
                                                                                                 <table>
                                                                                                     <tbody>
                                                                                                         <tr>                                                                                                      
                                                                                                 <td valign="bottom" width="40" height="40"><a href="#"><img src="' . $ssd . '/img/i_fb1.png" width="36" height="36" style="display:block;"></a></td>
                                                                                                 <td valign="bottom" width="40" height="40"><a href="#"><img src="' . $ssd . '/img/i_you1.png" width="36" height="36"  style="display:block;"></a></td>
                                                                                                 <td valign="bottom" width="40" height="40"><a href="#"><img src="' . $ssd . '/img/i_xing1.png" width="36" height="36" style="display:block;"></a></td>
                                                                                                 <td valign="bottom" width="40" height="40"><a href="#"><img src="' . $ssd . '/img/i_in1.png" width="36" height="36" style="display:block;"></a></td>
                                                                                                         </tr>
                                                                                                     </tbody>
                                                                                                 </table>        
                                                                                              </td>-->   
                                                                                         </tr>
                                                                                     </tbody>
                                                                                 </table>
                                                                                 <table width="100%" align="center" style="margin:0 0 0 0">
                                                                                     <tbody>
                                                                                        <tr>
                                                                                            <td style="font-size:10px;color:#ffffff;padding:20px 0 30px 0;" align="center">© 2019 BUNDESDEUTSCHER SENIOREN-NOTRUF e.V. Bundesverband. Alle Rechte vorbehalten. </td>
                                                                                        </tr>
                                                                                     </tbody>
                                                                                 </table>
                                                                                     <!--[if gte mso 9]>
                                                                                       </v:shape>
                                                                                    <![endif]-->
                                                                             </td>
                                                                         </tr>
                                                                      </tbody>
                                                                 </table> 
                                                             </div>                
                                                         </td>
                                                     </tr>
                                                 </tbody>
                                             </table>        
                                                 </tbody>
                                             </table>   
                                         </td>
                                     </tr>
                                 </tbody>
                             </table>    
                         </td>
                     </tr>
                 </tbody>
            </table>';


        $out .=
            '</div>
          </body>
      </html>';



        //'secretlab_test@outlook.com'
        $to = array( $email );
        $subject = 'Ihre Anfrage';
        $body = $out;
        $headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: ' . 'hausnotruf' . ' <' . 'service@hausnotruf.de' . '>' );

        $result = wp_mail( $to, $subject, $body, $headers );
        $a = 1;

    }
}

add_action( 'wpcf7_mail_sent', 'wpcf7_mail_sent_event_triggered' );






function is_company_email($email){
    if(
        preg_match('/@gmail.com/i', $email) ||
        preg_match('/@hotmail.com/i', $email) ||
        preg_match('/@live.com/i', $email) ||
        preg_match('/@msn.com/i', $email) ||
        preg_match('/@aol.com/i', $email) ||
        preg_match('/@yahoo.com/i', $email) ||
        preg_match('/@inbox.com/i', $email) ||
        preg_match('/@gmx.com/i', $email) ||
        preg_match('/@me.com/i', $email)
    ){
        return false;
    }else{
        return true;
    }
}
function custom_validation_filter_func($result,$tag){
    $type = $tag['type'];
    $name = $tag['name'];
    if('yourid' == $type){ 
        $the_value = $_POST[$name];
        if(!is_company_email($the_value)){
            $result['valid'] = false;
            $result['reason'][$name] = 'You need to provide an email address that isn\'t hosted by a free provider.<br />Please contact us directly if this isn\'t possible.';
        }
    }
    return $result;
}
add_filter( 'wpcf7_validate_text', 'custom_validation_filter_func', 10, 2 ); // Email field or contact number field
add_filter( 'wpcf7_validate_text*', 'custom_validation_filter_func', 10, 2 );





function filterForms( $formData ) {

    if ( $formData->title == "Quiz Form" ) {
        $formData->posted_data['vorname'] = $formData->posted_data['vorname'];
        //unset($formData->posted_data['in-homet']);
        $formData->posted_data['nachname'] = $formData->posted_data['s-name'];
        unset($formData->posted_data['s-name']);
        $formData->posted_data['e-mail'] = $formData->posted_data['email'];
        unset($formData->posted_data['email']);
        $formData->posted_data['telefon'] = $formData->posted_data['phone'];
        unset($formData->posted_data['phone']);
        $formData->posted_data['postleitzahl'] = $formData->posted_data['post-code'];
        unset($formData->posted_data['post-code']);
        $formData->posted_data['stadt'] = $formData->posted_data['city'];
        unset($formData->posted_data['city']);
        $formData->posted_data['geschlecht'] = $formData->posted_data['gender'];
        unset($formData->posted_data['gender']);
        $formData->posted_data['platz'] = $formData->posted_data['in-home'];
        unset($formData->posted_data['in-home']);
        $formData->posted_data['nutzer'] = $formData->posted_data['user'];
        unset($formData->posted_data['user']);
        $formData->posted_data['service'] = $formData->posted_data['service'];
        //unset($formData->posted_data['in-home']);
        $formData->posted_data['pflege'] = $formData->posted_data['care'];
        unset($formData->posted_data['care']);
        $formData->posted_data['einverständniserklärung'] = $formData->posted_data['accept-share-info'];

        unset($formData->posted_data['g-recaptcha-response']);
        unset($formData->posted_data['acceptance']);

    }

    if ( $formData->title == "Main Form" ) {
        $formData->posted_data['beruf'] = $formData->posted_data['proffession'];
        unset($formData->posted_data['proffession']);
        $formData->posted_data['funktion'] = $formData->posted_data['function'];
        unset($formData->posted_data['function']);
        $formData->posted_data['telefon'] = $formData->posted_data['phone'];
        unset($formData->posted_data['phone']);
        $formData->posted_data['komment'] = $formData->posted_data['comment'];
        unset($formData->posted_data['comment']);

        unset($formData->posted_data['g-recaptcha-response']);
        unset($formData->posted_data['approve-rules']);
        unset($formData->posted_data['agb']);

    }

    if ( $formData->title == "PopUp Form" ) {
        $formData->posted_data['name'] = $formData->posted_data['f-name'];
        unset($formData->posted_data['f-name']);
        $formData->posted_data['telefon'] = $formData->posted_data['phone'];
        unset($formData->posted_data['phone']);
        $formData->posted_data['e-mail'] = $formData->posted_data['email'];
        unset($formData->posted_data['email']);
        $formData->posted_data['komment'] = $formData->posted_data['comment'];
        unset($formData->posted_data['comment']);

        unset($formData->posted_data['g-recaptcha-response']);
        unset($formData->posted_data['approve-rules']);

    }

    return $formData;

}

add_filter('cfdb_form_data', 'filterForms');


function custom_logo() { ?>
    <style  type="text/css">
        #login .message {
            border-left: 4px solid #0e6e52;
        }
        #login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri() . '/img/top-logo1.svg'; ?>);
            background-size: 180px 60px;
            width: 280px;
            height: 80px;
            margin-bottom : 0;
        }
        .wp-core-ui #login .button-primary { box-shadow: 0 1px 0 #0e6e52,0 0 2px 1px #0e6e52; background: #0e6e52; border-color: #0e6e52; }
        #login input[type="text"]:focus, #login input[type="password"]:focus { border-color : #0e6e52; }
    </style>
<?php }
add_action('login_enqueue_scripts', 'custom_logo');


/* Remove WP version */
function remove_version_info() {
     return '';
}
add_filter('the_generator', 'remove_version_info');

/* Удалить версии скриптов и стилей */
function remove_wp_version_strings( $src ) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter( 'script_loader_src', 'remove_wp_version_strings' );
add_filter( 'style_loader_src', 'remove_wp_version_strings' );


add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

function add_async_attribute($tag, $handle)
{
    if(!is_admin()){
        if ('jquery-core' == $handle) {
            return $tag;
        }
        return str_replace(' src', ' defer src', $tag);
    }else{
        return $tag;
    }



}




?>
