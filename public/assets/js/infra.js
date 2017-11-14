    $(document).ready(function() {
        $(document).tooltip();
        $(".cep").mask("99.999-999");
        $(".cpf").mask("999.999.999-99");
        $(".data").mask("99/99/9999");
        $(".datatime").mask("99/99/9999 99:99:99");
        $(".hora").mask("99:99:99");
        $(".telefone").mask("(99) 9999-9999");
    });
