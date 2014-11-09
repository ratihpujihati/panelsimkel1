function cek(){
$.ajax({
url: "full.php",
cache: false,
success: function(msg){
$("#notifikasi").html(msg);
}
});
var waktu = setTimeout("cek()",3000);
}

    var k =1;
    $(document).ready(function(){
    cek();

    if(k==1){
    $("#pesanOnline").css("background-color","#efefef");
    k = 0;
    }else{
    $("#pesanOnline").css("background-color","#4B59a9?);
    k = 1;
    }
    $("#infoOnline").show();

    $.ajax({
    url: "full.php",
    cache: false,
    success: function(msg){
    $("#lopOnline").show();
    $("#konten-infoOnline").html(msg);
    }
    });

    $("#infoOnline").show();

    k = 1;

    });