<div class="form-row" id="hiddenNosurat">
    <div class="form-group col-md-6">
        <label for="inputAddress">No Surat</label>
        <input id="txt1" type="text" class="form-control " id="inputAddress" placeholder="" name="nomor_surat"
            value="{{ $nomor_surat }}" readonly>
    </div>
    <div class="form-group col-md-6">
        <label for="perihal">Perihal</label>
        <input id="txt1" type="text" class="form-control {{ $errors->has('perihal') ? ' is-invalid' : '' }}"
            id="perihal" placeholder="Perihal" name="perihal" value="{{ old('perihal') }}">
        @if ($errors->has('perihal'))
            <span class="text-danger">{{ $errors->first('perihal') }}</span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="nama">Nama Pelanggan</label>
        <select data-placeholder="Nama" data-allow-clear="1"
            class="form-control {{ $errors->has('id_customer') ? ' is-invalid' : '' }}" name="id_customer"
            id="nama" onchange="onSelect()">
            <option value=""></option>
            @if (count($customer) !== 0)
                @foreach ($customer as $pelanggan)
                    <option value="{{ $pelanggan->id_customer }}">{{ $pelanggan->name_customer }}</option>
                @endforeach
            @else
                <p>Tidak ada nama</p>
            @endif
        </select>
        @if ($errors->has('id_customer'))
            <span class="text-danger">{{ $errors->first('id_customer') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="email" name="email"
            value="{{ old('email') }}" readonly>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="perusahaan">Perusahaan</label>
        <input type="text" class="form-control" id="perusahaan" placeholder="Perusahaan" name="perusahaan"
            value="{{ old('telepon') }}" readonly>
    </div>
    <div class="form-group col-md-6">
        <label for="telepon">Telepon</label>
        <input type="text" class="form-control" id="telepon" placeholder="Telepon" name="telepon"
            value="{{ old('telepon') }}" readonly>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="dikirim">Tanggal Dikirim</label>
        <input type="date" class="form-control {{ $errors->has('dikirim') ? ' is-invalid' : '' }}" id="dikirim"
            name="dikirim">
        @if ($errors->has('dikirim'))
            <span class="text-danger">{{ $errors->first('dikirim') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="tempo">Tanggal Jatuh Tempo</label>
        <input type="date" class="form-control {{ $errors->has('tempo') ? ' is-invalid' : '' }}" id="tempo"
            name="tempo">
        @if ($errors->has('tempo'))
            <span class="text-danger">{{ $errors->first('tempo') }}</span>
        @endif
    </div>
</div>
<div class="container-fluid" style="margin:0 !important;padding:0 !important;">
    <div class="table-responsive mt-4 mb-5 ">
        <table class="table  table-bordered table-sm" id="POITable">
            <thead class="bg-light">
                <tr class="text-center text-dark">
                    <th>Nama Proyek</th>
                    <th>Biaya Proyek</th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody class="container1">
                <tr class="table-white ">
                    <td class="text-right ">
                        <input type="text" class="form-control" id="np1" placeholder="Nama Proyek"
                            name="np1" onkeyup="changevalue()">
                        <input type="text" class="form-control np" id="np" placeholder="Nama Proyek"
                            name="np[]" value="{{ old('np[]') }}" readonly hidden>
                        <span class="text-danger text-row1" style="display: none;color:red">Tidak Boleh Kosong</span>

                    </td>
                    <td class="text-right gini ">
                        <input type="text" class="form-control" id="cp1" placeholder="Biaya Proyek"
                            name="cp1" onkeyup="changevalue()">
                        <input type="text" class="form-control cp" id="cp" placeholder="Biaya Proyek"
                            name="cp[]" value="{{ old('cp[]') }}" readonly hidden>
                        <span class="text-danger text-row2" style="display: none;color:red">Tidak Boleh Kosong</span>
                    </td>
                    <td class="text-center"><a href="#" class="delete  btn btn-danger tombol"
                            style="display: none" id="delete">Delete</a></td>
                </tr>
            </tbody>
        </table>
        <button class="add_form_field tombol btn bg-purple text-white">Add New Item &nbsp;
            <span style="font-size:16px; font-weight:bold;">+ </span>
        </button>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="kategori">Standar Pembayaran</label>
        <select class="form-control {{ $errors->has('sp') ? ' is-invalid' : '' }}" id="kategori" name="sp">
            <option value="">Pilih Standar Pembayaran</option>
            <option value="standar">Standar</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
            <option value="excelent">Excelent</option>
        </select>
        @if ($errors->has('sp'))
            <span class="text-danger">{{ $errors->first('sp') }}</span>
        @endif
    </div>
    <div class=" col-md-6">
        <div class="row ">
            <div class="form-group col-md-4 standar" style="display:block">
                {{-- <div class="coba">
                    <label for="Jt">Jumlah Termin</label>
                    <input type="number" min="0" class="form-control" id="Jt" name="jt">
                </div> --}}
            </div>
            <div class="form-group  col-md-8 tambah" style="display:block">
                <label for="Term" class="col-sm-12 col-form-label"> </label>
                <div class="coba">
                    {{-- <div class="form-group row">
                        <label for="Term" class="col-sm-3   col-form-label">Term <span id="termin"></span></label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control" id="inputtermin" value="">
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="catatan">Catatan :</label>
            <textarea class="form-control {{ $errors->has('catatan') ? ' is-invalid' : '' }}" name="catatan"> </textarea>
            @if ($errors->has('catatan'))
                <span class="text-danger">{{ $errors->first('catatan') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6 mt-2 dd">
        <div class="hiddengg">
        </div>
        <div class="form-group row">
            <label for="dp" class="col-sm-4 col-form-label">Sub Total</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="subtotal" name="pembayaran" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="dp" class="col-sm-4 col-form-label">Total</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="total" readonly>
            </div>
        </div>
    </div>
</div>
