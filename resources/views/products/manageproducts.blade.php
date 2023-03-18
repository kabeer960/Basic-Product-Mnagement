<x-app-layout>
    <div class="container mx-auto mt-5">
        <div class="grid lg:grid-cols-1">
            <div class="col-span-1">
                <button class="bg-green-500 hover:bg-green-600 float-right rounded-lg text-white py-2 px-5 mb-2 font-bold add_product">Add Product</button>
            </div>
            
 
                <div class="relative overflow-x-auto col-span-1">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-center text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Id</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Price</th>
                                <th scope="col" class="px-6 py-3">Color</th>
                                <th scope="col" class="px-6 py-3">Image</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr class="row_table_{{$item->product_id}} text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{$item->product_id}}</td>
                                <td class="px-6 py-4">{{$item->product_name}}</td>
                                <td class="px-6 py-4">{{$item->product_price}}</td>
                                <td class="px-6 py-4">{{$item->product_color}}</td>
                                <td class="px-6 py-4"><img src="{{$item->product_image}}" style="height:30px;" /></td>
                                <td class="px-6 py-4">
                                    <a role="button" class="product_edit" data-id="{{$item->product_id}}"><i class="fa fa-edit fa-2x text-black hover:text-yellow-500 edit_btn pr-2"></i></a>
                                    @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin'))
                                        <a role="button" class="product_delete" data-id="{{$item->product_id}}"><i class="fa fa-trash fa-2x text-black hover:text-red-500 delete_btn"></i></a>
                                    @endif
                                    
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        

        <!-- Main modal -->
        <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full" style="margin-left:350px; margin-top:60px;">
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
                    <form class="product_form" action="manageproducts" method="POST" enctype="multipart/form-data">
                        <!-- Modal body -->
                        <div class="m-3 grid lg:grid-cols-2 gap-3">
                            <div class="mb-6">
                                @csrf
                                <input type="hidden" id="pid" name="product_id">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                                <input type="text" name="product_name" id="pname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Product Name" required>
                            </div>
                            <div class="mb-6">
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Price</label>
                                <input type="number" id="pprice" name="product_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Product Price" required>
                            </div>

                            <div class="mb-6">
                                <label for="color" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Color</label>
                                <input type="text" id="pcolor" name="product_color" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Product Color" required>
                            </div>
                            <div class="mb-6">
                                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Image</label>
                                <input type="file" id="pimage" name="product_image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            </div>

                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="defaultModal" type="submit" class="save_btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                            <button data-modal-hide="defaultModal" id="cros_btn" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

