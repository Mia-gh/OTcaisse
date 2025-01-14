{{-- <x-app-layout>
    <div class="m-10 bg-gray-100">
        <div class="pb-8 flex justify-start items-center">
            <a class="border-4 border-teal-400 bg-white text-black font-paragraph rounded-xl p-2 ml-2"
                href="{{ route('sales.create') }}">
                Ajouter une vente</a>
        </div>
        <div class="row mt-2 font-paragraph">
            <div class="col-lg-12 italic pb-4 text-white">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 border-4 border-teal-400 p-4 rounded-xl bg-teal-800 text-black drop-shadow-2xl">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Il y a un problème avec votre enregistrement.<br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    @foreach ($sales as $sale)
                        <div class="col-lg-12 pb-5">
                            <h2>Vente {{ $sale->id }}</h2>
                            <p>Article : {{ $sale->article_id }}</p>
                            <p>Quantité : {{ $sale->quantity }}</p>
                            <p>Prix : {{ $sale->price }}</p>
                            <p>Moyen de paiement : {{ $sale->payment_method }}</p>
                            <p>Statut : {{ $sale->status }}</p>

                            <a href="{{ route('sales.edit', $sale) }}">Modifier</a>

                            <form method="POST" action="{{ route('sales.destroy', $sale) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit">Supprimer</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
