<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">HARGA PERKIRAAN KERJA (HPS)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_validate_modal" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-12">
                            <small class="font-size-sm font-italic mb-10 text-danger">
                                Kolom yang memiliki * wajib di isi
                            </small>
                        </div>
                    </div>
                    <input type="hidden" name="paket_id" id="paket_id">
                    <div class="mb-2">
                        <label for="example-input-normal" class="form-label">Uraian<span class="text-danger">*</span></label>
                        <input type="hidden" name="undangan_id" value="{{ $edit->id }}">
                        <textarea class="form-control {{ $errors->has('uraian') ? 'is-invalid' : '' }}" name="uraian" id="uraian" cols="30" rows="3" title="kolom uraian di larang kosong" placeholder="Uraian..." required>{{ old('uraian') }}</textarea>
                        {!! $errors->first('uraian', '<label id="uraian-error" class="error invalid-feedback" for="uraian">:message</label>')!!}
                    </div>
                    <div class="mb-2">
                        <label for="example-input-normal" class="form-label">Volume<span class="text-danger">*</span></label>
                        <input type="number" class="form-control {{ $errors->has('volume') ? 'is-invalid' : '' }}" autocomplete="off" name="volume" value="{{ old('volume') }}"  id="volume" title="kolom volume di larang kosong" placeholder="Volume..." required/>
                        {!! $errors->first('volume', '<label id="volume-error" class="error invalid-feedback" for="volume">:message</label>')!!}  
                    </div>
                    <div class="mb-2">
                        <label for="example-input-normal" class="form-label">Harga @<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="btn input-group-text btn-dark waves-effect waves-light">Rp. </span>
                            <input type="text" class="form-control rupiah {{ $errors->has('harga_satuan') ? 'is-invalid' : '' }}" autocomplete="off" name="harga_satuan" value="{{ old('harga_satuan') }}"  id="harga_satuan" title="kolom harga satuan di larang kosong" placeholder="Harga Satuan..." required/>
                            {!! $errors->first('harga_satuan', '<label id="harga_satuan-error" class="error invalid-feedback" for="harga_satuan">:message</label>')!!}  
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="example-input-normal" class="form-label">Satuan<span class="text-danger">*</span></label>
                        <select name="satuan" id="satuan" class="form-control {{ $errors->has('satuan') ? 'is-invalid' : '' }} selectForm" title="kolom satuan terbilang di larang kosong" required>
                            <option value="">pilih satuan</option>
                            <option value="m">m</option>
                            <option value="og">og</option>
                            <option value="bh">bh</option>
                        </select>
                        {!! $errors->first('satuan', '<label id="satuan-error" class="error invalid-feedback" for="satuan">:message</label>')!!}
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
