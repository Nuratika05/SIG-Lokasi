<!-- Nomor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nomor', 'Nomor:') !!}
    {!! Form::text('nomor', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Nama Tempat:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('jenis_lokasi', 'Jenis Lokasi:') !!}
    <select class="form-control" name="jenis_lokasi">
        @foreach($jenisLokasi as $jenis)
            <option value="{{ $jenis->nama }}">{{ $jenis->nama }}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('detail', 'Keterangan:') !!}
    {!! Form::text('detail', null, ['class' => 'form-control']) !!}
</div>

<!-- X Field -->
<div class="form-group col-sm-6">
    {!! Form::label('x', 'X:') !!}
    {!! Form::text('x', null, ['class' => 'form-control' , 'id' =>
    'x', 'name' => 'x', 'value' => '{{ $petas->x }}']) !!}
</div>

<!-- Y Field -->
<div class="form-group col-sm-6">
    {!! Form::label('y', 'Y:') !!}
    {!! Form::text('y', null, ['class' => 'form-control' , 'id' =>
    'y', 'name' => 'y', 'value' => '{{ $petas->y }}']) !!}
</div>
