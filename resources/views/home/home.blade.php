@extends('layouts.home')
@section('main')

    
         <div class="px-4">
             <div
                 class="
          flex
          justify-center
          items-center
          bg-white
          mx-auto
          max-w-2xl
          rounded-lg
          my-16
          p-16
        ">
                 {{-- form --}}

                 <form class="mt-8 space-y-6" id="form" action="{{ route('check') }}" method="POST">
                     
                     @csrf
                     <div class="-space-y-px  shadow-sm">
                         <div>
                             <label for="url-address" class="sr-only">Url address</label>
                             <p class="antialiased bg-green-400 p-2 text-white rounded-md">Example:
                                 https://www.qerylivexydyv.com</p>
                             <br>
                             <input id="url-address" name="url" value="{{ old('url') }}" type="url"
                                 autocomplete="url" required
                                 class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none w-80 h-10 focus:ring-indigo-500 sm:text-sm"
                                 placeholder="Url address">
                             @error('url')
                                 <div class="p-4  mb-4 text-sm text-red-700 bg-red-100  dark:bg-red-200 dark:text-red-800">
                                     {{ $message }}</div>
                             @enderror
                             <div class="flex items-center mb-4 mt-10">
                                 <input id="default-checkbox" type="checkbox" name="vip_mod" value="true"
                                     class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                 <label for="default-checkbox"
                                     class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                     if selected vip server mod in on
                                 </label>
                             </div>
                         </div>

                     </div>
                     <div id="alert"
                         class="p-4 hidden mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                         role="alert">
                         Invalid reCAPTCHA Please try again.
                     </div>



                     <div class="g-recaptcha" data-sitekey="6LeKIsAiAAAAACwcUjFaCwWjWCeG2t4QSloPwFmS"></div><br>
                     <div onclick="onSubmit()"
                         class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                         Send
                     </div>
             </div>

             </form>

             <script>
                 function onSubmit() {
                     var response = grecaptcha.getResponse();

                     if (response.length != 0) {
                         document.getElementById("form").submit();
                     } else {

                         var element = document.getElementById("alert");
                         element.classList.remove("hidden");
                         element.classList.remove("block");
                     }



                 }
             </script>
             {{-- form --}}
         </div>
    
 @endsection
