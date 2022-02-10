<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">FORMULIR TAMBAH PAKET BARU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_validate" method="POST" action="{{ route('admin.paket.store') }}">
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
                    <div class="mb-3">
                        <label for="example-input-normal" class="form-label">Nama Paket:<span class="text-danger">*</span></label>
                        <textarea class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" name="nama" id="nama" cols="30" rows="3" title="kolom nama di larang kosong" placeholder="Paket..." required>{{ old('nama') }}</textarea>
                        {!! $errors->first('nama', '<label id="nama-error" class="error invalid-feedback" for="nama">:message</label>')!!}
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="example-input-normal" class="form-label">Jenis:<span class="text-danger">*</span></label>
                            <select name="jenis" class="form-control selectForm {{ $errors->has('jenis') ? 'is-invalid' : '' }}" id="jenis" required>
                                <option value="">Pilih Jenis</option>
                                <option value="Pengadaan Langsung" {{ old('jenis') == "Pengadaan Langsung" ? "selected" : "" }}>Pengadaan Langsung</option>
                                <option value="Tender" {{ old('jenis') == "Tender" ? "selected" : "" }}>Tender</option>
                            </select>
                            {!! $errors->first('jenis', '<label id="jenis-error" class="error invalid-feedback" for="jenis">:message</label>')!!}
                        </div>
                        <div class="col-6">
                            <label for="example-input-normal" class="form-label">Penanggung Jawab:<span class="text-danger">*</span></label>
                            <select name="aparatur_id" class="form-control selectForm {{ $errors->has('aparatur_id') ? 'is-invalid' : '' }}" id="aparatur_id" required title="Kolom penanggung jawab di larang kosong">
                                <option value="">Pilih Penanggung Jawab</option>
                                @foreach ($aparatur as $a)
                                    <option value="{{ $a->id }}" {{ old('aparatur_id') == $a->id ? "selected" : "" }}>{{ $a->nama }}-{{ $a->jabatan }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('aparatur_id', '<label id="aparatur_id-error" class="error invalid-feedback" for="aparatur_id">:message</label>')!!}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="example-input-normal" class="form-label">HPS:<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="btn input-group-text btn-dark waves-effect waves-light">Rp. </span>
                            <input type="text" class="form-control rupiah {{ $errors->has('hps') ? 'is-invalid' : '' }}" autocomplete="off" name="hps" value="{{ old('hps') }}"  id="hps" title="kolom hps di larang kosong" placeholder="HPS..." required/>
                            {!! $errors->first('hps', '<label id="hps-error" class="error invalid-feedback" for="hps">:message</label>')!!}  
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="example-input-normal" class="form-label">HPS (Terbilang):<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control {{ $errors->has('terbilang') ? 'is-invalid' : '' }}" autocomplete="off" name="terbilang" value="{{ old('terbilang') }}"  id="terbilang" title="kolom terbilang di larang kosong" placeholder="HPS Terbilang..." required/>
                            <button class="btn input-group-text btn-dark waves-effect waves-light" type="button" id="terbilang_rupiah"><i class="fas fa-sync-alt"></i></button>
                            {!! $errors->first('terbilang', '<label id="terbilang-error" class="error invalid-feedback" for="terbilang">:message</label>')!!} 
                        </div> 
                    </div>
                    <div class="mb-3">
                        <label for="example-input-normal" class="form-label">Akhir Pendaftaran:<span class="text-danger">*</span></label>
                        <input type="date" class="form-control {{ $errors->has('tanggal_selesai') ? 'is-invalid' : '' }}" autocomplete="off" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"  id="tanggal_selesai" title="kolom tanggal selesai di larang kosong" placeholder="Akhir Pendaftaran..." required/>
                        {!! $errors->first('tanggal_selesai', '<label id="tanggal_selesai-error" class="error invalid-feedback" for="tanggal_selesai">:message</label>')!!}  
                    </div>
                    <div class="mb-3">
                        <label for="example-input-normal" class="form-label">Deskripsi:<span class="text-danger">*</span></label>
                        <input type="hidden" name="keterangan" id="keterangan" value="{{ old('keterangan') }}">
                        <div id="editor" style="min-height: 160px;">{!! old('keterangan') !!}</div>
                        {!! $errors->first('keterangan', '<label id="keterangan-error" class="error invalid-feedback" for="keterangan">:message</label>')!!}            
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
