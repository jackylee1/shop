require('jquery-zoom');

$(document).ready(function(){
    $(".zoom").zoom({
        on: 'click'
    });

    $(".review-reply-btn").click(function () {
        let reviewId = $(this).attr('data-review-id');

        $(".reply-review-form input[name=parent_id]").val(reviewId);

        $([document.documentElement, document.body]).animate({
            scrollTop: $(".reply-review-form").offset().top
        }, 1000);
    });
});