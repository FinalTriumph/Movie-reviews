<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">
/* global $ */
$('form').submit(function() {
   $('input[type=submit]').attr("disabled", "disabled");
});

var speed = 200;

$('#profile_options').click(function() {
    if ($("#profile_options_dropdown").is(':visible')) {
        $("#profile_options_dropdown").hide();
    } else {
        $("#profile_options_dropdown").show();
    }
});

$('#profile_options, #profile_options_dropdown').hover(function() {
        $("#profile_options_dropdown").show();
        $("#profile_options").css('border-color', '#9b26af');
        $("#profile_options").css('color', '#9b26af');
    }, function() {
        $("#profile_options_dropdown").hide();
        $("#profile_options").css('border-color', '#691a99');
        $("#profile_options").css('color', '#ddd');
    });
    
$('.genres_toggle').click(function() {
    if ($(".genres_options").is(':visible')) {
        $(".genres_options").hide(200);
    } else {
        $('.genres_options').show(200).css('display', 'inline-block');
    }
});
    
$(document).ready(function() {
    $("#profile_options_dropdown").css("top", $("#header").outerHeight());
    
    var hrWidth = $(".single_post_hr").outerWidth();
    $(".single_review_user_info").css("width", hrWidth);
});
    
</script>