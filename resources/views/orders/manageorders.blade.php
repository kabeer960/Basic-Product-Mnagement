@extends('orders.ordermain')
@section('content')
        <div class="grid lg:grid-cols-1 mt-4">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-center text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Id</th>
                                <th scope="col" class="px-6 py-3">Total Amount</th>
                                <th scope="col" class="px-6 py-3">product Id</th>
                                <th scope="col" class="px-6 py-3">User Id</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr class="row_table_{{$item->order_id}} text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{$item->order_id}}</td>
                                <td class="px-6 py-4">{{$item->order_total_amount}}</td>
                                <td class="px-6 py-4">{{$item->product_id}}</td>
                                <td class="px-6 py-4">{{$item->user_id}}</td>
                                <td class="px-6 py-4">{{$item->order_status}}</td>
                            </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
@endsection
        
