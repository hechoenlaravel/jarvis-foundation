<div class="" ng-controller="createFieldController">
    <div class="row">
        <div class="col-md-6">
            {!! Field::text('name', ['label' => 'Nombre', 'ng-model' => 'form.name']) !!}
        </div>
        <div class="col-md-6">
            {!! Field::hidden('type', null , ['ng-model' => 'form.type']) !!}
            <div class="form-group">
                <label>Tipo</label>
                <br />
                <strong>@{{ form.fieldType.name }}</strong> - <i>No puedes cambiar el tipo de campo una vez creado.</i>
            </div>
        </div>
    </div>
    {!! $fieldAssignmentForm !!}
    <div class="row">
        <div class="col-md-12">
            {!! Field::textarea('description', ['label' => 'Descripción', 'ng-model' => 'form.description']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-block', 'ng-click' => 'editField()']) !!}
        </div>
    </div>
</div>
<script>
    window.returnUrl = "{{$returnUrl}}";
</script>