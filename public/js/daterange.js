var date = new Date();
var month = date.getMonth(); //Initial month
var year = 2006; //Initial year
var endYear = date.getFullYear(); //Actual year

$('#periodo_consultor').datepicker ({
    inputs: $('.data_consultor'),
    format: "mm/yyyy",
    minViewMode: 1,
    autoclose: true,
    startDate: new Date(year, month, '01'),
    endDate: new Date(endYear, month, '31')
});

$('#periodo_cliente').datepicker ({
    inputs: $('.data_cliente'),
    format: "mm/yyyy",
    minViewMode: 1,
    autoclose: true,
    startDate: new Date(year, month, '01'),
    endDate: new Date(endYear, month, '31')
});
