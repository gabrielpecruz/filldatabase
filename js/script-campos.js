$(document).ready(function () {
   $("#tabelas").change( function () {
       $tabela = $(this).val();

       $.ajax({
           type: "POST",
           url: 'class/TabelasAjax.php?function=ajaxCampos',
           data: {'params' : {
                    $tabela
                 }
               },
           success: function (data) {
               var obj = $.parseJSON(data);

               $("#campos").html("");

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
    $div.attr("class", "form-group col-md-3 float-left");

    return $div;
}

function criarLabel($nomeCampo) {
    //Label
    $label = $("<label>");
    $label.text($nomeCampo['campo']);

    return $label;
}

function criarSelect($nomeCampo) {
    //Select
    $select = $("<select>");
    $select.attr("class", "form-control");
    $select.attr("name", $nomeCampo['campo']);

    $select.append(criarOption($nomeCampo['tipo']));

    return $select;
}

function criarOption($nome = "teste") {
    //Option
    $option = $("<option>");
    $option.text($nome)
    $option.attr("value", $nome)

    return $option;
}