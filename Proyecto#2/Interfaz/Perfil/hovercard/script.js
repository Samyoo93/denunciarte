$(function () {
    'use strict';
    $(".pruebaReview a[href]").qtip({
       content: {
            text: $('.pruebaReview').next('.review')
        },
        style: {
            classes: 'qtip-light qtip-rounded',
            width: 650,
            height: 174

        }
    });
});
