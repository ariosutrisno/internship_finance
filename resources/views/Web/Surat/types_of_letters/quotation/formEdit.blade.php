<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputAddress">No Surat</label>
        <input id="txt1" type="text" class="form-control" id="inputAddress" placeholder=""
            value="{{ $id_quotation_letter->nomor_surat }}" name="nomor_surat" readonly>
    </div>
    <div class="form-group col-md-6">
        <label for="perihal">Perihal</label>
        <input id="txt1" type="text" class="form-control" id="perihal" placeholder="" name="perihal"
            value="{{ $id_quotation_letter->perihal }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="nama">Nama Pelanggan</label>
        <select data-placeholder="Nama" data-allow-clear="1" class="form-control" name="name" id="nama"
            onchange="onSelect()" value="{{ $id_quotation_letter->id_customer }}" style="font-color:black">
            <option value="{{ $id_quotation_letter->id_customer }}">{{ $id_quotation_letter->name_customer }}
            </option>
            @if (count($customer) !== 0)
                @foreach ($customer as $pelanggans)
                    @if ($pelanggans->id_customer !== $id_quotation_letter->id_customer)
                        <option value="{{ $pelanggans->id_customer }}">{{ $pelanggans->name_customer }}</option>
                    @endif
                @endforeach
            @else
                <p>Tidak ada nama</p>
            @endif
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="email" name="email"
            value="{{ $id_quotation_letter->email_customer }}" readonly>

    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="perusahaan">Perusahaan</label>
        <input type="text" class="form-control" id="perusahaan" placeholder="Perusahaan" name="perusahaan"
            value="{{ $id_quotation_letter->company_customer }}" readonly>
    </div>
    <div class="form-group col-md-6">
        <label for="telepon">Telepon</label>
        <input type="text" class="form-control" id="telepon" placeholder="Telepon"
            value="{{ $id_quotation_letter->phone_customer }}" name="telepon" readonly>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="dikirim">Tanggal Dikirim</label>
        <input type="date" class="form-control" id="dikirim" name="dikirim"
            value="{{ \Carbon\Carbon::parse($id_quotation_letter->created_at)->format('Y-m-d') }}">
    </div>
    <div class="form-group col-md-6">
        <label for="tempo">Tanggal Jatuh Tempo</label>
        <input type="date" class="form-control" id="tempo" name="tempo"
            value="{{ \Carbon\Carbon::parse($id_quotation_letter->tgl_jatuh_tempo)->format('Y-m-d') }}">
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

                @foreach ($item_quotation as $item)
                    <tr class="table-white ">
                        <td class="text-right"> <input type="text" class="form-control np" id="np"
                                placeholder="Nama Proyek" name="np[]" value="{{ $item->nama_project }}">
                        </td>
                        <td class="text-right gini"><input type="text" class="form-control cp" id="cp"
                                placeholder="Biaya Proyek" name="cp[]" value="{{ $item->biaya_project }}">
                        </td>
                        <td class="text-center"><a href="#" class="delete  btn btn-danger tombol"
                                id="delete">Delete</a></td>
                    </tr>
                @endforeach

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
            <textarea class="form-control" name="catatan">{{ $id_quotation_letter->catatan_keterangan }} </textarea>
        </div>
    </div>
    <div class="col-md-4s">
        <div class="form-group col-md-12 font-weight-bold"><label for="subtotal font-weight-bold">Subtotal</label>
            <input type="text" class="form-control subtotal" value="{{ $id_quotation_letter->pembayaran }}"
                id="subtotal" placeholder="Subtotal" name="subtotal" readonly>
        </div>
        <div class="form-group col-md-12 font-weight-bold ">
            <label for="total font-weight-bold">Total +
                PPN 10%
            </label>
            <input type="text" readonly class="form-control total" id="total" placeholder="Total"
                name="total" value="{{ $total }}">
        </div>
    </div>
</div>
