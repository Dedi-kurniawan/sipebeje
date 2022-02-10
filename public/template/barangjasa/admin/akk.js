"use strict";

$('.rupiah').mask('000.000.000.000.000,00', {
    reverse: true
});

$('#gambaran_pelaksanaan').summernote({
    placeholder: 'PENYEDIA WAJIB MEMBUAT JADWAL PELAKSANAAN KEGIATAN PEKERJAAN',
    tabsize: 2,
    height: 120,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['view', ['codeview', 'help']]
    ]
});

$('#spesifikasi_teknis').summernote({
    placeholder: 'URAIAN TAHAPAN-TAHAPAN PEKERJAAN',
    tabsize: 2,
    height: 120,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['view', ['codeview', 'help']]
    ]
});

$('#tenaga_kerja').summernote({
    placeholder: 'DAFTAR DALAM RANGKA PELAKSANAAN PADAT KARYA TUNAI DATA BERDASARKAN DATA DESA',
    tabsize: 2,
    height: 120,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['view', ['codeview', 'help']]
    ]
});

$( "#pagu_anggaran_rp" ).change(function() {
  rupiahTerbilang($("#pagu_anggaran_rp").val());    
});

$( "#terbilang_rupiah" ).click(function() {
  rupiahTerbilang($("#pagu_anggaran_rp").val());    
});

function rupiahTerbilang(rupiah) {
  var url   = HOST_URL + '/admin/rupiah-terbilang?rupiah='+ rupiah;
  $.get(url, function (d) {
      $("#pagu_anggaran_terbilang").val(d.rupiah);
  });
}