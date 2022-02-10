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
                        <label>Nama Desa<span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control"  required title="kolom desa di larang kosong" placeholder="Nama Desa..." />
                    </div>
                    <div class="mb-3">
                        <label>Kecamatan<span class="text-danger">*</span></label>
                        <select class="form-control selectForm" name="kecamatan_id" id="kecamatan_id" required title="kolom kecamatan di larang kosong">
                            <option value="">PILIH KECAMATAN</option>
                            @foreach ($kecamatan as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Tahun Berdiri</label>
                        <input type="number" name="tahun_berdiri" id="tahun_berdiri" autocomplete="off" class="form-control" placeholder="Tahun..." min="1900" max="{{ date('Y') }}" />
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="3" placeholder="Alamat..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Pendamping Desa</label>
                        <input type="text" name="pendamping_desa" id="pendamping_desa" class="form-control" title="kolom pendamping desa di larang kosong" placeholder="Pendamping Desa..." />
                    </div>
                    <div class="mb-3">
                        <label>Kepala Desa</label>
                        <input type="text" name="kepala_desa" id="kepala_desa" class="form-control" title="kolom kepala desa di larang kosong" placeholder="kepala Desa..." />
                    </div>
                    <div class="mb-3 row">
                        <div class="col-lg-6">
                            <label>E-mail</label>
                            <input name="email" type="email" id="email" class="form-control" placeholder="Email..." />
                        </div>
                        <div class="col-lg-6">
                            <label>No Handphone</label>
                            <input name="telepon" type="text" id="telepon" class="form-control" placeholder="No Handphone..." />
                        </div>
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
