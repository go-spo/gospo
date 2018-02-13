<?php ?>

<div class="tab-pane active" id="ver-centros">
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="card-header row" data-background-color="green">
                <div class="col-md-3">
                <h4 class="title">Centros registrados</h4>
                </div>
                <div class="col-md-4">
                    <input type="search" class="is-focused" id="input-search" placeholder="Filtrar..." ><span></span>
                </div>
            </div>
            <div class="card-content table-responsive">
                <table id="ver-centros-table" class="table table-hover">
                    <thead class="text-success">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Municipio</th>
                    <th>Provincia</th>
                    <th>País</th>
                    </thead>
                    <tbody id="center-table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>