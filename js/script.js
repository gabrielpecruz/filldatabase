$(document).ready(function () {
   $("#tabelas").change( function () {
       $tabela = $(this).val();

       $.ajax({
           type: "POST",
           url: 'class/CamposAjax.php?function=ajaxCampos',
           data: {'params' : {
                    $tabela
                 }
               },
           success: function (data) {
               var obj = $.parseJSON(data);
               $(obj).each(function ($a) {

                   criarCampo(obj[$a]);
               })
           },
       });

   });
});

function criarCampo($nomeCampo) {

    $div = criarDiv();
    $label = criarLabel($nomeCampo);
    $select = criarSelect($nomeCampo);


    $div.append($label);
    $div.append($select);

    $("#campos").append($div);
}

function criarDiv() {
    //Div
    $div = $("<div>");
    $div.attr("class", "form-group col-md-2 float-left");

    return $div;
}

function criarLabel($nomeCampo) {
    //Label
    $label = $("<label>");
    $label.text($nomeCampo);

    return $label;
}

function criarSelect($nomeCampo) {
    //Select
    $select = $("<select>");
    $select.attr("class", "form-control col-md-12 ");
    $select.attr("name", $nomeCampo);

    $select.append(criarOption());

    return $select;
}

function criarOption() {
    //Option
    $option = $("<option>");
    $option.text("teste")

    return $option;
}