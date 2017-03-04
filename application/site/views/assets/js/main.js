ddsmoothmenu.init({
    mainmenuid: "top_nav", //menu DIV id
    orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
    classname: 'ddsmoothmenu', //class added to menu's outer DIV
    //customtheme: ["#1c5a80", "#18374a"],
    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});

$(window).load(function() {
    $('#slider').nivoSlider();
});

$(function() {
    $.ajaxSetup({
        dataType: 'json'
    });

    $(document).ajaxSuccess(function(event, xhr, setting, json) {
        if (json.status == 'error') {
            alert(json.message);
        }
    });

    $('a.addtocart').click(function(event) {
        $.ajax({
            url: $(this).attr('href'),
            success: function(json) {
                if (json.status == 'success') {
                    $('#cart-count').text(json.count + ' items');
                }
            }
        });

        event.preventDefault();
    });

    $('input.cart-quantity').change(function() {
        var $input = $(this);

        $.ajax({
            url: $(this).data('url'),
            data: {
                quantity: $(this).val()
            },
            success: function(json) {
                if (json.status == 'success') {
                    $input.parent().next().text(json.price).next().text(json.total);
                    $('#cart-total').text(json.cartTotal);
                }

            }
        });
    })

    $('a.cart-remove').click(function(event) {
        var $a = $(this);

        $.ajax({
            url: $(this).attr('href'),
            success: function(json) {
                if (json.status == 'success') {
                    $a.parents('tr:first').remove();
                    $('#cart-total').text(json.cartTotal);
                }
            }
        });
    })
});

