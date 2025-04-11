@extends('components.app', ['title' => 'Verifikasi Pengajuan'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.pengajuan.hasil-survei', $pengajuan->id) }}" class="btn btn-info"
                        target="_blank"><i class="fas fa-file-pdf"></i> Hasil Survei</a>
                </div>
                <div class="card-body">
                    <form action="">

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
