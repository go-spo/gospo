<?php ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="" style="background-color: #7e57c2">
                <h4 class="title">Modificar centros</h4>
                <p class="category">Para activar los campos selecciona un centro en 
                    <a href="#ver-centros" data-toggle="tab" rel="tooltip">
                        <i>ver centros</i>
                    </a></p>
            </div>
            <div class="card-content">
                <form id="centros-update-form">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group label-floating">
                                <label class="control-label">ID</label>
                                <input type="text" class="form-control" name="id-update-centro" value="null" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre</label>
                                <input type="text" name="nombre-update-centro" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group label-floating">
                                <label class="control-label">Teléfono</label>
                                <input type="text" name="telefono-update-centro" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group label-floating">
                                <label class="control-label">Email</label>
                                <input type="email" name="email-update-centro" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group label-floating">
                                <label class="control-label">Dirección</label>
                                <input type="text" name="direccion-update-centro" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="control-label">Municipio</label>
                                <input type="text" name="municipio-update-centro" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="control-label">Provincia</label>
                                <input  list="provincias" name="provincia-update-centro" class="form-control" disabled>
                                <datalist  id="provincias">
                                    <option value="Valencia">
                                    <option value="Castellón">
                                    <option value="Alicante">
                                </datalist>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group label-floating">
                                <label class="control-label">País</label>
                                <input type="text" name="pais-update-centro" value="España" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default pull-right" style="background-color: #7e57c2">Insertar</button>
                </form>
            </div>
        </div>
    </div>
</div>