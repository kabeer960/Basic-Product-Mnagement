@extends('main.main')
@section('content')

    <div class="container mx-auto mt-10">
        <h1 class="mb-4 text-4xl font-bold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white text-center mt-3">Our Products</h1>
        <div class="grid lg:grid-cols-4 gap-5 mt-5">
            @foreach($items as $item)
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-full" src="{{$item->product_image}}" height="100px" class="img-fluid">
                <div class="px-6 py-4">
                    <p class="font-bold text-xl mb-2 text-center">Name: {{$item->product_name}}</p>
                    <p class="text-gray-700 text-base text-center">Color: {{$item->product_color}}</p>
                    <p class="text-gray-700 text-base text-center">Price: {{$item->product_price}}</p>
                    <div class="mt-3">
                        <a data-id="{{$item->product_id}}" role="button" class="buynow_btn block bg-green-500 hover:bg-green-600 rounded-lg text-white text-center py-2 font-bold">Buy Now</a>
                    </div>  
                </div>
            </div>
            @endforeach
        </div>
    </div>

   


    <!-- Main modal -->
    <div id="cardmodal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full" style="margin-left:350px; margin-top:60px;">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class=" flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white modal-title">
                        Add New Product
                    </h3>
                    <button type="button" id="cros_btn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form class="card_form" action="manageproducts" method="POST" enctype="multipart/form-data">
                    <!-- Modal body -->
                    <div class="m-3 grid lg:grid-cols-2 gap-3">
                        <div>
                            <img class="card_image" src="" alt="">
                        </div>
                        <div>
                            <form class="card_form" action="products" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" id="card_ptd">
                                <div class="grid lg:grid-cols-3 mb-6">
                                    <label for="pprice" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Product Price: </label>
                                    <input type="" id="cardpprice" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="Product Price" readonly>
                                </div>

                                <div class="grid lg:grid-cols-3 mb-6">
                                    <label for="delivery fee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Delivery Fee: </label>
                                    <input type="" id="card_dfee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="delivery Fee" readonly>
                                </div>

                                <div class="grid lg:grid-cols-3 mb-6">
                                    <label for="Total Amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Total Amount: </label>
                                    <input type="" name="order_total_amount" id="card_total_amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="Total Amount" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="defaultModal" id="cros_btn" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                        @if(Auth::user())
                        <button data-modal-hide="defaultModal" type="submit" class="cardpay_btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">proceed To Pay</button>
                        @else
                            <a href="{{route('login')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">proceed To Pay</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    
@endsection
  