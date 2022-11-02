<div id="container-gp-consultor" class="row">
	<div class="col-md-9">
		@if(count($desemp_porcentual) == 0)
			<div class="alert alert-info">Nenhum dado encontrado.</div>
		@else
			@foreach($desemp_porcentual as $key => $value)
				<input type="checkbox" id="desemp_porcentual_consultor" name="{{ $key }}" value="{{ $value }}" checked="checked" style="display: none">
			@endforeach
			<canvas id="grafico_pizza_consultor"></canvas>
		@endif
	</div>

	<!-- Scripts -->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>

	<!-- Chart -->
	<script type="text/javascript" src="{{ asset('js/chartjs.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/grafico_pizza_consultor.js') }}"></script>
</div>
