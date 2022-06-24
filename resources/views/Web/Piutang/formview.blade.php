<input type="hidden" value="{{ $show_ID_AccountsReceivable->id_piutang }}" name="id_piutang" id="id_piutang">
<input type="hidden" value="{{ $show_ID_AccountsReceivable->catatan_saldo_piutang }}" name="piutang_nominal_lama">
<div class="form-group">
    <label for="EditValclient" class="col-form-label">Client :</label>
    <input type="txt" class="form-control" id="EditValclient" name="piutang_client"
        value="{{ $show_ID_AccountsReceivable->piutang_client }}">
    <span style="color: red;font-size:12px" id="TextEditClientError"></span>
</div>
<div class="form-group">
    <label for="tgl" class="col-form-label">Tanggal :</label>
    <input type="date" class="form-control" id="tanggal"
        name="piutang_tanggal"value="{{ \Carbon\Carbon::parse($show_ID_AccountsReceivable->created_at)->locale('id')->format('Y-m-d') }}">
    <input type='checkbox' class="mt-3" data-toggle='collapse' data-target='#tempo'> Jatuh Tempo

</div>
<div id='tempo' class='collapse div1'>
    <div class="form-group">
        <label for="tempo" class="col-form-label">Jatuh Tempo :</label>
        <input type="date" class="form-control" id="tempo" name="piutang_jatuh"
            value="{{ Carbon\Carbon::parse($show_ID_AccountsReceivable->jatuh_tempo_piutang)->format('Y-m-d') }}">
    </div>
</div>
<div class="form-group">
    <label for="deskripsi" class="col-form-label">Deskripsi :</label>
    <textarea class="form-control" id="deskripsi" name="piutang_deskripsi"
        value="{{ $show_ID_AccountsReceivable->piutang_deskripsi }}">{{ $show_ID_AccountsReceivable->piutang_deskripsi }}</textarea>
    <span style="color: red;font-size:12px" id="TextEditDeskripsitError"></span>
</div>

<div class="form-group">
    <label for="nominal" class="col-form-label">Nominal :</label>
    <input type="text" min="0" class="form-control" id="piutangEdit" onkeyup="changevalue()"
        value="{{ $show_ID_AccountsReceivable->catatan_saldo_piutang }}">
    <span style="color: red;font-size:12px" id="TextEditPiutangtError"></span>
    <input type="text" min="0" class="form-control" name="piutang_nominal" id="piutangEdit1"
        value="{{ $show_ID_AccountsReceivable->catatan_saldo_piutang }}" hidden readonly>
</div>

{{-- CATAT SEBAGAI PENGELUARAN --}}
<div class="form-group">
    <label>Catat sebagai Pengeluaran di Buku Kas ?</label>
    <select class="custom-select col-sm-3" style="color: black" id="selectON" onchange="onSelect();"
        name="selectedBuku">
        <option value="0">Tidak</option>
        <option value="1">Ya</option>
    </select>
</div>
{{-- END --}}

<div id="pengeluaran1" style="display: none;">
    <div class="form-group">
        <label for="nominal"class="col-form-label">Buku Kas :</label>
        <Select class="form-control" name="id_kas" id="idKasPiutang">
            <option value="{{ $show_ID_AccountsReceivable->id_buku_kas }}">
                {{ $show_ID_AccountsReceivable->nama_buku_kas }}</option>
            <option value="{{ old('buku') }}">Pilih Buku Kas</option>
            @foreach ($all_cash_book as $buku_kas)
                <option value="{{ $buku_kas->id_kas }}">{{ ucwords($buku_kas->nama_buku_kas) }}</ option>
            @endforeach
        </Select>
        <span style="color: red;font-size:12px" id="TextEditBukuKastError"></span>
    </div>

    <div class="form-group">
        <label for="nominal" class="col-form-label">Kategori</label>
        <Select class="form-control" name="id_kategori" id="id_kategori">
            <option value="{{ $id_noted_piutang_book->id_kategori }}">{{ $id_noted_piutang_book->nama_kategori }}
            </option>
            <option value="{{ old('kategori') }}">---</option>
            @foreach ($all_category as $kat)
                <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
            @endforeach
        </Select>
        <span style="color: red;font-size:12px" id="TextEditKategoriPiutangError"></span>
    </div>
</div>
<script>
    /* FUNGSI COLLAPSE CATATAN  PENGELUARAN PIUTANG */
    function onSelect() {
        var kategori = document.getElementById("selectON");
        var option_data = kategori.options[kategori.selectedIndex].value;
        if (option_data == '0') {
            var label = document.getElementById("pengeluaran1").setAttribute("style", "display: none;");
        } else {
            var label = document.getElementById("pengeluaran1").setAttribute("style", "display: block;");
        }
    }
    /* END */

    var rupiah = document.getElementById('piutangEdit');
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
        var rupiah = document.getElementById('piutangEdit').value;
        var rupiahchange = rupiah.split(".").join("").split(" ").join("");
        document.getElementById('piutangEdit1').value = rupiahchange;

    }
    //
</script>
