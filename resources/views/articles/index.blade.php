<x-app-layout>
    <header class="bg-white">
        <div class="max-w-7xl mx-auto py-4 px-2 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between">
            <h2 class="font-h1 text-4xl font-bold text-teal-600 leading-tight">
                Articles
            </h2>
            <a class="border-2 rounded-md border-teal-600 bg-white text-black font-h1 font-bold p-2 hover:bg-teal-600 hover:text-white mt-4 sm:mt-0"
                href="{{ route('articles.create') }}">
                Créer un nouvel article</a>
        </div>
    </header>
    <div class="m-4">

        <div class="row mt-2 font-bold">
            <div class="col-lg-12 italic pb-4 text-black font-bold">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>
            <div class="relative overflow-x-auto shadow-none overflow-auto p-2">
                <table class="centered-table w-full text-sm text-left">
                    <thead class="text-black sm:text-sm uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-3 whitespace-normal">
                                <div>
                                    Image
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-normal">
                                <div>
                                    Titre
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-normal">
                                <div>
                                    Prix
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-normal">
                                <div>
                                    Stock
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-normal">
                                <div>
                                    Alerte stock
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-normal">
                                <div>
                                    Catégorie
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 whitespace-normal">
                                <div>
                                    Description
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-normal">
                                <div>
                                    Référence
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-normal">
                                <div>
                                    Statut
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 whitespace-normal">
                                <div>
                                    Action
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            <tr class="px-6 py-4 rounded-md">
                                <td class="whitespace-normal">
                                    <img class="h-24 w-26 object-cover rounded-full {{ $article->status == 'actif' ? '' : 'grayscale' }}"
                                        src="{{ $article->image != null ? url('storage/' . $article->image) : url('img/andrew-small-unsplash.jpg') }}"
                                        alt="">
                                </td>
                                <td scope="row" class="px-6 py-10 flex items-center">{{ $article->title }}</td>
                                <td class="px-6 py-4 text-black whitespace-nowrap">
                                    {{ $article->price }} €</td>
                                <td class="px-20 py-4">{{ $article->quantity }}</td>
                                <td class="px-8 py-4">{{ $article->quantity_alert }}</td>
                                <td class="px-12 py-4">
                                    {{ $article->category != null ? $article->category->name : 'ND' }}</td>
                                <td class="px-8 py-4">{{ $article->description }}</td>
                                <td class="px-4 py-4">{{ $article->reference }}</td>
                                <td class="px-4 py-4">{{ $article->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold">
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST">

                                        <a class=" text-black hover:underline pr-2"
                                            href="{{ route('articles.show', $article) }}">Voir</a>

                                        <a class=" text-green-600 hover:underline pr-2"
                                            href="{{ route('articles.edit', $article) }}">Editer</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class=" text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
