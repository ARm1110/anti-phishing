@extends('layouts.home')
@section('main')
    <div class="px-4">
      
        <div
            class="
          
          justify-center
          items-center
          bg-white
          mx-auto
          max-w-2xl
          w-5/6
          rounded-lg
          my-16
          p-2
          
        "> 
         <a href="{{ route('dashboard.add') }}" class="bg-green-400 w-25 p-2 text-white rounded-lg">
            add new
         </a>
            <table class="rounded-t-lg  m-5 w-5/6  mx-auto bg-gray-900 text-gray-200">
                <tr class="text-left border-b border-gray-900">
                
                    <th class="px-4 py-3">url</th>
                    <th class="px-4 py-3">Disposition</th>
                    <th class="px-4 py-3">status</th>
                    <th class="px-4 py-3">date</th>
                </tr>
                @foreach ($data as $key => $value)
                    <tr class="bg-gray-700 border-b border-gray-600">
            
                        <td class="px-4 py-3">{{ $value->url }}</td>
                        <td class="px-4 py-3">{{ $value->disposition }}</td>
                        <td class="px-4 py-3">{{ $value->status }}</td>
                        <td class="px-4 py-3">{{ $value->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach


            </table>


            


        
        <div class="row flex-end">

                <div class="col-md-12">

                    {{ $data->links('pagination::tailwind') }}

                </div>

            </div>
    </div></div>
@endsection
