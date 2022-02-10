<form action="{{ route('admin.print-undangan') }}" method="GET">
    <input type="hidden" name="paket_id" value="{{ $paket_id }}">
    <input type="hidden" name="vendor_id" value="{{ $vendor_id }}">
    <input type="hidden" name="undangan_id" value="{{ $undangan_id }}">
    <button class='btn btn-sm btn-outline-danger'><i class='fa fa-file-pdf'></i> Download</button>
</form>