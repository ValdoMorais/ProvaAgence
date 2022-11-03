@extends('layouts.navigation')

@section('content')

<div class="panel panel-default">
			<div class="row">
					<h4>Performance Comercial</h4>
			</div>

			<div class="row">
					<ul class="nav nav-tabs" id="tab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="consultores-tab" data-toggle="tab" href="#consultores" role="tab" aria-controls="consultores" aria-selected="true">Consultores</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" id="clientes-tab" data-toggle="tab" href="#clientes" role="tab" aria-controls="clientes" aria-selected="false">Clientes</a>
					  </li>
					</ul>
					<div class="tab-content" id="tabContent">
					  <div class="tab-pane fade active" id="consultores" role="tabpanel" aria-labelledby="consultores-tab">
							<form method="post" id="consultor_form">
									@csrf
									@if (isset($model))
											<input type="hidden" name="_method1" value="PATCH">
									@endif
									<input type="hidden" id="consultor_url_relatorio" value="{{ url('usuario/relatorio') }}">
									<input type="hidden" id="consultor_url_grafico_barra" value="{{ url('usuario/grafico_barra') }}">
									<input type="hidden" id="consultor_url_grafico_pizza" value="{{ url('usuario/grafico_pizza') }}">
									<div class="form-group">
										<label>Período:</label>
										<div class="input-group" id="periodo_consultor">
											<input type="text" id="consultor_data1" name="consultor_data1" class="form-control data_consultor" style="cursor: pointer"/>
							        <span class="input-group-addon">
							            <i class="fa fa-calendar"></i>
							        </span>
											<div class="input-group-addon to">até</div>
											<input type="text" id="consultor_data2" name="consultor_data2" class="form-control data_consultor" style="cursor: pointer"/>
							        <span class="input-group-addon">
							            <i class="fa fa-calendar"></i>
							        </span>
									  </div>
									</div>

									<div class="form-group field-consultor">
									 <label>Consultor:</label>
									 <select id="consultor" name="consultor[]" multiple class="form-control" >
											 @foreach($usuarios as $usua)
												 <option value="{{ $usua->CO_USUARIO }}">{{ $usua->NO_USUARIO }}</option>
											 @endforeach
									 </select>
									</div>
									<div class="form-group">
										<input type="submit" onclick="consultorRelatorio();return false;" class="btn btn-info" value="Gerar Relatório" />
 									 	<input type="submit" onclick="consultorGraficoBarra();return false;" class="btn btn-info" value="Gerar Gráfico Barra" />
 									 	<input type="submit" onclick="consultorGraficoPizza();return false;" class="btn btn-info" value="Gerar Gráfico Pizza" />
									</div>
							 </form>
							 <div id="consultor_relatorio"></div>
							 <div id="consultor_grafico_barra"></div>
							 <div id="consultor_grafico_pizza"></div>
						</div>
					  <div class="tab-pane fade" id="clientes" role="tabpanel" aria-labelledby="clientes-tab">
								<form method="post" id="cliente_form">
										@csrf
										@if (isset($model))
												<input type="hidden" name="_method2" value="PATCH">
										@endif
										<input type="hidden" id="cliente_url_relatorio" value="{{ url('cliente/relatorio') }}">
										<input type="hidden" id="cliente_url_grafico_linha" value="{{ url('cliente/grafico_linha') }}">
										<input type="hidden" id="cliente_url_grafico_pizza" value="{{ url('cliente/grafico_pizza') }}">
										<div class="form-group">
											<label>Período:</label>
											<div class="input-group" id="periodo_cliente">
												<input type="text" id="cliente_data1" name="cliente_data1" class="form-control data_cliente" style="cursor: pointer"/>
												<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
												</span>
												<div class="input-group-addon to">até</div>
												<input type="text" id="cliente_data2" name="cliente_data2" class="form-control data_cliente" style="cursor: pointer"/>
												<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
												</span>
											</div>
										</div>

										<div class="form-group field-cliente">
										 <label>Cliente: </label>
										 <select id="cliente" name="cliente[]" multiple class="form-control" >
												 @foreach($clientes as $cli)
													 <option value="{{ $cli->CO_CLIENTE }}">{{ substr($cli->NO_FANTASIA, 0, 25) }}</option>
												 @endforeach
										 </select>
										</div>
										<div class="form-group">
										 <input type="submit" onclick="clienteRelatorio();return false;" class="btn btn-info" value="Gerar Relatório" />
										 <input type="submit" onclick="clienteGraficoLinha();return false;" class="btn btn-info" value="Gerar Gráfico Linha" />
										 <input type="submit" onclick="clienteGraficoPizza();return false;" class="btn btn-info" value="Gerar Gráfico Pizza" />
										</div>
								 </form>
								 <div id="cliente_relatorio"></div>
								 <div id="cliente_grafico_linha"></div>
								 <div id="cliente_grafico_pizza"></div>
							</div>
						</div>
					</div>
			</div>
</div>

@endsection
