<?php ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="" style="background-color: #7e57c2">
                <h4 class="title">Modificar centros</h4>
                <p class="category">Rellene los campos a modificar</p>
            </div>
            <div class="card-content card-content-update">
                <br>
                <h4>Para modificar un centro seleccionelo en 
                    <a href="#ver-centros" data-toggle="tab" rel="tooltip">
                        <i style="color: #7e57c2">ver centros</i>
                    </a>
                </h4>
                <br>
            </div>
        </div>
    </div>
</div>


<!-- ====================== MODALS UPDATE CONFIRM ======================== -->

    <div class="modal fade" id="updateConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-update">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <b>¿ESTA SEGURO?</b>
                </div>
                <div id="leyeneda-reservas-chart" class="modal-body">
                    <p>¿Desea confirmar los cambios?</p><hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="center-update" class="btn btn-danger" data-dismiss="modal" style="background-color: #7e57c2">Confirmar</button>
                </div>
            </div>
        </div>
    </div>