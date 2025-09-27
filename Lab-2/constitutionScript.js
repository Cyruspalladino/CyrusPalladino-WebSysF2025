$(document).ready(function() {
    $('.article-header').on('click', function() {
        $(this).closest('.article-box').toggleClass('active');
    });

    $('.section-header').on('click', function(e) {
        e.stopPropagation();
        $(this).closest('.section-box').toggleClass('active');
    });
});
