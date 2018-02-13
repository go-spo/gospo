<?php ?>
<script>
    $(document).ready(function () {

        var id = <?php echo $_SESSION["id_user"] ?>;
        carga();
        function carga() {
            $.ajax({
                url: 'http://localhost/gospo/vendor/GospoAPI/usuario/' + id,
                dataType: 'json',
                type: 'GET',
                success: function (user) {
                    $("#User-welcome").html(user[0].nombre);
                }
            });
        }
    });

</script>