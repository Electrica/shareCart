$(document).ready(function () {
    $('#sharecart').on('click', function(e){
        e.preventDefault();

        $.ajax({
            method: 'POST',
            url: 'shareCart/assets/components/sharecart/action.php',
            data: {
                action: 'createCart'
            },
            success: function(link){
                $.jGrowl("Корзина сохранена", {
                    theme: 'ms2-message-success',
                    sticky: false
                });
                $('#getlink').html(link);
            }
        });

    });

    $('[data-id-sharecart]').on('click', function (e) {
        e.preventDefault();

        var id = $(this).data('id-sharecart');
        $.ajax({
            method: 'POST',
            url: 'shareCart/assets/components/sharecart/action.php',
            data: {
                id: id,
                action: 'deleteCart'
            },
            success: function(response){
                location.reload();
            }
        });

        return false;
    });
});