jQuery(document).ready( function( $ ) {


    function getCookie( name ) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : 0;
    }


    function setCookie(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    }


    function deleteCookie( name, domain = null ) {
        if ( !domain ) domain = '/';
        setCookie(name, "", {
            expires: -1, path : domain
        })
    }

    /*$(window).on( 'beforeunload', function( e ) {
    deleteCookie('housenotruf-seans');
});*/


    $('.tsts-box').slick({
        'slidesToShow': 3,
        'slideToScroll': 1,
        'dots': false,
        'arrows': true,
        'infinity' : true,
        'autoplay' : true,
        'autoplaySpeed' : 20000,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
        ]
    });


    $('.modal-close').on('click', function (e) {
        $('body').removeClass('has-modal');

    });

    $('a.fm-btn').on('click', function (e) {

        if (($('body').hasClass('has-error-box'))) {
            $('body').removeClass('has-modal');
            $('body').removeClass('has-error-box');
            $('body').removeClass('show-data');
        }

    });


    $('a.card-btn').on( 'click', function( e ) {

        e.preventDefault();

        $('.form-messages .fm-title').text('Unter folgenden Bankdaten können Sie die Arbeit unseres Vereins unterstützen:');
        $('.form-messages .fm-text').html(
            '<div class="bank-data">' +
                '<div class="bank-line"><div class="bank-title">iban</div><div class="bank-value">Spendenkonto</div></div>' +
                '<div class="bank-line"><div class="bank-title">bic</div><div class="bank-value">Ev. Darlehnsgenossenschaft eG</div></div>' +
                '<div class="bank-line"><div class="bank-title">bank</div><div class="bank-value">DE 02 5206 0410 0006 4214 66</div></div>' +
            '</div>'
        );
        $('body').addClass('has-modal has-error-box show-data');

    });


    var current = 1;

    function QFSwitchFrame( next, formClass ) {

        $('.qf-frame').removeClass('current');
        $('.qf-frame').each( function( i, el ) {
            if ( parseInt( $(el).attr('data-frame-n') ) == next ) {
                $(el).addClass('current');
            }
        });

        $('.control-item').removeClass( 'selected' );
        $('.control-item').each( function( i, el ) {
            if ( parseInt( $(el).attr('data-frame-connected') ) == next )
                $(el).addClass( 'selected' );
        });

        if ( next == 6 ) {
            $('.quiz-form-box').addClass('last-frame');
        }
        else {
            $('.quiz-form-box').removeClass('last-frame');
        }

        formClass = formClass.replace( /current-frame-[0-9]{1,2}/, '' );
        $('.quiz-form').attr( 'class', formClass + ' current-frame-' + next );

        current = next;

    }


    function listForm( e, localCurrent ) {

        var direction = $(e.target).hasClass('forward-btn') ? 1 : -1,
            next = current + direction * 1,
            formClass = $('.quiz-form').attr('class');

        if ( localCurrent ) current = localCurrent;

        QFSwitchFrame( next, formClass );

    }


    $('.quiz-form .control-item').on( 'click', function( e ) {

        var trg, current, prev;

        trg = $(e.target).hasClass( 'control-item') ? $(e.target) : $(e.target).parent();
        current = parseInt( $(trg).attr('data-frame-connected') );
        prev = parseInt( $( '.quiz-form .control-item.selected' ).attr('data-frame-connected') );

        QFSwitchFrame( current, $('.quiz-form').attr('class') )

    });


    $('.qf-frame-controls a').on( 'click', function( e ) {

        e.preventDefault();

        listForm(e);

    });


    $( '.wpcf7-form-control-wrap' ).click( function() {
        $( this ).children( ".wpcf7-not-valid-tip" ).css( "display", "none" );
    });

    $('.quiz-form .wpcf7-checkbox .wpcf7-list-item-label, .quiz-form .wpcf7-radio .wpcf7-list-item-label').on( 'click', function( e ) {
        $(e.target).parent().find('input').trigger( 'click' );
    });


    $( document ).on('click', '.form-messages.middle-popup .accept-info', function( e ) {

        e.preventDefault();

        $('input.accept-share-info').addClass('setted');
        $('input.accept-share-info').val('accepts');
        $('body').removeClass('has-modal has-error-box show-data');
        $(".quiz-form-box .wpcf7-form .wpcf7-submit").trigger('click');


    } );


    $( document ).on('click', '.form-messages.middle-popup .refuse-info', function( e ) {

        e.preventDefault();

        $('input.accept-share-info').addClass('setted');
        $('input.accept-share-info').val('refuses');
        $('body').removeClass('has-modal has-error-box show-data');
        $(".quiz-form-box .wpcf7-form .wpcf7-submit").trigger('click');

    } );



    $(".quiz-form-box .wpcf7-form input[type='submit'], .quiz-form-box .wpcf7-form button").click(function( e ) {

        $( e ).find('span.wpcf7-form-control-wrap').removeClass('has-error');

        if ( !$('input.accept-share-info').hasClass('setted') ) {

            $('.form-messages').addClass('middle-popup');
            $('.form-messages .fm-title').text('Einverständniserklärung zur Weitergabe personenbezogener Daten');
            $('.form-messages .fm-text').html(
                '<div class="error-message"><p>Um Sie zeitnah, umfassend und individuell informieren zu können, benötigen wir Ihre ausdrückliche Einwilligung die erhobenen und gespeicherten Daten ausschließlich zum Zweck Ihrer Information an Hausnotruf-Anbieter weiterzuleiten.</p>' +
                '<p>Mir ist bekannt, dass ich zur Abgabe der Einwilligungserklärung nicht verpflichtet bin und ich diese Einwilligungserklärung jederzeit mit Wirkung für die Zukunft widerrufen kann. Der Widerruf ist per E-Mail zu richten an: datenschutz@hausnotruf.de oder postalisch an: Bundesdeutscher-Seniorennotruf e.V. Bundesverband, Ehrenbreitsteinerstr. 20 in 80993 München. Der Widerruf bewirkt, dass meine aufgrund dieser Einwilligungserklärung erfassten Daten gelöscht und mir keine Angebote und Informationen mehr unterbreitet werden. Mit der Verwendung der oben angegebenen Daten durch den Bundesdeutscher-Seniorennotruf e.V. Bundesverband zum Zwecke der Information über Notrufsysteme erkläre ich mich hiermit einverstanden.</p>' +
                '<div class="buttons-area"><a class="btn green-btn bold back-btn accept-info">Ich akzeptiere</a><a class="btn green-btn bold back-btn refuse-info">Ich lehne ab</a></div>' +
                '</div>'
            );
            $('body').addClass('has-modal has-error-box show-data');
            return false;

        }

        else {

            $( document ).one( "ajaxComplete", function( event, xhr, settings ) {
                var data = xhr.responseText;
                var jsonResponse = JSON.parse(data);
                var errors, message = '', names = { '.s-name' : 'Nachname', '.email' : 'Email', '.phone' : 'Telefon Nummer', '.acceptance' : 'Einwilligung Datenschutz:' }, name = '';
                console.log(jsonResponse);
                if(! jsonResponse.hasOwnProperty('into') || $('.wpcf7' + jsonResponse.into).length === 0) return;
                // alert(jsonResponse.message);
                /*$.fancybox.open(
                    '<div class="message">' + jsonResponse.message + '</div>',
                    {
                        smallBtn : true,
                        toolbar : false
                    }
                );*/
                if ( jsonResponse.status == 'validation_failed' ) {
                    errors = jsonResponse.invalidFields;
                    $( errors ).each( function( i, error ) {
                        $('.quiz-form ' + error.into).addClass('has-error');
                        name = error.into.replace( 'span.wpcf7-form-control-wrap', '' );
                        name = names[name];
                        message += '<div class="error-line"><span>' + name + '</span> ' + error.message + '</div>';
                    });
                    $('.form-messages .fm-title').text('Das Formular weist Fehler auf');
                    $('.form-messages .fm-text').html(
                        '<div class="error-message">' + message + '</div>'
                    );
                }
                else if ( jsonResponse.status == 'mail_sent' ) {
                    $('.form-messages .fm-title').text('Ihre Anfrage wurde versendet');
                    $('.form-messages .fm-text').html(
                        '<div class="accepted-request">' + 'Nach Prüfung Ihrer Anforderungen werden wir uns umgehend bei Ihnen zurückmelden.' + '</div>'
                    );
                }
                $('body').addClass('has-modal has-error-box show-data');
            });

        }

    });


    $('.quiz-form input').on('click', function( e ) {
        $(e.target).parents('.has-error').removeClass('has-error');
    });



    if ( $('.more-content').length > 0 ) {

        $('.more-content-box .open-more').on( 'click', function( e ) {

            var p = $(e.target).parents('.more-content-box');

            if (!p.hasClass('opened')) {
                p.animate({height: p.find('.more-content').outerHeight() + 'px'}, 400, function () {
                    p.addClass('opened');
                });
            }
            else {
                p.animate({height: 180 + 'px'}, 400, function () {
                    p.removeClass('opened');
                });
            }

        });

    }

    $('.cn-close').on('click', function( e ) {

        e.preventDefault();

        $('.cookie-notice').animate( { 'right' : '-2000px' }, 700 );

    });


    $('.cn-btn').on( 'click', function( e ) {

        e.preventDefault();

        setCookie( 'approved-cookie', 1, { 'expires' : new Date('April 24, 2059 18:00:00'), 'path' : '/' } );
        $('body').addClass('hide-cookie-notice');

    });



    $(window).on( 'scroll', function( e ) {
        if ( $(window).scrollTop() > 131 ) {
            $('.header.clear').addClass('thin');
        }
        else {
            $('.header.clear').removeClass('thin');
        }
    });


    $('.smooth-btn').on( 'click', function( e ) {
        e.preventDefault();
        console.log( $('.top-bg' ).offset().top  );
        $("html, body").animate({ scrollTop: $( '.' + $(e.target).attr('href').replace( '#', '' ) ).offset().top + 'px' }, 1000);
    })


    var now = new Date();
    var c = getCookie( 'housenotruf-seans' );

    //console.log(document.cookie);
    //deleteCookie('housenotruf-seans');


    if ( c == 0 || ( ( now.getTime() - c ) > 30*60*1000 ) ) {
        console.log("setted");
        setCookie( 'housenotruf-seans', now.getTime(), { 'path': '/' } );
        PF = setTimeout(function ( ) {
            $('.popup-button').trigger('click');
            $('.popup-button').addClass('must-second-fire');
        }, 30 * 1000);
    }

    $('.popup-button').on( 'click', function( e ) {
        if ( window.PF ) clearTimeout( PF );
        $(e.target).parents('.popup-box').addClass('active');
    });

    $('.pf-close').on( 'click', function( e ) {
        $(e.target).parents('.popup-box').removeClass('active');
        if ( $('.popup-button').hasClass('must-second-fire') ) {
            setTimeout(function () {
                $('.popup-button').trigger('click');
            }, 30 * 1000);
            $('.popup-button').removeClass('must-second-fire');
        }
    });


    $('.menu-manage').on( 'click', function( e ) {
        var trg;
        if ( !$(e.target).hasClass('menu-manage') )
            trg = $(e.target).parent();
        else
            trg = $(e.target);

        if ( !$(trg).hasClass('active') ) {
            $(trg).addClass('active');
            $('.top-menu-box').addClass('active');
        }
        else {
            $(trg).removeClass('active');
            $('.top-menu-box').removeClass('active');
        }
    });



});
