function clienteRelatorio() {
    var form_data = $('#cliente_form').serialize();
    $.ajax({
      url: $('#cliente_url_relatorio').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      beforeSend: function() {
        $('#cliente_relatorio .alert-warning, #cliente_relatorio .alert-info').remove();
        $('#cliente_relatorio').append('<div class="alert alert-warning">Carregando, aguarde...</div>');
        $('#container-gl-cliente').remove();
        $('#container-gp-cliente').remove();
        $("input").prop('disabled', true);
      },
      success:function(data) {
        $('#cliente_relatorio').html(data);
        $("input").prop('disabled', false);
      }
    });
}

function clienteGraficoLinha() {
    var form_data = $('#cliente_form').serialize();
    $.ajax({
      url: $('#cliente_url_grafico_linha').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      async: true,
      beforeSend: function() {
        $('#cliente_grafico_linha .alert-warning, #cliente_grafico_linha .alert-info').remove();
        $('#cliente_grafico_linha').append('<div class="alert alert-warning">Carregando, aguarde...</div>');
        $('#container-r-cliente').remove();
        $('#container-gp-cliente').remove();
        $("input").prop('disabled', true);
      },
      success:function(data) {
        $('#cliente_grafico_linha').html(data);
        $("input").prop('disabled', false);
      }
    });
}

function clienteGraficoPizza() {
    var form_data = $('#cliente_form').serialize();
    $.ajax({
      url: $('#cliente_url_grafico_pizza').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      async: true,
      beforeSend: function() {
        $('#cliente_grafico_pizza .alert-warning, #cliente_grafico_pizza .alert-info').remove();
        $('#cliente_grafico_pizza').append('<div class="alert alert-warning">Carregando, aguarde...</div>');
        $('#container-r-cliente').remove();
        $('#container-gl-cliente').remove();
        $("input").prop('disabled', true);
      },
      success:function(data) {
        $('#cliente_grafico_pizza').html(data);
        $("input").prop('disabled', false);
      }
    });
}
