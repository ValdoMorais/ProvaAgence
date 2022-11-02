var nomes = $('input:checked[id=desemp_cliente]').map(function() {
     return new Array(this.name);
}).get();

var receitas = $('input:checked[id=desemp_cliente]').map(function() {
     return new Array(this.value);
}).get();

new Chart(document.getElementById("grafico_linha"), {
    type: 'line',
    data: {
      labels: nomes,
      datasets: [{
            label: "Receita Total",
            borderColor: "#666666",
            data: receitas,
            fill: true
        }]
    },
    options: {
      title: {
        display: true,
        text: 'Desempenho dos Clientes (R$)'
      },
      legend: { display: true }
    }
});
