<?php ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="red">
                <h4 class="title">ZONA DE PELIGRO</h4>
                <p class="category">Eliminar centro
                </p>
            </div>
            <div class="card-content">
                <div class="card-content table-responsive card-content-delete">
                    <br>
                    <h4>Para eliminar un centro seleccionelo en  
                        <a href="#ver-centros" data-toggle="tab" rel="tooltip">
                            <i>ver centros</i>
                        </a>
                    </h4>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <!-- ====================== MODALS DELETE CONFIRM ======================== -->

    <div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <b>¿ESTA SEGURO?</b>
                </div>
                <div id="leyeneda-reservas-chart" class="modal-body">
                    <p>¿Desea elminar de la base de datos el centro seleccionado?</p><hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="center-delete" class="btn btn-danger" data-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
