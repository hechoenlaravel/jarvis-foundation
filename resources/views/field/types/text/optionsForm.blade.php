<div class="row">
    <div class="col-md-6">
        {!! Field::text('default', ['label' => 'Texto por defecto', 'ng-model' => 'form.default']) !!}
    </div>
    <div class="col-md-6">
        {!! Field::select('required', ['1' => 'Si', '0' => 'No'], ['label' => 'Es requerido?', 'class' => 'select2', 'ng-model' => 'form.required']) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! Field::select('transform', ['1' => 'Mayusculas', '2' => 'Minusculas'], ['label' => 'Formato', 'class' => 'select2', 'ng-model' => 'form.required']) !!}
    </div>
</div>