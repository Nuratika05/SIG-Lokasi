@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Jenis Lokasi</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            <form action="{{ route('JenisLokasi.update', $jenisLokasi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        @include('JenisLokasi.fields')
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('JenisLokasi.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </form>
        </div>
    </div>
</div>
@endsection
