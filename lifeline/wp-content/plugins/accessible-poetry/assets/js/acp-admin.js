

jQuery(document).ready(function($) {
/*
    $('#acp-panel-content input').each(function() {

        var inputName   = $(this).attr("name");
        var inputID     = $(this).attr("id");

        var inputType   = $(this).attr("type");

        if( inputType != "submit" && inputType != "hidden" ) {
            $(this).parent().parent().find("th").wrapInner("<label for='" + inputID + "'></label>");
        }

        if( inputType === "checkbox" ) {

            $(this).parent().parent().find("th").find("label").attr("id", "label-" + inputID);

            $(this).detach().prependTo( "#label-" + inputID );
        }

    });

    $("#declaration").parent().parent().next().hide();

    $('#declaration').click(function() {
        $(this).parent().parent().parent().next().fadeToggle(400);
    });
    if ($('#declaration:checked').val() !== undefined) {
        $("#declaration").parent().parent().parent().next().show();
    }

    $("#contact").parent().parent().next().hide();

    $('#contact').click(function() {
        $("#contact").parent().parent().parent().next().fadeToggle(400);
    });
    if ($('#contact:checked').val() !== undefined) {
        $("#contact").parent().parent().next().show();
    }
*/
	var openItems = $('.acp-fieldset.tag.open').length;
	console.log(openItems);
    $("#acp-new-replacement").find("span").text(3 - openItems);
        
    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });

    $("#acp-new-replacement").click(function () {
        if( !$("#acp-fieldset-tag-1").hasClass("open") ) {
            $("#acp-fieldset-tag-1").addClass("open");
            $("#acp-fieldset-tag-1").slideDown(250);
        }
        else if( !$("#acp-fieldset-tag-2").hasClass("open") ) {
            $("#acp-fieldset-tag-2").addClass("open");
            $("#acp-fieldset-tag-2").slideDown(250);
        }
        else if( !$("#acp-fieldset-tag-3").hasClass("open") ) {
            $("#acp-fieldset-tag-3").addClass("open");
            $("#acp-fieldset-tag-3").slideDown(250);
        }

        var openItems = $('.acp-fieldset.tag.open').length;
        $(this).find("span").text(3 - openItems);
    });

    $(".close-tag").click(function () {
        var cnrm = confirm("Are you sure? it will delete the data.");
        if( cnrm ) {
            $(this).parent().removeClass("open").slideUp(250);
            var openItems = $('.acp-fieldset.tag.open').length;
            $("#acp-new-replacement").find("span").text(3 - openItems);

            $(this).parent().find(".acp-code-editor").attr("value", "");
            $(this).parent().find("select option:selected").removeAttr("selected");
        }

    });

    $("#enable_ajax_toolbar").click(function () {
        $("#acp-manual-activation").toggleClass("open");
    });

    if( $("#enable_ajax_toolbar").is(":checked") ) {
        $("#acp-manual-activation").toggleClass("open");
    }

    $("#enable_manual_toolbar").click(function () {
        $("#acp-ajax-activation").toggleClass("open");
    });

    if( $("#enable_manual_toolbar").is(":checked") ) {
        $("#acp-ajax-activation").toggleClass("open");
    }


    $("#enable_ajax_skiplinks").click(function () {
        $("#acp-manual-skiplinks").toggleClass("open");
    });

    if( $("#enable_ajax_skiplinks").is(":checked") ) {
        $("#acp-manual-skiplinks").toggleClass("open");
    }

    $("#enable_manual_skiplinks").click(function () {
        $("#acp-ajax-skiplinks").toggleClass("open");
    });

    if( $("#enable_manual_skiplinks").is(":checked") ) {
        $("#acp-ajax-skiplinks").toggleClass("open");
    }


    // PRO ONLY START
    $("#acp_link_outline").change(function () {

        if( $(this).val() === 'custom' )
            $(".acp-fieldset.custom-focus").slideDown();
        else
            $(".acp-fieldset.custom-focus").slideUp();
    });

    if( $("#acp_link_outline").val() === 'custom' )
        $(".acp-fieldset.custom-focus").slideDown();
    else
        $(".acp-fieldset.custom-focus").slideUp();
    // PRO ONLY END

});