<input type="hidden" value="{{ $show_ID_Debt->id_hutang }}" name="id_hutang" id="id_hutang">
<input type="hidden" value="{{ $show_ID_Debt->catatan_saldo_hutang }}" name="hutang_nominal_lama">
<div class="form-group">
    <label for="client" class="col-form-label">Client :</label>
    <input type="txt" class="form-control" id="clientVal" name="hutang_clientVal"
        value="{{ $show_ID_Debt->hutang_client }}">
    <span style="color: red;font-size:12px" id="TextClientErrors"></span>
</div>
<div class="form-group">
    <label for="tgl" class="col-form-label">Tanggal :</label>
    <input type="date" class="form-control" id="tanggal"
        name="hutang_tanggal"value="{{ Carbon\Carbon::parse($show_ID_Debt->created_at)->format('Y-m-d') }}">
    <input type='checkbox' class="mt-3" data-toggle='collapse' data-target='#tempo'> Jatuh Tempo

</div>
<div id='tempo' class='collapse div1'>
    <div class="form-group">
        <label for="tempo" class="col-form-label">Jatuh Tempo :</label>
        <input type="date" class="form-control" id="tempo"
            name="hutang_jatuh"value="{{ Carbon\Carbon::parse($show_ID_Debt->jatuh_tempo_hutang)->format('Y-m-d') }}">
    </div>
</div>
<div class="form-group">
    <label for="deskripsi" class="col-form-label">Deskripsi :</label>
    <textarea class="form-control" id="deskripsiVal" name="hutang_deskripsi"
        value="{{ $show_ID_Debt->hutang_deskripsi }}">{{ ucfirst($show_ID_Debt->hutang_deskripsi) }}</textarea>
    <span style="color: red;font-size:12px" id="TextDeskripsiErrors"></span>
</div>
<div class="form-group">
    <label for="nominal" class="col-form-label">Nominal :</label>
    <input type="text" min="0" placeholder="0" class="form-control" onkeyup="changevalue()" id="rupiah_hutang"
        value="{{ $show_ID_Debt->catatan_saldo_hutang }}">
    <span style="color: red;font-size:12px" id="TextNominalErrors"></span>
    <input type="text" min="0" placeholder="0" class="form-control" id="rupiah_hutang1"
        value="{{ $show_ID_Debt->catatan_saldo_hutang }}" name="hutang_nominal" readonly>
</div>
{{-- CATAT SEBAGAI PEMASUKAN --}}
<div class="form-group">
    <label>Catat sebagai Pemasukan di Buku Kas ?</label>
    <select class="custom-select col-sm-3" style="color: black" id="selectON" name="selectedBuku"
        onchange="onSelect()">
        <option value="0">Tidak</option>
        <option value="1">Ya</option>
    </select>
    {{-- END --}}
</div>
<div id="pemasukan" style="display: none;">
    <div class="form-group">
        <label for="nominal" class="col-form-label">Buku Kas :</label>
        <Select class="form-control" name="id_kas" id="id_kasVal">
            <option value="{{ $show_ID_Debt->id_buku }}">{{ $show_ID_Debt->nama_buku_kas }}</option>
            <option value="{{ old('id_kas') }}">Pilih Buku Kas</option>
            @foreach ($all_cash_book as $buku_kas)
                <option value="{{ $buku_kas->id_kas }}">{{ ucwords($buku_kas->nama_buku_kas) }}</option>
            @endforeach
        </Select>
        <span style="color: red;font-size:12px" id="TextIdKasError"></span>
    </div>
    <div class="form-group">
        <label for="nominal" class="col-form-label">Kategori</label>
        <Select class="form-control" name="id_kategori" id="idKategori">
            <option value="{{ $IDdebt_noted_cash->id_kategori }}">{{ $IDdebt_noted_cash->nama_kategori }}</option>
            <option value="{{ old('id_kategori') }}">Pilih Buku Kas</option>
            @foreach ($all_category as $kat)
                @if ($kat->keterangan_kategori == 'Pemasukan' && 'pemasukan')
                    <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                @endif
            @endforeach
        </Select>
        <span style="color: red;font-size:12px" id="TextIdKategoriError"></span>
    </div>
</div>
<script>
    /* FUNGSI COLLAPSE CATATAN PEMASUKAN HUTANG */
    function onSelect() {
        var kategori = document.getElementById("selectON");
        var option_data = kategori.options[kategori.selectedIndex].value;
        if (option_data == '0') {
            var label = document.getElementById("pemasukan").setAttribute("style", "display: none;");
        } else {
            var label = document.getElementById("pemasukan").setAttribute("style", "display: block;");
        }
    }
    /* RUPIAH INDONESIA */
    var rupiah = document.getElementById('rupiah_hutang');
    rupiah.addEventListener('keyup', function(e) {
        rupiah.value = formatRupiah(this.value, ' ');
    });
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? ' ' + rupiah : '');
    }

    function changevalue() {
        var rupiah = document.getElementById('rupiah_hutang').value;
        var rupiahchange = rupiah.split(".").join("").split(" ").join("");
        document.getElementById('rupiah_hutang1').value = rupiahchange;
    }
</script>
