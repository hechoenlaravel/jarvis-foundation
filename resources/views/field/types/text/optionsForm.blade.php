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
        {!! Field::select('transform', ['1' => 'Todo Mayusculas', '2' => 'Todo Minusculas', '3' => 'Capitalizado'], ['label' => 'Formato', 'class' => 'select2', 'ng-model' => 'form.options[0].transform']) !!}
    </div>
</div>