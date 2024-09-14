<section class="max-w-screen-xl px-4 py-10 mx-auto">
   <h2 class="text-2xl font-semibold text-gray-800 lg:text-3xl dark:text-white">Top <span class="text-green-700">Collected</span> Vinyl</h2>
   <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
      @foreach ($topVinyl as $vinyl)
         <div class="flex flex-col my-10 w-full rounded-md bg-white shadow-md">
            <a href="{{ url('browse/' . $vinyl['id'] . '/' . str_replace(' ', '-', strtolower($vinyl['title']))) }}">
               <img class="w-full rounded-t-lg object-cover" src="{{ $vinyl['cover_image'] }}" alt="product image" />
            </a>
            <div class="flex flex-col h-full mt-4 px-5 pb-5">
               <a href="#">
                  <h5 class="pb-5 text-lg font-bold tracking-tight text-slate-900">{{ $vinyl['title'] }}</h5>
               </a>
               <div class="flex justify-between items-end mt-auto">
                  <p>
                     <span class="text-sm">From </span>
                     <span class="text-xl font-bold text-slate-900">${{ number_format($vinyl['lowest_price'], 2, '.', ',') }}</span>
                  </p>
                  <a href="{{ url('browse/' . $vinyl['id'] . '/' . str_replace(' ', '-', strtolower($vinyl['title']))) }}" class="rounded-md bg-green-700 px-6 py-2 text-center text-sm font-bold text-white hover:bg-green-600 focus:outline-none focus:ring-0 transition-all duration-150">View</a>
               </div>
            </div>
         </div>       
      @endforeach
   </div>
</section>