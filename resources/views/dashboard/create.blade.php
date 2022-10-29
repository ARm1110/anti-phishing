@extends('layouts.home')
@section('main')


    <div
        class="
          
     
          my-16
          p-2
          
        ">
        @if ($errors->any())
            <div class="fixed left-5 bg-red-400 p-7 text-red-900 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="w-full p-6 m-auto bg-white rounded shadow-lg ring-2 ring-purple-800/50 lg:max-w-md">
            <h1 class="text-3xl font-semibold text-center text-purple-700">AntiPhishing</h1>

            <form class="mt-6" method="POST" action="{{ route('dashboard.store') }}">
                @csrf
                <div>
                    <label for="url" class="block text-sm text-gray-800">Url</label>
                    <input type="url" name="url"
                        class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40">
                </div>
                <div class="mt-4">
                    <div>
                        <label for="disposition" class="block text-sm text-gray-800">disposition</label>
                        <input type="text" name="disposition"
                            class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40">
                    </div>

                    <div class="mt-6">
                        <button
                            class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-purple-700 rounded-md hover:bg-purple-600 focus:outline-none focus:bg-purple-600">
                            add new
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
