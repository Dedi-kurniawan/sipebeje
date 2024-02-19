<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">FORMULIR TAMBAH SURAT PESANAN BARU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_validate" method="POST" action="{{ route('admin.ba-barang.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <small class="font-size-sm font-italic mb-10 text-danger">
                                Kolom yang memiliki * wajib di isi
                            </small>
                        </div>
                    </div>
                    <input type="hidden" id="id_edit">
                    <div class="method-hidden"></div>
                    <div class="col-12 mb-2">
                        <label for="example-input-normal" class="form-label">Nomor:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('nomor_surat') ? 'is-invalid' : '' }}" autocomplete="off" name="nomor_surat" value="{{ old('nomor_surat') }}"  id="nomor_surat" title="kolom nomor surat di larang kosong" placeholder="nomor surat..." required/>
                        {!! $errors->first('nomor_surat', '<label id="nomor_surat-error" class="error invalid-feedback" for="nomor_surat">:message</label>')!!}
                    </div>
                    <div class="mb-2">
                        <label for="example-input-normal" class="form-label">Tanggal:<span class="text-danger">*</span></label>
                        <input type="date" class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" autocomplete="off" name="tanggal" value="{{ old('tanggal') }}"  id="tanggal" title="kolom tanggal di larang kosong" required/>
                        {!! $errors->first('tanggal', '<label id="tanggal-error" class="error invalid-feedback" for="tanggal">:message</label>')!!}
                    </div>
                    <div class="col-12 mb-2">
                        <label for="example-input-normal" class="form-label">Paket:<span class="text-danger">*</span></label>
                        <select name="paket_id" class="form-control selectForm {{ $errors->has('paket_id') ? 'is-invalid' : '' }}" id="paket_id" required title="Kolom Paket di larang kosong">
                            <option value="">Pilih Paket</option>
                            @foreach ($paket as $a)
                                <option value="{{ $a->id }}" {{ old('paket_id') == $a->id ? "selected" : "" }}>{{ $a->nama }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('paket_id', '<label id="paket_id-error" class="error invalid-feedback" for="paket_id">:message</label>')!!}
                    </div>
                    <div class="col-12 mb-2">
                        <h5>PIHAK KEDUA</h5>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="example-input-normal" class="form-label">Nama:<span class="text-danger">*</span></label>
                        <select name="aparatur_id" class="form-control selectForm {{ $errors->has('aparatur_id') ? 'is-invalid' : '' }}" id="aparatur_id" required title="Kolom pihak pertama nama di larang kosong">
                            <option value="">Pilih Nama</option>
                            @foreach ($aparatur as $a)
                                <option value="{{ $a->id }}" {{ old('aparatur_id') == $a->id ? "selected" : "" }}>{{ $a->nama }} - {{ $a->jabatan }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('aparatur_id', '<label id="aparatur_id-error" class="error invalid-feedback" for="aparatur_id">:message</label>')!!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary" id="submitData"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
