    <x-app-layout>
        <div class="m-10 sm:m-10">
            <div class="pb-8 flex justify-start items-center">
                
                <a class="border-2 rounded-md border-teal-600 hover:bg-teal-600 hover:text-white bg-white text-black font-paragraph p-2 ml-2" href="{{ route('articles.index') }}">
                    Retour</a>
            </div>
            <div class="row mt-2 font-paragraph">
                <div class="col-lg-12 italic pb-4 text-black font-bold">
                    @if ($message = Session::get('success'))    
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 p-4 bg-white text-black drop-shadow-2xl">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <div class="form-group">
                                <label class="font-bold text-lg">Titre :</label><br>
                                {{ $article->title }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <div class="form-group">
                                <label class="font-bold text-lg">Prix :</label><br>
                                {{ $article->price }} €
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <div class="form-group">
                                <label class="font-bold text-lg">Stock :</label><br>
                                {{ $article->quantity }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <div class="form-group">
                                <label class="font-bold text-lg">Alerte stock :</label><br>
                                {{ $article->quantity_alert }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <div class="form-group">
                                <label class="font-bold text-lg">Catégorie :</label><br>
                                {{ $article->category->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <div class="form-group py-2">
                                <label class="font-bold text-lg" for="image">Image :</label>
                                <input type="file" name="image" id="image" class="form-control-file">
                                {{ $article->image }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <div class="form-group">
                                <label class="font-bold text-lg">Description :</label><br>
                                {{ $article->description }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <div class="form-group">
                                <label class="font-bold text-lg">Référence :</label><br>
                                {{ $article->reference }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <div class="form-group">
                                <label class="font-bold text-lg">Statut :</label><br>
                                {{ $article->status }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
