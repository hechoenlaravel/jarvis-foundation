<div class="" ng-controller="createFieldController">
    <div class="row">
        <input type="hidden" name="returnUrl" value="{{$returnUrl}}" />
        <div class="col-md-6">
            {!! Field::text('name', ['label' => 'Nombre']) !!}
        </div>
        <div class="col-md-6">
            {!! Field::select('name', $types, ['label' => 'Tipo', 'class' => 'select2']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! Field::text('default', ['label' => 'Valor por defecto']) !!}
        </div>
        <div class="col-md-6">
            {!! Field::select('required', ['0' => 'No', '1' => 'Si'], [1],['label' => 'Es requerido?']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! Field::textarea('description', ['label' => 'Descripción']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-block']) !!}
        </div>
    </div>
</div>
@section('scripts')

@endsection