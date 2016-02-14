<div class="row">
    <div class="col-md-6">
        {!! Field::text('default', ['label' => 'Texto por defecto', 'ng-model' => 'form.default']) !!}
    </div>
    <div class="col-md-6">
        {!! Field::select('required', ['1' => 'Si', '0' => 'No'], ['label' => 'Es requerido?', 'class' => 'select2', 'ng-model' => 'form.required']) !!}
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-6">
        <h4>Opciones</h4>
        <p>Ingresa aca las opciones disponibles para la lista desplegable</p>
        {!! Field::text('option_name', ['label' => 'Opción', 'ng-model' => 'optionToAdd']) !!}
        <button ng-click="addOption()" type="button" class="btn btn-default">Guardar</button>
    </div>
    <div class="col-md-6">
        <ul class="list-group">
            <li class="list-group-item" ng-repeat="option in form.options">
                <div class="row">
                    <div class="col-md-9">@{{ option }}</div>
                    <div class="col-md-3 text-right">
                        <button class="btn btn-xs btn-danger" ng-click="removeItem($index)"><i class="fa fa-times"></i></button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<hr />