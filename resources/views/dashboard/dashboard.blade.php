@extends('components.app', ['title' => 'Dashboard'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h5>Dashboard</h5>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            @if (auth()->user()->role === 'nasabah' && empty(auth()->user()->nasabah))
                swal.fire({
                    title: 'Peringatan',
                    text: 'Silahkan lengkapi data profile anda terlebih dahulu',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('nasabah.profile') }}";
                    }
                });
            @endif
        });
    </script>
@endpush
