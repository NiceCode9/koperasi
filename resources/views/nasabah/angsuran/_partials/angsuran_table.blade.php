<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr class="bg-light">
                <th>No</th>
                <th>Nomor Angsuran</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($angsurans as $angsuran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $angsuran->nomor_angsuran }}</td>
                    <td>{{ Carbon\Carbon::parse($angsuran->tanggal_jatuh_tempo)->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge {{ $angsuran->status === 'paid' ? 'bg-success' : 'bg-danger' }}">
                            {{ $angsuran->status === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($angsuran->jumlah_angsuran, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($angsurans instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $angsurans->links() }}
    @endif
</div>
