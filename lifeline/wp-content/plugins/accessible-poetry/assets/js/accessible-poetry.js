function createCookie(a, e, t) {
    if (t) {
        var r = new Date;
        r.setTime(r.getTime() + 24 * t * 60 * 60 * 1e3);
        var o = "; expires=" + r.toGMTString()
    } else var o = "";
    document.cookie = a + "=" + e + o + "; path=/"
}
function readCookie(a) {
    for (var e = a + "=", t = document.cookie.split(";"), r = 0; r < t.length; r++) {
        for (var o = t[r];
             " " == o.charAt(0);) o = o.substring(1, o.length);
        if (0 == o.indexOf(e)) return o.substring(e.length, o.length)
    }
    return null
}
function eraseCookie(a) {
    createCookie(a, "", -1)
}
function acp_fontsize() {

    var include = jQuery("#acp-toolbar-wrap").attr("data-fontsizer-include");
    var exclude = jQuery("#acp-toolbar-wrap").attr("data-fontsizer-exclude");

    if (include) var included = "p,h1,h2,h3,q," + include;
    else             included = "p,h1,h2,h3,q";

    if (exclude) var excluded = "#acp-toolbar-title,#acp-toolbar-extra a,.acp-author a," + exclude;
    else             excluded = "#acp-toolbar-title,#acp-toolbar-extra a, .acp-author a";

    jQuery(included).not(excluded).each(function() {

        fontsize = parseInt(jQuery(this).css("font-size"));
        jQuery(this).attr("data-normal-size", fontsize);

    });

    jQuery("#acp-text-up").click(function() {
        jQuery("#acp-text-reset").show();
        jQuery(this).addClass("acp-active");
        jQuery("#acp-text-down").removeClass("acp-active").removeAttr("disabled");

        jQuery(included).each(function() {
            normalSize  = jQuery(this).attr("data-normal-size");
            fontSize    = parseInt(jQuery(this).css("font-size"));

            if( fontSize < normalSize ) {
                jQuery(this).css({
                    "font-size": normalSize + "px"
                })
            }
            else if( fontSize == normalSize) {
                jQuery(this).css({
                    "font-size": 1.5 * normalSize + "px"
                })
            }
            else if( fontSize == 1.5 * normalSize ){
                jQuery(this).css({
                    "font-size": 2 * normalSize + "px"
                })
            }

            jQuery("#acp-text-up").attr("disabled", "disabled");
        });
    });

    jQuery("#acp-text-down").click(function() {
        jQuery("#acp-text-reset").show();
        jQuery(this).addClass("acp-active");
        jQuery("#acp-text-up").removeAttr("disabled").removeClass("acp-active");

        jQuery(included).each(function() {
            normalSize = jQuery(this).attr("data-normal-size");
            fontSize = parseInt(jQuery(this).css("font-size"));

            if( fontSize > normalSize ) {
                jQuery(this).css({
                    "font-size": normalSize + "px"
                })
            }
            else if( fontSize <= normalSize ) {
                newSize = fontSize / 1.5;
            }

            if( newSize < 18 ) {
                size = 12;
            }
            else {
                size = newSize;
            }

            jQuery(this).css({
                "font-size": size + "px"
            });

            jQuery("#acp-text-down").attr("disabled", "disabled");
        });
    });

    jQuery("#acp-text-reset").click(function() {
        jQuery(this).hide();

        jQuery(included).each(function() {
            normalSize = jQuery(this).attr("data-normal-size");

            jQuery(this).css({
                "font-size": normalSize + "px"
            });
        });
        jQuery("#acp-text-up, #acp-text-down").removeAttr("disabled");
        jQuery("#acp-text-down, #acp-text-up").removeClass("acp-active");
    })
}
function acp_contrast() {
    var dark            = readCookie("acp_dark");
    var bright          = readCookie("acp_bright");
    var dark_button     = jQuery("#acp-contrast-dark");
    var bright_button   = jQuery("#acp-contrast-bright");
    var reset_button    = jQuery("#acp-contrast-reset");

    dark_button.click(function() {

        dark_button
            .attr("disabled", "disabled")
            .addClass("acp-active");

        bright_button
            .removeAttr("disabled")
            .removeClass("acp-active");

        jQuery("body")
            .removeClass("acp-bright")
            .addClass("acp-dark");

        reset_button
            .show();

        createCookie("acp_dark", "dark", 1);
        eraseCookie("acp_bright");
    });
    if( dark ) {

        dark_button
            .attr("disabled", "disabled")
            .addClass("acp-active");

        bright_button
            .removeAttr("disabled")
            .removeClass("acp-active");

        jQuery("body")
            .removeClass("acp-bright")
            .addClass("acp-dark");

        reset_button
            .show();
    };



    bright_button.click(function() {

        bright_button
            .attr("disabled", "disabled")
            .addClass("acp-active");

        dark_button
            .removeAttr("disabled")
            .removeClass("acp-active");

        jQuery("body")
            .removeClass("acp-dark")
            .addClass("acp-bright");

        reset_button
            .show();


        createCookie("acp_bright", "bright", 1);
        eraseCookie("acp_dark");
    });

    if( bright ) {

        bright_button
            .attr("disabled", "disabled")
            .addClass("acp-active");

        dark_button
            .removeAttr("disabled")
            .removeClass("acp-active");

        jQuery("body")
            .removeClass("acp-dark")
            .addClass("acp-bright");

        reset_button
            .show();
    };

    reset_button.click(function() {

        dark_button
            .removeClass("acp-active")
            .removeAttr("disabled");
        bright_button
            .removeClass("acp-active")
            .removeAttr("disabled");

        jQuery("body")
            .removeClass("acp-dark")
            .removeClass("acp-bright");

        eraseCookie("acp_dark");
        eraseCookie("acp_bright");

        reset_button
            .hide();
    });
}
function acp_underline() {
    jQuery("#acp-links-underline").click(function() {
        jQuery("body").toggleClass("acp-underline"), jQuery("body").hasClass("acp-underline") ? (jQuery("#acp-links-underline").addClass("acp-active"), createCookie("acp_underline", "underline", 1)) : (jQuery("#acp-links-underline").removeClass("acp-active"), eraseCookie("acp_underline"))
    }), readCookie("acp_underline") && (jQuery("body").toggleClass("acp-underline"), jQuery("#acp-links-underline").addClass("acp-active"))
}
function acp_highlight() {
    jQuery("#acp-links-marklinks").click(function() {
        jQuery("body").toggleClass("acp-marklinks"), jQuery("body").hasClass("acp-marklinks") ? (jQuery("#acp-links-marklinks").addClass("acp-active"), createCookie("acp_marklinks", "marklinks", 1)) : (jQuery("#acp-links-marklinks").removeClass("acp-active"), eraseCookie("acp_marklinks"))
    }), readCookie("acp_marklinks") && (jQuery("body").toggleClass("acp-marklinks"), jQuery("#acp-links-marklinks").addClass("acp-active"))
}
function acp_addLogoAria(id, aria) {
    this.id         = id;
    this.curAria    = jQuery(this.id).attr("aria-label");
    this.newAria    = aria;

    if( (this.id != '' && this.aria != '') && !this.curAria ) {
        jQuery( this.id ).attr("aria-label", this.newAria);
    }
}
function acp_readable() {

    jQuery("#acp-font-readable").click(function() {

        jQuery("body").toggleClass("acp-readable");

        if( jQuery("body").hasClass("acp-readable") ) {
            jQuery("#acp-font-readable").addClass("acp-active");
            createCookie("acp_readable", "readable", 1);
        }
        else {
            jQuery("#acp-font-readable").removeClass("acp-active");
            eraseCookie("acp_readable");
        }
    });

    if( readCookie("acp_readable") ) {
        jQuery("body").toggleClass("acp-readable");
        jQuery("#acp-font-readable").addClass("acp-active");
    }
}
function acp_animation() {
    jQuery("#acp-animation").click(function() {
        jQuery("body").toggleClass("acp-animation"), jQuery("body").hasClass("acp-animation") ? (jQuery.fx.off = !jQuery.fx.off, jQuery("#acp-animation").addClass("acp-active"), createCookie("acp_animation", "animation", 1)) : (jQuery.fx.off = !1, jQuery("#acp-animation").removeClass("acp-active"), eraseCookie("acp_animation"))
    }), readCookie("acp_animation") && (jQuery.fx.off = !jQuery.fx.off, jQuery("body").toggleClass("acp-animation"), jQuery("#acp-animation").addClass("acp-active"))
}
function acp_toolbar() {
    var fromTop = jQuery("#acp-toolbar-wrap").attr("data-from-top");

    if( jQuery(window).width() > 1025 ) {
        jQuery(window).scroll(function(a) {
            jQuery("#acp-toolbar").slideUp(), jQuery("#acp-toggle-toolbar").css({
                top: fromTop + "px"
            });
        });
    }


    jQuery("#acp-toggle-toolbar").css({
        top: fromTop + "px"
    });
    jQuery("#acp-toggle-toolbar").mouseenter(function() {
        jQuery(this).css({
            "background-color": "#90091F",
            transition: "all 200ms ease-out",
            "-ms-transition": "all 200ms ease",
            "-webkit-transition": "all 200ms ease",
            "-o-transition": "all 200ms ease"
        })
    });
    jQuery("#acp-toggle-toolbar").mouseleave(function() {
        jQuery(this).css({
            "background-color": "#274690"
        })
    });
    jQuery("#acp-toggle-toolbar").focusin(function() {
        jQuery(this).css({
            "background-color": "#90091F",
            transition: "all 200ms ease-out",
            "-ms-transition": "all 200ms ease",
            "-webkit-transition": "all 200ms ease",
            "-o-transition": "all 200ms ease"
        })
    });
    jQuery("#acp-toggle-toolbar").focusout(function() {
        jQuery(this).css({
            "background-color": "#274690"
        })
    });

    jQuery("#acp-toggle-toolbar").click(function() {
        jQuery("#acp-toolbar").slideDown(), jQuery(this).css({
            top: "-120px",
            transition: "all 600ms ease-out",
            "-ms-transition": "all 600ms ease",
            "-webkit-transition": "all 600ms ease",
            "-o-transition": "all 600ms ease"
        });
    });

    jQuery("#acp-toolbar-close").click(function() {
        jQuery("#acp-toolbar").hide(), jQuery("#acp-toggle-toolbar").css({
            "top": fromTop + "px"
        })
    })
}