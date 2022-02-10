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
                        <label for="example-input-normal" class="form-label">Nama lengkap<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" maxlength="100" autocomplete="off" name="nama" id="nama" title="kolom nama lengkap di larang kosong" placeholder="Nama lengkap..." required/>
                    </div>
                    <div class="mb-3">
                        <label for="example-input-normal" class="form-label">Jabatan<span class="text-danger">*</span></label>
                        <select class="form-select my-1 my-md-0 selectForm" name="jabatan" id="jabatan">
                            <option value="">Pilih Jabatan</option>
                            <option value="KEPALA DESA">KEPALA DESA</option>
                            <option value="SEKRETARIS DESA">SEKRETARIS DESA</option>
                            <option value="KASI PEMERINTAHAN">KASI PEMERINTAHAN</option>
                            <option value="KASI PELAYANAN">KASI PELAYANAN</option>
                            <option value="KASI KESOS">KASI KESOS</option>
                            <option value="KAUR PERENCANAAN">KAUR PERENCANAAN</option>
                            <option value="KAUR KEUANGAN">KAUR KEUANGAN</option>
                            <option value="KAUR UMUM DAN TU">KAUR UMUM DAN TU</option>
                        </select>
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
