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
                    <button id="saveFlowButton" type="button" class="btn btn-primary" ng-click="saveFlow()">Guardar</button>
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
                        <div class="pull-right">
                            <button ng-click="stepModal(step)" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Editar paso"><i class="fa fa-pencil"></i></button>
                            <button ng-click="deleteStep(step.id)" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar paso"><i class="fa fa-trash"></i></button>
                            <button ng-click="transitionModal(step.id)" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Agregar transición"><i class="fa fa-plus"></i></button>
                        </div>
                        <strong>@{{ step.name }}</strong><br />
                        <p>@{{ step.description }}</p>
                        <span class="text-muted">Transiciones:</span><br />
                        <span class="text-blue" ng-if="step.total_transitions == 0">Este paso no tiene transiciones</span>
                        <ul class="list">
                            <div ng-repeat="transition in step.transitions.data">
                                <li class="list-item">
                                    -> @{{ transition.to.data.name }} - <a ng-click="deleteTransition(transition.id)">Eliminar transición</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3>Representación gráfica del flujo</h3>
                </div>
                <div class="box-body">
                    <div id="jsplump" style="position: relative">

                    </div>
                </div>
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
    <div class="modal fade" id="transitionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@{{ operationWithTransition }} transición</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>A que paso desea direccionar la transición?</label>
                        <select class="form-control" ng-model="transitionForm.to" ng-select="transitionForm.to">
                            <option ng-repeat="step in steps | filter: { id: '!' + transitionForm.from }" value="@{{ step.id }}">@{{ step.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button id="saveTransition" type="button" class="btn btn-primary" data-loading-text="Guardando" ng-click="saveTransition()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>