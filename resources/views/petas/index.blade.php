@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Petas</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right" href="{{ route('petas.create') }}">
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('petas.table')

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div id="map" style="height: 500px; margin-top: 50px"></div>
        <script>
            var lokasiSaya = localStorage.getItem('lokasiSaya');
            if (!lokasiSaya) {
                lokasiSaya = [-0.551689, 117.117];
            } else {
                lokasiSaya = JSON.parse(lokasiSaya); // Parse string JSON menjadi array
            }

            var osmUrl = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                osmAttrib = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                osm = L.tileLayer(osmUrl, {
                    maxZoom: 18,
                    attribution: osmAttrib
                });

            var map = L.map('map').setView(lokasiSaya, 17).addLayer(osm);

            map.attributionControl.setPrefix(false);

            var ikonMerah = L.icon({
                iconUrl: '{{ asset('leaflet (1)/images/redlokasi.png') }}', // ganti dengan URL ikon merah Anda
                iconSize: [25, 60],
                iconAnchor: [12, 41],
                popupAnchor: [0, -30]
            });

            var marker = new L.marker(lokasiSaya, {
                draggable: true,
                icon: ikonMerah
            }).addTo(map);

            marker.on('dragend', function(event) {
                var posisi = marker.getLatLng();
                marker.setLatLng(posisi, {
                    draggable: true
                }).bindPopup(posisi.toString()).openPopup();
                // Update koordinat pada input field
                document.getElementById("x").value = posisi.lat;
                document.getElementById("y").value = posisi.lng;

                lokasiSaya = [posisi.lat, posisi.lng]; // Perbarui lokasiSaya dengan nilai baru
                localStorage.setItem('lokasiSaya', JSON.stringify(lokasiSaya));
            });

            $("#x, #y").change(function() {
                var posisi = [parseFloat($("#x").val()), parseFloat($("#y").val())];
                marker.setLatLng(posisi, {
                    draggable: true
                }).bindPopup(posisi.toString()).openPopup();
                map.panTo(posisi);

                lokasiSaya = posisi; // Perbarui lokasiSaya dengan nilai baru
                localStorage.setItem('lokasiSaya', JSON.stringify(lokasiSaya));
            });

            map.addLayer(marker);

            var jenisIkon = {
                'Wisata': '{{ asset('leaflet (1)/images/wisata.png') }}',
                'Penginapan': '{{ asset('leaflet (1)/images/penginapan.png') }}',
                'Tempat Makan': '{{ asset('leaflet (1)/images/tempatmakan.png') }}',
                'Halte Bus': '{{ asset('leaflet (1)/images/bus.png') }}',
                'Bank': '{{ asset('leaflet (1)/images/bank.png') }}',
                'Masjid': '{{ asset('leaflet (1)/images/masjid.png') }}',
            };

            var data = [
                @foreach ($petas as $key => $value)
                {
                    "lokasi": [{{ $value->x }}, {{ $value->y }}],
                    "Nomor": "{{ $value->nomor }}",
                    "Nama Tempat": "{{ $value->keterangan }}",
                    "buttonHTML": "<button class='btn btn-info' onclick='keSini({{ $value->x }}, {{ $value->y }})'>KeSini</button>"
                },
                @endforeach
            ];

            @foreach ($petas as $key => $value)
                var jenisLokasi = '{{ $value->jenis_lokasi }}';
                var ikonLokasi = jenisIkon[jenisLokasi];

                var marker = L.marker([{{ $value->x }}, {{ $value->y }}], { icon: L.icon({ iconUrl: ikonLokasi, iconSize: [32, 32] }) });
                marker.bindPopup('{{ $value->keterangan }}');
                map.addLayer(marker);
            @endforeach

            @foreach ($petas as $key => $value)
            L.marker([{{ $value->x }}, {{ $value->y }}])
                .addTo(map)
                .bindPopup(`{{ $value->keterangan }}<br><button class='btn btn-info' onclick='keSini({{ $value->x }}, {{ $value->y }})'>KeSini</button>`);
            @endforeach

            // script menampilkan heat map
            var heat = L.heatLayer([
                @foreach ($petas as $key => $value) [{{ $value->x }}, {{ $value->y }}, 20], // lat, lng, intensity
                @endforeach
            ], {
                radius: 20
            }).addTo(map);

            // layer contain searched elements
            var markersLayer = new L.LayerGroup();
            map.addLayer(markersLayer);

            map.addControl(new L.Control.Search({
                layer: markersLayer,
                initial: false,
                zoom: 18,
                collapsed: true
            }));

            for (i in data) {
                var title = data[i]["Nama Tempat"], // value searched
                    loc = data[i].lokasi, // position found
                    marker = new L.Marker(new L.latLng(loc), {
                        title: title
                    }); // set property searched
                marker.bindPopup(keterangan);
                markersLayer.addLayer(marker);
            }

            var control = null;

            function keSini(lat, lng) {
                if (control != null) {
                    map.removeControl(control);
                }
                control = L.Routing.control({
                    waypoints: [
                        L.latLng(lokasiSaya[0], lokasiSaya[1]), // Titik awal dari lokasi saya
                        L.latLng(lat, lng)  // Titik akhir dari lokasi data yang diklik
                    ],
                    routeWhileDragging: true,
                    createMarker: function(i, waypoint, n) {
                        var icon = ikonMerah; // Menggunakan ikon merah sebagai default

                        // Jika ini adalah titik kedua (titik tujuan), gunakan ikon default
                        if (i === 1) {
                            icon = L.Icon.Default.icon;
                        }

                        return L.marker(waypoint.latLng, {
                            draggable: true,
                            icon: icon
                        }).bindPopup('Lokasi ' + (i + 1));
                    },
                    lineOptions: {
                        styles: [{color: 'blue', opacity: 0.4, weight: 7}]
                    },
                    show: true,
                    autoRoute: true
                }).addTo(map);

                control.on('routesfound', function(e) {
                    console.log('Routes found'); // Tambahkan log ini untuk memastikan event listener bekerja
                    var routes = e.routes;
                    var summary = routes[0].summary;
                    var instructions = document.getElementById('directions'); // Menampilkan petunjuk arah pada elemen yang ditentukan
                    instructions.innerHTML = `<b>Total distance:</b> ${summary.totalDistance} meters<br/><b>Total time:</b> ${Math.round(summary.totalTime / 60)} minutes`;
                });

                var control = L.Routing.control({
                waypoints: [
                    L.latLng(data[0].lokasi[0], data[0].lokasi[1]), // Titik awal (X)
                    L.latLng(data[1].lokasi[0], data[1].lokasi[1])  // Titik akhir (Y)
                ],
                routeWhileDragging: true
            }).addTo(map);

            // Tambahkan interaksi klik untuk menambah waypoint
            map.on('click', function(e) {
                var waypoint = L.latLng(e.latlng.lat, e.latlng.lng);
                control.spliceWaypoints(control.getWaypoints().length - 1, 0, waypoint);
            });
            }
        </script>
    </div>
@endsection
