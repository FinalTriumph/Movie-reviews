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
        $("#header_arrow_span").html("<img src='http://i.imgur.com/bFeYehs.png' class='header_arrow'>");
    } else {
        $("#profile_options_dropdown").show();
        $("#header_arrow_span").html("<img src='http://i.imgur.com/fyJAGJV.png' class='header_arrow'>");
    }
});

$('#profile_options, #profile_options_dropdown').hover(function() {
        $("#profile_options_dropdown").show();
        $("#header_arrow_span").html("<img src='http://i.imgur.com/fyJAGJV.png' class='header_arrow'>");
        $(this).css('border-color', '#444');
    }, function() {
        $("#profile_options_dropdown").hide();
        $("#header_arrow_span").html("<img src='http://i.imgur.com/bFeYehs.png' class='header_arrow'>");
        $(this).css('border-color', '#ddd');
    });
    
</script>