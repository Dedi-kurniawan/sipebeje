<option value="">Pilih {{ $title }}</option>
@foreach ($data as $d)
    <option value="{{ $d->id }}" {{ $d->id == $selected ? "selected" : "" }}>{{ $d->nama_perusahaan }}</option>
@endforeach