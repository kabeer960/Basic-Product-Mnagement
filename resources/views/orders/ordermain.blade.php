<x-app-layout>

    <div class="container mx-auto mt-10">

        <div class="grid lg:grid-cols-1">
            <ul class="flex ">
                <li class="mr-6">
                    <a href="{{route('manageorders')}}" class="text-black-500 focus:text-purple-600 border-r-2 border-gray-400 pr-4">All ({{$all}})</a>
                </li>
                <li class="mr-6">
                    <a href="{{route('pendingorders')}}" class="text-black-500 focus:text-purple-600 border-r-2 border-gray-400 pr-4">Pending ({{$pending}})</a>
                </li>
                <li class="mr-6"> 
                    <a href="{{route('inprogressorders')}}" class="text-black-500 focus:text-purple-600 border-r-2 border-gray-400 pr-4">In Progress ({{$inprogress}})</a>
                </li>
                <li class="mr-6">
                    <a href="{{route('shippedorders')}}" class="text-black-500 active:text-blue-500 border-r-2 border-gray-400 pr-4">Shipped ({{$shipped}})</a>
                </li>
                <li class="mr-6">
                    <a href="{{route('deliveredorders')}}" class="text-black-500 active:text-blue-500 border-r-2 border-gray-400 pr-4">Delivered ({{$delivered}})</a>
                </li>
                <li class="mr-6">
                    <a href="{{route('canceledorders')}}" class="text-black-500 active:text-blue-500">Canceled ({{$canceled}})</a>
                </li>
            </ul>
        </div>

        @yield('content')
        
    </div>
</x-app-layout>

