@extends('main.main')
@section('content')
	<div class="container mx-auto">
		<div class="grid lg:grid-cols-1 mt-4">
			<div class="relative overflow-x-auto">
				<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
					<thead class="text-xs text-center text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
						<tr>
							<th scope="col" class="px-6 py-3">Id</th>
							<th scope="col" class="px-6 py-3">Total Amount</th>
							<th scope="col" class="px-6 py-3">product Id</th>
							<th scope="col" class="px-6 py-3">Status</th>
							<th scope="col" class="px-6 py-3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($items as $item)
						<tr class="row_table_{{$item->order_id}} text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
							<td class="px-6 py-4">{{$item->order_id}}</td>
							<td class="px-6 py-4">{{$item->order_total_amount}}</td>
							<td class="px-6 py-4">{{$item->product_id}}</td>
							<td class="px-6 py-4">{{$item->order_status}}</td>
							<td class="px-6 py-4">
								@if($item->order_status == 'Pending')
                                    <a role="button" class="myorder_cancel bg-red-500 py-2 px-3 text-white" data-id="{{$item->order_id}}">Cancel</a>
								@elseif($item->order_status == 'Canceled')
									<a role="button" class="myorder_reorder bg-green-500 py-2 px-3 text-white" data-id="{{$item->order_id}}">Re Order</a>
								@elseif($item->order_status == 'Delivered')
									<p class="text-green-500 font-bold">Delivered</p>
								@else
									<p class="text-green-500 font-bold">Deliver Soon!</p>
								@endif
							</td>	
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
    
    
@endsection
