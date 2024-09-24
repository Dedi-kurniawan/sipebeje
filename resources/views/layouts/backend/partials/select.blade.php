<option value="">Pilih {{ $title }}</option>
@foreach ($data as $d)
    <option value="{{ $d->id }}" {{ $d->id == $selected ? "selected" : "" }}>{{ strtoupper($d->nama_perusahaan) }} | {{ strtoupper($d->kecamatan->nama) }} | {{ strtoupper($d->desa->nama) }}</option>
@endforeach