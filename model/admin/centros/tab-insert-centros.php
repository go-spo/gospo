<?php ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Añadir centros</h4>
                <p class="category">Completa los campos</p>
            </div>
            <div class="card-content">

                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group label-floating">
                            <label class="control-label">ID</label>
                            <input type="text" id="id-insert-centro" class="form-control" value="null" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre</label>
                            <input type="text" name="nombre-insert-centro" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group label-floating">
                            <label class="control-label">Teléfono</label>
                            <input type="text" name="telefono-insert-centro" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group label-floating">
                            <label class="control-label">Email</label>
                            <input type="email" name="email-insert-centro" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group label-floating">
                            <label class="control-label">Dirección</label>
                            <input type="text" name="direccion-insert-centro" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group label-floating">
                            <label class="control-label">Municipio</label>
                            <input type="text" name="municipio-insert-centro" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group label-floating">
                            <label class="control-label">Provincia</label>
                            <input  list="provincias" name="provincia-insert-centro" class="form-control">
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
                            <input type="text" name="pais-insert-centro" value="España" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <br>
                        <div class="file_input_div">
                            <div class="file_input">
                                <label class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored">
                                    <i class="material-icons icon-image-insert" data-background-color="red"  >file_upload</i>
                                    <input  name="file_input_img_div" id="file_input_file" class="none" type="file" />
                                </label>
                            </div>
                            <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
                                <input name="file_input_text_div" class="file_input_text mdl-textfield__input" type="text" disabled readonly id="file_input_text" />
                                <label class="mdl-textfield__label" for="file_input_text"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <button  id='btn-insert-centros' class="btn btn-primary btn-info pull-right">Insertar</button>

            </div>
        </div>
    </div>
</div>

