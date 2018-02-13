<?php ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Añadir deportes</h4>
                <p class="category">Completa los campos</p>
            </div>
            <div class="card-content">              
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre</label>
                            <input type="text" name="nombre-insert-deporte" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Descripción</label>
                            <input type="text" name="descripcion-insert-deporte" class="form-control">
                        </div>
                    </div>
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
                <button  id='btn-insert-deportes' class="btn btn-primary btn-info pull-right">Insertar</button>                     
            </div>

        </div>
    </div>
</div>


