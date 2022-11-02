<div id="container-gb-consultor" class="row">
	<div class="col-md-9">
		@if(count($desemp) == 0)
			<div class="alert alert-info">Nenhum dado encontrado.</div>
		@else
			@foreach($desemp as $key => $value)
				<input type="checkbox" id="desemp_consultor" name="{{ $key }}" value="{{ $value }}" checked="checked" style="display: none">
			@endforeach
			<input type="checkbox" id="custo" name="{{ $custo }}" value="{{ $custo }}" checked="checked" style="display: none">
			<canvas id="grafico_barra"></canvas>
		@endif
	</div>

	<!-- Scripts -->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>

	<!-- Chart -->
	<script type="text/javascript" src="{{ asset('js/chartjs.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/grafico_barra.js') }}"></script>
</div>
