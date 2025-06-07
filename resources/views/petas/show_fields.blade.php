<!-- Nomor Field -->
<div class="col-sm-12">
    {!! Form::label('nomor', 'Nomor:') !!} {{ $peta->nomor }}
    <p>Nama Tempat = {{ $peta->keterangan }}</p>
    <p>Jenis Lokasi = {{ $peta->jenis_lokasi }}</p>
    <p>Titik koordinasi X={{ $peta->x }}</p>
    <p>Titik koordinasi Y={{ $peta->y }}</p>
</div>
<div class="col-sm-12">
    <h5>Keterangan:</h5>
    <p>{{ $peta->detail }}</p>
</div>
