<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputAddress">No Surat</label>
        <input id="txt1" type="text" class="form-control" id="inputAddress" placeholder=""
            value="{{ $nomor_surat }}" name="nomor_surat" readonly>
    </div>
    <div class="form-group col-md-6">
        <label for="perihal">Perihal</label>
        <input id="txt1" type="text" class="form-control {{ $errors->has('perihal') ? ' is-invalid' : '' }}"
            id="perihal" placeholder="" name="perihal" value="{{ old('perihal') }}">
        @if ($errors->has('perihal'))
            <span class="text-danger">{{ $errors->first('perihal') }}</span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="nama">Nama Pelanggan</label>
        <select data-placeholder="Nama" data-allow-clear="1"
            class="form-control {{ $errors->has('name_customer') ? ' is-invalid' : '' }}" name="name_customer"
            id="nama" onchange="onSelect()">
            @if (count($customer) !== 0)
                @foreach ($customer as $key => $arr)
                    <option value=""></option>
                    <option value="{{ $arr->id_customer }}">
                        {{ $arr->name_customer }}
                    </option>
                @endforeach
            @else
                <p>Tidak ada nama</p>
            @endif
        </select>
        @if ($errors->has('name_customer'))
            <span class="text-danger">{{ $errors->first('name_customer') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
            placeholder="email" name="email" value="{{ old('email') }}" readonly>
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="perusahaan">Perusahaan</label>
        <input type="text" class="form-control {{ $errors->has('company_customer') ? ' is-invalid' : '' }}"
            id="perusahaan" placeholder="Perusahaan" name="company_customer" value="{{ old('company_customer') }}"
            readonly>
        @if ($errors->has('company_customer'))
            <span class="text-danger">{{ $errors->first('company_customer') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="telepon">Telepon</label>
        <input type="text" class="form-control {{ $errors->has('phone_customer') ? ' is-invalid' : '' }}"
            id="telepon" placeholder="Telepon" name="phone_customer" value="{{ old('phone_customer') }}" readonly>
        @if ($errors->has('phone_customer'))
            <span class="text-danger">{{ $errors->first('phone_customer') }}</span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="dikirim">Tanggal Dikirim</label>
        <input type="date" class="form-control {{ $errors->has('dikirim') ? ' is-invalid' : '' }}" id="dikirim"
            name="dikirim" value="{{ old('dikirim') }}">
        @if ($errors->has('dikirim'))
            <span class="text-danger">{{ $errors->first('dikirim') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="tempo">Tanggal Jatuh Tempo</label>
        <input type="date" class="form-control {{ $errors->has('tempo') ? ' is-invalid' : '' }}" id="tempo"
            name="tempo" value="{{ old('tempo') }}">
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
                    <td class="text-right"> <input type="text" class="form-control np" id="np"
                            placeholder="Nama Proyek" name="np[]">
                    </td>
                    <td class="text-right gini"><input type="text" class="form-control cp" id="cp"
                            placeholder="Biaya Proyek" name="cp[]"></td>
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
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="catatan">Catatan :</label>
            <textarea class="form-control {{ $errors->has('catatan') ? ' is-invalid' : '' }}" name="catatan"> </textarea>
            @if ($errors->has('catatan'))
                <span class="text-danger">{{ $errors->first('catatan') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-4s">
        <div class="form-group col-md-12 font-weight-bold"><label for="subtotal font-weight-bold">Subtotal</label>
            <input type="text" class="form-control  subtotal" id="subtotal" placeholder="Subtotal"
                name="subtotal" readonly>
        </div>
        <div class="form-group col-md-12 font-weight-bold ">
            <label for="total font-weight-bold">Total +
                PPN 10%
            </label>
            <input type="text" readonly class="form-control total" id="total" placeholder="Total"
                name="total">
        </div>
    </div>
</div>
