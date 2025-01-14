<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-1/2">
                <h2 class="text-2xl font-bold mb-4">Confirm Purchase</h2>
                <div class="bg-white rounded-lg shadow p-6">
                   @foreach ($selectedArticles as $article)
                       <div class="flex justify-between items-center border-b py-2">
                           <div class="flex items-center">
                               <img src="{{ $article->image != null ? url('storage/' . $article->image) : url('img/andrew-small-unsplash.jpg') }}"
                                  alt="{{ $article->name }}" class="w-16 h-16 mr-4">
                               <div>
                                  <h3 class="text-lg font-semibold mb-1">{{ $article->name }}</h3>
                                  <span class="text-gray-500">{{ $article->price }} €</span>
                               </div>
                           </div>
                           <div class="flex items-center">
                               <form method="POST" action="{{ route('update', ['article' => $article->id]) }}">
                                  @csrf
                                  <input type="number" name="quantity" value="{{ $article->quantity }}" min="1"
                                      class="w-12 mr-2">
                                  <button type="submit"
                                      class="text-black border-2 border-emerald-300 bg-white hover:bg-emerald-300 px-3 py-1">Update
                                      Quantity</button>
                               </form>
                               <form method="POST" action="{{ route('remove', ['article' => $article->id]) }}">
                                  @csrf
                                  <button type="submit"
                                      class="text-black border-2 border-red-300 bg-white hover:bg-red-300 px-3 py-1">Remove
                                      from Cart</button>
                               </form>
                           </div>
                       </div>
                   @endforeach
                   <div class="flex items-center justify-between mb-4">
                       <h3 class="text-lg font-semibold">Total</h3>
                       <span class="text-gray-500">{{ $total }} €</span>
                   </div>
                   <form method="POST" action="{{ route('store') }}">
                       @csrf
                       <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded w-full">Finalize Purchase</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
 </x-app-layout>
 
