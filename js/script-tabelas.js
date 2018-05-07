$(document).ready(function () {

       $.ajax({
           type: "POST",
           url: 'class/TabelasAjax.php?function=ajaxTabelas',
           success: function (data) {
               if (data) {
                   var obj = $.parseJSON(data);
                   $(obj).each(function ($a) {

                       preecherCampo("#tabelas", obj[$a]);
                   })
               }
           },
       });

});

function preecherCampo($nomeCampo, $dado) {
    $($nomeCampo).append(criarOption($dado));
}