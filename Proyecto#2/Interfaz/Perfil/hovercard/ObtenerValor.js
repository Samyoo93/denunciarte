$(function(){
    $('.btnReview').click(function(){
        var url = "pasarValorALaBase.php";
        $.ajax({
            type: "POST",
            url: url,
            data:
                data1: $('.estrellas').rateit('value')
            },
            success: function (data) {
                console.log(data);

            }

        });

    });

});
