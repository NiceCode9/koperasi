<x-layout>
    <div class="container">
        <h2 class="text-center fw-bold judul-profil">Simulasi Peminjaman</h2>

        <div class="row justify-content-center mb-5">
            <div class="col-md-10">
                {{-- <form action="" method="POST"> --}}
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Pinjaman</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" min="1000000" required>
                </div>
                <div class="mb-3">
                    <label for="bulan" class="form-label">Jangka Waktu (bulan)</label>
                    <select name="bulan" id="bulan" class="form-control" required>
                        <option value="3">3 Bulan</option>
                        <option value="12">12 Bulan</option>
                        <option value="24">24 Bulan</option>
                        <option value="36">36 Bulan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button class="btn btn-success" type="button">Hitung</button>
                </div>
                {{-- </form> --}}
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-info mb-3" role="alert">
                    <strong>Perhatian!</strong> Bunga yang dikenakan sebesar 2% per bulan.
                </div>

                <div class="mb-3">
                    <p id="total"></p>
                    <p id="waktu"></p>
                    <p id="angsuranPokok"></p>
                    <p id="angsuranBungaPerbulan"></p>
                    <p id="totalAngsuran"></p>
                </div>

                <table class="table table-bordered" id="table-angsuran">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Angsuran Pokok</th>
                            <th>Angsuran Bunga</th>
                            <th>Total Angsuran</th>
                            <th>Sisa Pinjaman</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('button').on('click', function() {
                    let table = $('#table-angsuran tbody');
                    table.html('');
                    let jumlah = $('#jumlah').val();
                    let bulan = $('#bulan').val();
                    let bunga = 0.02;
                    let html = '';

                    if (jumlah < 1000000) {
                        alert('Minimal pinjaman adalah Rp 1.000.000');
                        return;
                    }

                    let angsuranPokok = jumlah / bulan;
                    let angsuranBungaPerbulan = angsuranPokok * bunga;
                    let totalBunga = angsuranBungaPerbulan * bulan;

                    let totalAngsuran = angsuranPokok + angsuranBungaPerbulan;
                    let totalPinjaman = parseInt(jumlah) + parseInt(totalBunga);

                    const formatRupiah = (angka) => {
                        return new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(angka);
                    };

                    for (let i = 0; i < bulan; i++) {
                        html += `
                                <tr>
                                    <td>${i + 1}</td>
                                    <td>${formatRupiah(parseInt(angsuranPokok))}</td>
                                    <td>${formatRupiah(parseInt(angsuranBungaPerbulan))}</td>
                                    <td>${formatRupiah(totalAngsuran)}</td>
                                    <td>${formatRupiah(totalPinjaman - (angsuranPokok + angsuranBungaPerbulan) * (i + 1))}</td>
                                </tr>
                            `;
                        // html += `
                //     <tr>
                //         <td>${i + 1}</td>
                //         <td>${formatRupiah(angsuranPokok)}</td>
                //         <td>${formatRupiah(angsuranBungaPerbulan)}</td>
                //         <td>${formatRupiah(totalAngsuran)}</td>
                //         <td>${formatRupiah(jumlah - angsuranPokok * (i + 1))}</td>
                //     </tr>
                // `;
                    }

                    $('#total').text('Total Pinjaman' + formatRupiah(totalPinjaman));
                    $('#waktu').text(bulan + ' bulan');
                    $('#angsuranPokok').text('Angsuran Pokok: ' + formatRupiah(angsuranPokok));
                    $('#angsuranBungaPerbulan').text('Angsuran Bunga: ' + formatRupiah(angsuranBungaPerbulan));
                    $('#totalAngsuran').text('Total Angsuran: ' + formatRupiah(totalAngsuran));
                    table.html(html);
                });
            });
        </script>
    @endpush
</x-layout>
