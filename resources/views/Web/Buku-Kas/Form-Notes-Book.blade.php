<input type="hidden" value="{{ $id_noted_book->catatan_keterangan }}" name="keterangan">
<input type="hidden" value="{{ $id_noted_book->id_buku_kas }}" name="id_kas" id="id_kas">
<input type="hidden" value="{{ $id_noted_book->id_catatan }}" name="id_catatan" id="id_catatan">
<input type="hidden" value="{{ $id_noted_book->catatan_saldo_kas }}" name="catatan_jumlah_lama">
<div class="form-group">
    <label for="jam" class="col-form-label">Jam :</label>
    <input type="time" class="form-control" id="jam" name="catatan_jam"
        value="{{ Carbon\Carbon::parse($id_noted_book->created_at)->format('H:i') }}">
</div>
<div class="form-group">
    <label for="tanggal" class="col-form-label">Tanggal :</label>
    <input type="date" class="form-control" id="tanggal" name="catatan_tgl"
        value="{{ Carbon\Carbon::parse($id_noted_book->created_at)->format('Y-m-d') }}">
</div>

<div class="form-group">
    <label for="rupiah" class="col-form-label">Nominal :</label>
    <input type="text" min="0" placeholder="0" class="form-control" onkeyup="changevalue()" value="@currency($id_noted_book->catatan_saldo_kas)"
        id="rupiahCatatan">
    <span style="color: red;font-size:12px" id="nominalError"></span>
    <input type="text" min="0" placeholder="0" class="form-control" name="catatan_jumlah" id="rupiahCatatan1"
        value="{{ $id_noted_book->catatan_saldo_kas }}" readonly hidden>
</div>

</div>
<div class="form-group">
    <label for="kategori" class="col-form-label">Kategori :</label>
    <Select class="form-control" name="id_kategori" id="id_kategori">
        <option value="{{ $id_noted_book->id_kategori }}">{{ $id_noted_book->nama_kategori }}</option>
        @foreach ($kategori as $kat)
            @if ($kat->keterangan_kategori == $id_noted_book->catatan_keterangan)
                <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
            @elseif ($kat->keterangan_kategori == $id_noted_book->catatan_keterangan)
                <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
            @endif
        @endforeach
    </Select>
    <span style="color: red;font-size:12px" id="KategoriError"></span>
</div>
<div class="form-group">
    <label for="keterangan" class="col-form-label">Keterangan :</label>
    <textarea class="form-control" id="Keterangan" name="deskripsi" value="{{ $id_noted_book->deskripsi }}">{{ $id_noted_book->deskripsi }}</textarea>
    <span style="color: red;font-size:12px" id="KeteranganError"></span>
</div>
<script>
    /*================================ NOMINAL ====================================*/
    /* Fungsi formatRupiah */
    var rupiahCatatan = document.getElementById('rupiahCatatan');
    rupiahCatatan.addEventListener('keyup', function(e) {
        rupiahCatatan.value = formatRupiah(this.value, ' ');
    });
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),

            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? ' ' + rupiah : '');
    }

    function changevalue() {
        var rupiah = document.getElementById('rupiahCatatan').value;
        var rupiahchange = rupiah.split(".").join("").split(" ").join("");
        document.getElementById('rupiahCatatan1').value = rupiahchange;
    }
    /*================================ END NOMINAL ====================================*/
</script>
