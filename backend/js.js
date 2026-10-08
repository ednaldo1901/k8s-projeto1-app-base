$(document).ready(function () {

    // Carrega as mensagens ao abrir a página
    function carregarMensagens() {
        $.getJSON("index.php", function (dados) {
            var tbody = $("#lista-mensagens");
            tbody.empty();
            dados.forEach(function (m) {
                tbody.append(
                    "<tr style='border-bottom: 1px solid rgba(255,255,255,0.3);'>" +
                    "<td>" + m.id + "</td>" +
                    "<td>" + m.nome + "</td>" +
                    "<td>" + m.email + "</td>" +
                    "<td>" + m.mensagem + "</td>" +
                    "</tr>"
                );
            });
        });
    }

    carregarMensagens();

    // Botão Enviar
    $("#button-blue").on("click", function (e) {
        e.preventDefault();

        var txt_nome     = $("#name").val().trim();
        var txt_email    = $("#email").val().trim();
        var txt_mensagem = $("#comment").val().trim();

        if (txt_nome === "" || txt_email === "" || txt_mensagem === "") {
            alert("Preencha todos os campos.");
            return;
        }

        $.ajax({
            url: "index.php",
            type: "POST",
            data: {
                nome:     txt_nome,
                email:    txt_email,
                mensagem: txt_mensagem
            }
        })
        .done(function (resposta) {
            console.log("Resposta:", resposta);
            alert("Dados salvos!");
            // Limpa os campos
            $("#name").val("");
            $("#email").val("");
            $("#comment").val("");
            // Recarrega a lista
            carregarMensagens();
        })
        .fail(function (xhr) {
            console.error("Erro:", xhr.responseText);
            alert("Erro ao salvar.");
        });
    });
});