<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">FORMULIR TAMBAH SURAT PESANAN BARU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_validate_modal" method="POST">
                @csrf
                <input type="hidden" name="ba_barang_id" id="ba_barang_id" value="{{ $edit->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <small class="font-size-sm font-italic mb-10 text-danger">
                                Kolom yang memiliki * wajib di isi
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label for="example-input-normal" class="form-label">Jenis Barang:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" autocomplete="off" name="nama" value="{{ old('nama') }}"  id="nama" title="kolom uraian barang di larang kosong" placeholder="uraian barang..." required/>
                            {!! $errors->first('nama', '<label id="nama-error" class="error invalid-feedback" for="nama">:message</label>')!!}
                        </div>
                        <div class="col-12 mb-2">
                            <label for="example-input-normal" class="form-label">Volume:<span class="text-danger">*</span></label>
                            <input type="number" step="1" class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" autocomplete="off" name="qty" value="{{ old('qty') }}"  id="qty" title="kolom volume di larang kosong" placeholder="volume..." required/>
                            {!! $errors->first('qty', '<label id="qty-error" class="error invalid-feedback" for="qty">:message</label>')!!}
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="example-input-normal" class="form-label">Satuan:<span class="text-danger">*</span></label>
                        <select name="satuan" class="form-control selectForm {{ $errors->has('satuan') ? 'is-invalid' : '' }}" id="satuan" required title="Kolom satuan di larang kosong">
                            <option value="">Pilih Satuan</option>
                            @foreach ($satuan as $a)
                                <option value="{{ $a->nama }}" {{ old('satuan') == $a->nama ? "selected" : "" }}>{{ $a->nama }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('satuan', '<label id="satuan-error" class="error invalid-feedback" for="satuan">:message</label>')!!}
                    </div>
                    <div class="col-12 mb-2">
                        <label for="example-input-normal" class="form-label">Harga Satuan:<span class="text-danger">*</span></label>
                        <input type="number" step="1" class="form-control {{ $errors->has('harga_satuan') ? 'is-invalid' : '' }}" autocomplete="off" name="harga_satuan" value="{{ old('harga_satuan') }}"  id="harga_satuan" title="kolom harga satuan di larang kosong" placeholder="harga_satuan..." required/>
                        {!! $errors->first('harga_satuan', '<label id="harga_satuan-error" class="error invalid-feedback" for="harga_satuan">:message</label>')!!}
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
