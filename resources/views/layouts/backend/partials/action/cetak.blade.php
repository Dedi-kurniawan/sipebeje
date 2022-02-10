<div class="btn-group">
    <a href="{{ route('admin.print-step-pertama', $id) }}" class="btn btn-info btn-sm">Step 1 <i class="fas fa-file-pdf bg-danger"></i></a>
    <a href="{{ route('admin.cetak-undangan', $id) }}" class="btn btn-info btn-sm" id="cetakUndangan">Undangan <i class="fas fa-print bg-success"></i></a>
</div>
<div class="btn-group">
    <a href="{{ route('admin.print-step-kedua', $id) }}" class="btn btn-info btn-sm">Step 2 <i class="fas fa-file-pdf bg-danger"></i></a>
</div>