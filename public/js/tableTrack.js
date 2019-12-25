$(document).ready(function () {
    selesai();
});

function selesai() {
    setTimeout(function () {
        isi();
        selesai();
    }, 500);
}
function isi(){
    var token=$('meta[name="csrf-token"]').attr('content');
    $.post('/admin/tTrack',{_token:token},function(data){
        $('#tabelTrack').html(data);
    });
}

