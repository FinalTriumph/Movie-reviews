/* global $ */

$('.review_div').hover(function() {
    //$('.review_text_hidden', this).slideDown(300);
    $('.review_text_hidden', this).fadeIn(300);
  }, function() {
    //$('.review_text_hidden', this).slideUp(200);
    $('.review_text_hidden', this).fadeOut(200);
  });
  
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
        $(".genres_options").hide(speed);
    } else {
        $('.genres_options').show(speed).css('display', 'inline-block');
    }
});

$('#search_term, #search_btn').hover(function() {
        $('#search_term, #search_btn').css('border-color', '#9b26af');
    }, function() {
        $('#search_term, #search_btn').css('border-color', '#444');
    });
    
$('#search_btn').click(function() {
    window.location = window.location.origin + "/search?search=" + $('#search_term').val();
})

$("input[name='search']").keypress(function(e) {
    if (e.which === 13) {
        $("#search_btn").click();
    }
});

$("input[name='search']").focus(function() {
    $('#search_term, #search_btn').css('border-color', '#9b26af');
    $('#search_term, #search_btn').hover(function() {
        $('#search_term, #search_btn').css('border-color', '#9b26af');
    }, function() {
        $('#search_term, #search_btn').css('border-color', '#9b26af');
    });
});

$("input[name='search']").blur(function() {
    $('#search_term, #search_btn').css('border-color', '#444');
    $('#search_term, #search_btn').hover(function() {
        $('#search_term, #search_btn').css('border-color', '#9b26af');
    }, function() {
        $('#search_term, #search_btn').css('border-color', '#444');
    });
});

$('.delete_btn, .sp_delete_btn').click(function() {
    var id = $(this).attr('data-id');
    $("#confirm_popup").show();
    $("#yes_delete_btn").click(function() {
        $("#delete"+id).submit();
    });
    $("#cancel_delete_btn").click(function() {
        $("#confirm_popup").hide();
        $("#yes_delete_btn").unbind();
    });
    $("#confirm_popup").click(function() {
        $("#confirm_popup").hide();
        $("#yes_delete_btn").unbind();
    });
});

$("#footer_arrow_img").click(function() {
    $('html, body').animate({
        scrollTop: $('body').offset().top
    }, 500);
});

var genreCount = 1;

$("#add_genre").click(function(e) {
    e.preventDefault();
    $("#remove_genre").show();
    if (genreCount < 3) {
        genreCount += 1;
        $('<select name="genre'+genreCount+'" required><option disabled selected value>Select genre ...</option><option value="Action">Action</option><option value="Adventure">Adventure</option><option value="Animation">Animation</option><option value="Biography">Biography</option><option value="Comedy">Comedy</option><option value="Crime">Crime</option><option value="Documentary">Documentary</option><option value="Drama">Drama</option><option value="Family">Family</option><option value="Fantasy">Fantasy</option><option value="History">History</option><option value="Horror">Horror</option><option value="Music">Music</option><option value="Mystery">Mystery</option><option value="Romance">Romance</option><option value="Sci-Fi">Sci-Fi</option><option value="Sport">Sport</option><option value="Thriller">Thriller</option><option value="War">War</option><option value="Western">Western</option></select>').insertBefore('#remove_genre');
    }
    if (genreCount === 3) {
        $("#add_genre").hide();
    }
});

$("#remove_genre").click(function(e) {
    e.preventDefault();
    if (genreCount > 1) {
        $('select[name="genre'+genreCount+'"]').remove();
        genreCount -= 1;
    }
    $("#add_genre").show();
    
    if (genreCount === 1) {
        $("#remove_genre").hide();
    }
});

var editGenreCount = 0;

$(document).ready(function() {
    
    $("#profile_options_dropdown").css("top", $("#header").outerHeight());
    
    var hrWidth = $(".single_post_hr").outerWidth();
    $(".single_review_user_info").css("width", hrWidth);
    
    $(".genres_toggle").css("height", $(".genres_options").outerHeight());
    
    if ($('select[name=genre]').val()) {
        if ($('select[name=genre2]').val()) {
            if($('select[name=genre3]').val()) {
                editGenreCount = 3;
            } else {
                editGenreCount = 2;
            }
        } else{
            editGenreCount = 1;
        }
    }
    
    if (editGenreCount > 0) {
        console.log(editGenreCount);
        switch (editGenreCount) {
            case 1: 
                $("#edit_add_genre").show();
                break;
            case 2: 
                $("#edit_remove_genre, #edit_add_genre").show();
                break;
            case 3:
                $("#edit_remove_genre").show();
                break;
        }
    }
    
    $("#edit_add_genre").click(function(e) {
        e.preventDefault();
        $("#edit_remove_genre").show();
        if (editGenreCount < 3) {
            editGenreCount += 1;
            $('<select name="genre'+editGenreCount+'" required><option disabled selected value>Select genre ...</option><option value="Action">Action</option><option value="Adventure">Adventure</option><option value="Animation">Animation</option><option value="Biography">Biography</option><option value="Comedy">Comedy</option><option value="Crime">Crime</option><option value="Documentary">Documentary</option><option value="Drama">Drama</option><option value="Family">Family</option><option value="Fantasy">Fantasy</option><option value="History">History</option><option value="Horror">Horror</option><option value="Music">Music</option><option value="Mystery">Mystery</option><option value="Romance">Romance</option><option value="Sci-Fi">Sci-Fi</option><option value="Sport">Sport</option><option value="Thriller">Thriller</option><option value="War">War</option><option value="Western">Western</option></select>').insertBefore('#edit_remove_genre');
        }
        if (editGenreCount === 3) {
            $("#edit_add_genre").hide();
        }
    });
    
    $("#edit_remove_genre").click(function(e) {
        e.preventDefault();
        if (editGenreCount > 1) {
            $('select[name="genre'+editGenreCount+'"]').remove();
            editGenreCount -= 1;
        }
        $("#edit_add_genre").show();
        
        if (editGenreCount === 1) {
            $("#edit_remove_genre").hide();
        }
    });
});