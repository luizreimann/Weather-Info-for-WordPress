jQuery(document).ready(function($) {
    $('#cep').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep != "") {
            var validacep = /^[0-9]{8}$/;
            if (validacep.test(cep)) {
                // Usar Brasil API para retornar o endereço
                $.getJSON("https://brasilapi.com.br/api/cep/v2/" + cep, function(dados) {
                    if (!("erro" in dados)) {
                        $("#address").val(dados.street);
                        $("#neighborhood").val(dados.neighborhood);
                        $("#city").val(dados.city);
                        $("#state").val(dados.state);

                        // Usar a API Nominatim para obter latitude e longitude
                        var enderecoCompleto = dados.street + ", " + dados.city + ", " + dados.state + ", Brazil";
                        $.getJSON("https://nominatim.openstreetmap.org/search?format=json&q=" + encodeURIComponent(enderecoCompleto), function(locData) {
                            if (locData.length > 0) {
                                $("#latitude").val(locData[0].lat);
                                $("#longitude").val(locData[0].lon);
                            } else {
                                console.log("Coordenadas não encontradas para o endereço fornecido.");
                            }
                        });
                    }
                });
            }
        }
    });
});
