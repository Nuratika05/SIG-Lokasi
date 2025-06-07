@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jenis Lokasi</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right" href="{{ route('JenisLokasi.create') }}">
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
                <div class="table-responsive">
                    <table class="table" id="petas-table">
                        <thead>
                        <tr>
                        <th>Jenis Lokasi</th>
                        <th>Ikon</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jenisLokasi as $peta)
                            <tr>
                            <td>{{ $peta->nama }}</td>
                            <td><img src="{{ asset('leaflet (1)/images/' . $peta->ikon) }}" class="rounded img-fluid" width="32px" height="32px">
                            </td>
                                <td width="120">
                                    {!! Form::open(['route' => ['JenisLokasi.destroy', $peta->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        <a href="{{ route('JenisLokasi.edit', [$peta->id]) }}"
                                           class='btn btn-default btn-xs'>
                                            <i class="far fa-edit"></i>
                                        </a>
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
