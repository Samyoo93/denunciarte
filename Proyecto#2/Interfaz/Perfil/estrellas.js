$(function () {
    'use strict';
    $("#estrellas").bind('rated',
        function (event, value) {
            $('.numCalf').val($('#estrellas').rateit('value'));
        });
});
