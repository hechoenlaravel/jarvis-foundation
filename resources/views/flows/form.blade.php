<div ng-controller="flowController">

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    {!! Field::text('name', ['label' => 'Nombre del flujo', 'ng-model' => 'flowForm.name']) !!}
                    {!! Field::textarea('description', ['label' => 'Descripción del flujo', 'ng-model' => 'flowForm.description']) !!}
                    {!! Field::select('active',[0 => 'No', 1 => 'Si'], $flow->active, ['label' => 'Activo', 'ng-model' => 'flowForm.active', 'ng-if' => 'flow != null']) !!}
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
                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Crear Paso</a>
                    </div>
                </div>
                <div class="box-body">

                </div>
            </div>
        </div>
    </div>

</div>