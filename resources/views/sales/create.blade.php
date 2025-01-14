{{-- <x-app-layout>
    <div class="m-10 bg-gray-100">
        <div class="pb-8 flex justify-start items-center">
            <a class="border-4 border-teal-400 bg-white text-black font-paragraph rounded-xl p-2 ml-2"
                href="{{ route('sales.index') }}">
                Retour</a>
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

                <form action="{{ route('sales.store', ['article' => $article->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Article :</label>
                            <div class="form-group text-black">
                                <select name="article_id" class="form-control w-full">
                                    @foreach($articles as $article)
                                        <option value="{{ $article->id }}">{{ $article->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Quantité :</label>
                            <div class="form-group text-black">
                                <input type="text" name="quantity" class="form-control w-full"
                                    value="{{ old('quantity') }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Prix :</label>
                            <div class="form-group text-black">
                                <input type="text" name="price" class="form-control w-full"
                                    value="{{ old('price') }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Moyen de paiement :</label>
                            <select class="text-black" name="payment_method">
                                <option value="espèces">espèces</option>
                                <option value="carte_bancaire">carte bancaire</option>
                                <option value="chèque">chèque</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Statut :</label>
                            <select class="text-black" name="status">
                                <option value="actif">actif</option>
                                <option value="inactif">inactif</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Historique du prix :</label>
                            <div class="form-group text-black">
                                <input type="text" name="price_history" class="form-control w-full"
                                    value="{{ old('price_history') }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit"
                                class="border-4 border-teal-400 bg-white  text-gray-800 rounded-xl p-3 px-5">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> --}}
