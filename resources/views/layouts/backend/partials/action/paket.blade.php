<div class="btn-group">
    <a href="{{ $edit }}" class="btn btn-success btn-sm">Step 1 <i class=" fas fa-arrow-right"></i></a>
    <a href="{{ $step }}" class="btn btn-info btn-sm">Step 2 <i class=" fas fa-arrow-right"></i></a>
</div>
<br>
<div class="btn-group">
    <a href="{{ $show }}" class="btn btn-info btn-sm mb-2"><i class="fa fa-list"></i> Detail</a>
    <button id="deleteData" data-id="{{ $id }}" data-name="{{ $name }}" class="btn btn-sm btn-outline-danger mb-2">
        <i class="fa fa-trash"></i> Hapus
    </button>
</div>

