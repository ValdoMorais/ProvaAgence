var dynamicColors = function() {
  var r = Math.floor(Math.random() * 255);
  var g = Math.floor(Math.random() * 255);
  var b = Math.floor(Math.random() * 255);
  return "rgb(" + r + "," + g + "," + b + ")";
}

var nomes = $('input:checked[id=desemp_consultor]').map(function() {
     return new Array(this.name);
}).get();

var receitas = $('input:checked[id=desemp_consultor]').map(function() {
     return new Array(this.value);
}).get();

var custos = $('input:checked[id=desemp_consultor]').map(function() {
     return $('input:checked[id=custo]').val();
}).get();

var cores = $('input:checked[id=desemp_consultor]').map(function() {
     return dynamicColors();
}).get();

var color = Chart.helpers.color;
new Chart(document.getElementById("grafico_barra"), {
    type: 'bar',
    data: {
      labels: nomes,
      datasets: [{
          label: "Custo Médio",
          type: "line",
          borderColor: "#666666",
          data: custos,
          fill: true
        }, {
            label: "Receita Total",
            type: "bar",
            backgroundColor: cores,
            data: receitas,
            fill: true
        }]
    },
    options: {
      title: {
        display: true,
        text: 'Desempenho dos Consultores (R$)'
      },
      legend: { display: true }
    }
});
