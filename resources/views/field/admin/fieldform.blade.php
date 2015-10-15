<div class="" ng-controller="createFieldController">
    <div class="row">
        <div class="col-md-6">
            {!! Field::text('name', ['label' => 'Nombre', 'ng-model' => 'form.name']) !!}
        </div>
        <div class="col-md-6">
            {!! Field::select('type', $types, ['label' => 'Tipo', 'class' => 'select2', 'ng-model' => 'form.type', 'ng-change' => 'getFieldDetails()']) !!}
        </div>
    </div>
    <div compile="formOptions"></div>
    <div class="row">
        <div class="col-md-12">
            {!! Field::textarea('description', ['label' => 'Descripción', 'ng-model' => 'form.description']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-block', 'ng-click' => 'createField()']) !!}
        </div>
    </div>
</div>
<script>
    window.returnUrl = "{{$returnUrl}}";
</script>