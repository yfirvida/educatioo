<div class="content-wrapper">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ __('Lands') }}</h4>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>
										{{ __('Name') }}
									</th>
									<th>
										{{ __('ISO') }}
									</th>
									<th>
										{{ __('Phone Code') }}
									</th>
									<th>
										{{ __('Actions') }}
									</th>
								</tr>
							</thead>
							<tbody>
								@if(!empty($lands))
									@foreach ($lands as $land)
									<tr>
										<td class="py-1">
											{{ $land->name }}
										</td>
										<td>
											{{ $land->iso }}
										</td>
										<td>
											{{ $land->phonecode }}
										</td>
										<td>
											<button class="bt badge badge-success"><i class=" mdi mdi-pencil-box-outline"></i> {{ __('Edit') }}</button>
											<button class="bt badge badge-danger"><i class=" mdi mdi-minus-circle-outline"></i> {{ __('Delete') }}</button>
										</td>
									</tr>
									@endforeach
								@else
                  <tr>
                    <td colspan="4">
                      <div class="text-center text-muted mt-5 mb-5"><em>{{__('You don\'t have lands added yet')}}</em></div>
                    </td>
                  </tr>
                @endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 text-center">
			{{ $lands->onEachSide(0)->links() }}
		</div>
	</div>
	
</div>

