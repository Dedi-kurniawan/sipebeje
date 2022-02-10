<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_validate">
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
                        <label for="desa_id" class="form-label">Desa <span class="text-danger">*</span></label>
                        <select name="desa_id" class="form-control {{ $errors->has('desa_id') ? 'is-invalid' : '' }} selectForm" id="desa_id" required>
                            <option value="">Pilih Desa</option>
                            @foreach ($desa as $d)
                                <option value="{{ $d->id }}">{{ $d->nama." | ".$d->kecamatan->nama }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('desa_id', '<label id="desa_id-error" class="error invalid-feedback" for="desa_id">:message</label>')!!}
                    </div>
                    <div class="mb-3">
                        <label for="example-input-normal" class="form-label">Nama lengkap<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" maxlength="100" autocomplete="off" name="name" id="name" title="kolom nama lengkap di larang kosong" placeholder="Nama lengkap..." required/>
                    </div>
                    <div class="mb-3">
                        <label for="example-input-normal" class="form-label">E-mail<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" maxlength="100" autocomplete="off" name="email" id="email" title="kolom email di larang kosong" placeholder="E-mail..." required/>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="password...">
                            {!! $errors->first('password', '<label id="password-error" class="error invalid-feedback" for="password">:message</label>')!!}
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                        <small class="text-info">*password standart (12345678)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary" id="submitData"></button>
                </div>
            </form>
        </div>
    </div>
</div>
