@if ($role == "admin" || $role == "kabupaten")
    <a href="{{ $edit }}" class="btn btn-sm btn-outline-success">
        <i class="fa fa-pen"></i> Ubah
    </a>
    <button id="deleteData" data-id="{{ $id }}" data-name="{{ $name }}" class="btn btn-sm btn-outline-danger">
        <i class="fa fa-trash"></i> Hapus
    </button>
    <a href="{{ $show }}" class="btn btn-sm btn-outline-info">
        <i class="fa fa-pen"></i> Detail
    </a>
@else
    <a href="{{ $show }}" class="btn btn-sm btn-outline-info">
        <i class="fa fa-list"></i> Detail
    </a>
@endif
