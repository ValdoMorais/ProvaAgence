function consultorRelatorio() {
    var form_data = $('#consultor_form').serialize();
    $.ajax({
      url: $('#consultor_url_relatorio').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      beforeSend: function() {
        $('#consultor_relatorio .alert-warning, #consultor_relatorio .alert-info').remove();
        $('#consultor_relatorio').append('<div class="alert alert-warning">Carregando, aguarde...</div>');
        $('#container-gb-consultor').remove();
        $('#container-gp-consultor').remove();
        $("input").prop('disabled', true);
      },
      success:function(data) {
        $('#consultor_relatorio').html(data);
        $("input").prop('disabled', false);
      }
    });
}

function consultorGraficoBarra() {
    var form_data = $('#consultor_form').serialize();
    $.ajax({
      url: $('#consultor_url_grafico_barra').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      async: true,
      beforeSend: function() {
        $('#consultor_grafico_barra .alert-warning, #consultor_grafico_barra .alert-info').remove();
        $('#consultor_grafico_barra').append('<div class="alert alert-warning">Carregando, aguarde...</div>');
        $('#container-r-consultor').remove();
        $('#container-gp-consultor').remove();
        $("input").prop('disabled', true);
      },
      success:function(data) {
        $('#consultor_grafico_barra').html(data);
        $("input").prop('disabled', false);
      }
    });
}

function consultorGraficoPizza() {
    var form_data = $('#consultor_form').serialize();
    $.ajax({
      url: $('#consultor_url_grafico_pizza').val(),
      method: "POST",
      data: form_data,
      datatype: "html",
      cache: false,
      async: true,
      beforeSend: function() {
        $('#consultor_grafico_pizza .alert-warning, #consultor_grafico_pizza .alert-info').remove();
        $('#consultor_grafico_pizza').append('<div class="alert alert-warning">Carregando, aguarde...</div>');
        $('#container-r-consultor').remove();
        $('#container-gb-consultor').remove();
        $("input").prop('disabled', true);
      },
      success:function(data) {
        $('#consultor_grafico_pizza').html(data);
        $("input").prop('disabled', false);
      }
    });
}
