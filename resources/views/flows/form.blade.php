<div ng-controller="flowController" ng-init="getSteps()">

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    {!! Field::text('name', ['label' => 'Nombre del flujo', 'ng-model' => 'flowForm.name']) !!}
                    {!! Field::textarea('description', ['label' => 'Descripción del flujo', 'ng-model' => 'flowForm.description']) !!}
                    @if(!empty($flow->active))
                        {!! Field::select('active',[0 => 'No', 1 => 'Si'], $flow->active, ['label' => 'Activo', 'ng-model' => 'flowForm.active']) !!}
                    @endif
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-primary" ng-click="saveFlow()">Guardar</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-info" ng-if="flow == null">
                <p>Por favor ingrese la inforación de la caja izquierda y haga click en guardar</p>
            </div>
            <div class="box" ng-if="flow != null">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Pasos del flujo
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-sm btn-primary" ng-click="stepModal()"><i class="fa fa-plus"></i> Crear Paso</button>
                    </div>
                </div>
                <ul class="list-group box-boby">
                    <li class="list-group-item" ng-repeat="step in steps">
                        <strong>@{{ step.name }}</strong><br />
                        <p>@{{ step.description }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="modal fade" id="stepModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@{{ operationWithStep }} Paso</h4>
                </div>
                <div class="modal-body">
                    {!! Field::text('name', ['label' => 'Nombre del Paso', 'ng-model' => 'stepForm.name']) !!}
                    {!! Field::textarea('description', ['label' => 'Descripción del Paso', 'ng-model' => 'stepForm.description']) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="saveStep" type="button" class="btn btn-primary" data-loading-text="Guardando" ng-click="saveStep()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>