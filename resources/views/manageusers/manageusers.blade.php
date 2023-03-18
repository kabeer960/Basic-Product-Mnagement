<x-app-layout>
    <div class="container mx-auto">
        <div class="grid lg:grid-cols-1 mt-4">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-center text-white uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Id</th>
                                <th scope="col" class="px-6 py-3">User Name</th>
                                <th scope="col" class="px-6 py-3">User Email</th>
                                <th scope="col" class="px-6 py-3">User Role</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr class="row_table_{{$item->id}} text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{$item->id}}</td>
                                <td class="px-6 py-4">{{$item->name}}</td>
                                <td class="px-6 py-4">{{$item->email}}</td>
                                @foreach($item->role as $role)
                                <td class="px-6 py-4">{{$role->name}}</td>
                                @if($role->name == 'superadmin')
                                <td class="px-6 py-4">Non Editable</td>
                                @else
                                <td class="px-6 py-4"><button id="user_role_btn" data-id="{{$item->id}}"><i class="fa fa-edit fa-2x"></i></button></td>
                                @endif
                                @endforeach
                            </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
  
                </div>
            </div>
        </div>
    </div>
   

    

    <!-- Main modal -->
    <div id="user_modal_bg" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden bg-opacity-75 fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full" style="margin-left:320px; margin-top:100px;">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Edit User
                        </h3>
                        <button id="user_modal_cancel" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="edit_user_form">
                        <!-- Modal body -->
                        <div class="m-3 grid lg:grid-cols-2 gap-3">
                            <div class="mb-6">
                                @csrf
                                <input type="hidden" id="uid" name="id">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                @if(Auth::user()->hasRole('superadmin'))
                                <input type="text" name="name" id="uname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                @elseif(Auth::user()->hasRole('admin'))
                                <input type="text" name="name" id="uname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required readonly>
                                @endif
                            </div>
                            <div class="mb-6">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                @if(Auth::user()->hasRole('superadmin'))
                                <input type="email" id="uemail" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                @elseif(Auth::user()->hasRole('admin'))
                                <input type="email" id="uemail" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required readonly>
                                @endif
                            </div>
                          
                            <div class="mb-6 col-span-2">
                                <label for="color" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Change Role</label>
                                <select name="role" id="user_role_option" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="2">Admin</option>
                                    <option value="3">Manager</option>
                                    <option value="4">User</option>
                                </select>
                            </div>
                           

                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                            <button id="user_modal_cancel" data-modal-hide="staticModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
        
