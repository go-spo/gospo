<script>
    $('#volver-resultados-centros').click(function () {
        $('.left_inner').resizable();
        $("#content_sidebar").empty("");
        $("#content_sidebar").append('<h2 clas="conten_sidebar_title">Resultados</h2>' +
                '<div><input type="search" class="form-control" id="input-search" placeholder="Filtrar..." >' +
                '</div><!-- LAS TARJETAS DE BUSQUEDA -->' +
                '<div id="center-result" class="searchable-container">' +
                resultados +
                '</div>');
        $('#input-search').on('keyup', function () {
            var rex = new RegExp($(this).val(), 'i');
            $('.searchable-container .item-card').hide();
            $('.searchable-container .item-card').filter(function () {
                return rex.test($(this).text());
            }).show();
        });
    });
</script>