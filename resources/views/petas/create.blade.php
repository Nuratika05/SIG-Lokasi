@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Buat Peta</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'petas.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('petas.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('petas.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
        <div id="map" style="height: 500px; margin-top: 50px"></div>
<script>
var curLocation = [0, 0];
if (curLocation[0] === 0 && curLocation[1] === 0) {
    curLocation = [-0.551638, 117.11799];
}

var osmUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    osmAttrib = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });

var map = L.map('map').setView([-0.551638, 117.11799], 17).addLayer(osm);

map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {
    draggable: true
});

marker.on('dragend', function(event) {
    var position = marker.getLatLng();
    marker.setLatLng(position, {
        draggable: true
    }).bindPopup(position.toString()).openPopup();
    //id (longitude atau latitude) pada blade html akan dikenali sebagai identitas tempat untuk menempatkan hasil marker pada peta
    $("#x").val(position.lat);
    $("#y").val(position.lng).trigger('keyup');
});

//Nilai longitude dan latitude berubah seiring berubahnya posisi marker
$("#x, #y").change(function() {
    var position = [parseFloat($("#x").val()), parseFloat($("#y").val())];
    marker.setLatLng(position, {
        draggable: true
    }).bindPopup(position.toString()).openPopup();
    map.panTo(position);
});
map.addLayer(marker);



</script>
    </div>
@endsection
