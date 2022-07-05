<div class="form-row">
    <div class="form-group col-md-12">
        <label for="inputAddress">Tanggal Lamar</label>
        <input type="date" class="form-control {{ $errors->has('tgl_lamar') ? ' is-invalid' : '' }}" id="inputAddress"
            name="tgl_lamar" value="{{ old('tgl_selesai') }}">
        @if ($errors->has('tgl_lamar'))
            <span class="text-danger">{{ $errors->first('tgl_lamar') }}</span>
        @endif
    </div>
</div>
<div class="form-row">
    <div id="mol" class="form-group col-md-6">
        <label for="inputAddress">Tanggal Mulai</label>
        <input type="date" class="form-control {{ $errors->has('tgl_mulai') ? ' is-invalid' : '' }}"
            id="inputAddress" name="tgl_mulai" value="{{ old('tgl_mulai') }}">
        @if ($errors->has('tgl_mulai'))
            <span class="text-danger">{{ $errors->first('tgl_mulai') }}</span>
        @endif
    </div>
    <div id="tanggal_selesai" class="form-group col-md-6">
        <label for="inputAddress">Tanggal Selesai</label>
        <input type="date" class="form-control {{ $errors->has('tgl_selesai') ? ' is-invalid' : '' }}"
            id="inputAddress" name="tgl_selesai" value="{{ old('tgl_selesai') }}">
        @if ($errors->has('tgl_selesai'))
            <span class="text-danger">{{ $errors->first('tgl_selesai') }}</span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputAddress">Jam Mulai</label>
        <input type="time" class="form-control {{ $errors->has('jam_mulai_kerja') ? ' is-invalid' : '' }}"
            id="inputAddress" name="jam_mulai_kerja" value="{{ old('jam_mulai_kerja') }}">
        @if ($errors->has('jam_mulai_kerja'))
            <span class="text-danger">{{ $errors->first('jam_mulai_kerja') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="inputAddress">Jam Selesai</label>
        <input type="time" class="form-control {{ $errors->has('jam_selesai_kerja') ? ' is-invalid' : '' }}"
            id="inputAddress" name="jam_selesai_kerja" value="{{ old('jam_selesai_kerja') }}">
        @if ($errors->has('jam_selesai_kerja'))
            <span class="text-danger">{{ $errors->first('jam_selesai_kerja') }}</span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label id="narahubung" for="inputAddress"></label>
        <input type="text" class="form-control {{ $errors->has('letter_narahubung') ? ' is-invalid' : '' }}"
            id="inputAddress" name="letter_narahubung" value="{{ old('letter_narahubung') }}">
        @if ($errors->has('letter_narahubung'))
            <span class="text-danger">{{ $errors->first('letter_narahubung') }}</span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="inputAddress">Telepon</label>
        <input type="text" class="form-control {{ $errors->has('telepon_pembimbing') ? ' is-invalid' : '' }}"
            id="inputAddress" name="telepon_pembimbing" value="{{ old('telepon_pembimbing') }}">
        @if ($errors->has('telepon_pembimbing'))
            <span class="text-danger">{{ $errors->first('telepon_pembimbing') }}</span>
        @endif
    </div>
</div>
