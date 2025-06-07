<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Jenis Lokasi:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('ikon', 'Ikon Lokasi:') !!}
        <input class="form-control" type="file"
        id="ikon" accept=".jpeg, .jpg, .png" name="ikon" required>
</div>
