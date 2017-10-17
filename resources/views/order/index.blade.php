@extends('template')
@section('page_title')
	Orders
@stop
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-black">
				<div class="box-title">
					<h3><i class="fa fa-table"></i> Orders</h3>
					<div class="box-tool">
						<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
						<a data-action="close" href="#"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="box-content">

					<div class="table-responsive">
						<table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
							<thead>
							<tr>
								<th style="width:18px"><input type="checkbox"></th>
								<th>Id</th>
								<th>Phone number</th>
								<th>Price</th>
								<th class="visible-md visible-lg" style="width:130px">Action</th>
							</tr>
							</thead>
							<tbody>
							@foreach($orders as $order)
								<tr class="table-flag-blue">
									<td><input type="checkbox"></td>
									<td>{{$order->id}}</td>
									<td>{{$order->phone_number}}</td>
									<td>{{$order->total_price}}</td>
									<td class="visible-md visible-lg">
										<div class="btn-group">
											<a class="btn btn-sm show-tooltip" title="" href="{{url('order/'.$order->id)}}" data-original-title="View"><i class="fa fa-search-plus"></i></a>
											<a class="btn btn-sm btn-danger show-tooltip" title="" onclick="return confirm('Are you sure you want to delete this ?');" href="{{url('order/'.$order->id.'/delete')}}" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
										</div>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('script')
	<script>
		$('#order').addClass('active');
		$('#order-index').addClass('active');
	</script>
@stop