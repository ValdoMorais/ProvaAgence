<div id="container-r-consultor" class="row">
	<div class="col-md-12">
		@if(count($relatorio_consultor) == 0)
			<div class="alert alert-info">Nenhum dado encontrado.</div>
		@else
			  @foreach($relatorio_consultor as $keys => $values)
					<table class="table table-bordered">
						<tr class="bg-primary">
								<th colspan="5"><strong>{{ $keys }}</strong></th>
						</tr>
						<tr>
							  @foreach(array_keys($values[0]) as $column_name)
							      <th><strong>{{ $column_name }}</strong></th>
							  @endforeach
						</tr>

						@foreach($values as $key => $value)
						    <tr>
							    @foreach($value as $v)
										@if((string)$key != 'total')
						        <td>{{ $v }}</td>
										@endif
							    @endforeach
						    </tr>
						@endforeach

						<tr class="bg-primary-bottom">
							  @foreach($values['total'] as $value)
										<td><strong>{{ $value }}</strong></td>
							  @endforeach
						</tr>
					</table>
				@endforeach
		@endif
	</div>
</div>
