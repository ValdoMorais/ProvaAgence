<div id="container-gp-cliente" class="row">
	<div class="col-md-9">
		@if(count($desemp_porcentual) == 0)
			<div class="alert alert-info">Nenhum dado encontrado.</div>
		@else
			@foreach($desemp_porcentual as $key => $value)
				<input type="checkbox" id="desemp_porcentual_cliente" name="{{ $key }}" value="{{ $value }}" checked="checked" style="display: none">
			@endforeach
			<canvas id="grafico_pizza_cliente"></canvas>
		@endif
	</div>

	<!-- Scripts -->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>

	<!-- Chart -->
	<script type="text/javascript" src="{{ asset('js/chartjs.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/grafico_pizza_cliente.js') }}"></script>
</div>
