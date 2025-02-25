$(document).ready(function(){
    $('.alert-info').delay(3000).fadeOut(1500);
    $('.alert-warning').delay(3000).fadeOut(1500);
    $('.alert-danger').delay(3000).fadeOut(1500);
    $('.alert-success').delay(3000).fadeOut(1500);


    $('#myTable').DataTable({
        "columnDefs": [ {
            "targets": 'no-sort',
            "orderable": false
        } ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Hungarian.json"
        }        
    } );
    
  tinymce.init({selector:'.editor', language: 'hu_HU'});
});