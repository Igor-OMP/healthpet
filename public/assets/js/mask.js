/*MASCARAS*/
$(document).ready(function() {
    //$(document).tooltip();
    $(".cep").mask("99.999-999");
    $(".data").mask("99/99/9999");
    $(".datatime").mask("99/99/9999 99:99:99");
    $(".hora").mask("99:99:99");
    $(".phone_with_ddd").mask("(99) 99999-9999");
    $(".phone_with_ddd_old").mask("(99) 9999-9999");
});
