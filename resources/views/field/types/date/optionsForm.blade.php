<div class="row">
    <div class="col-md-6">
        {!! Field::text('default', ['label' => 'Fecha por defecto', 'ng-model' => 'form.default', 'class' => 'datepicker']) !!}
    </div>
    <div class="col-md-6">
        {!! Field::select('required', ['1' => 'Si', '0' => 'No'], ['label' => 'Es requerido?', 'class' => 'select2', 'ng-model' => 'form.required']) !!}
    </div>
</div>
<script>
    $(function(){
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            format: 'MM/DD/YYYY',
            locale : window.dateRangeLocale
        });
    });
</script>