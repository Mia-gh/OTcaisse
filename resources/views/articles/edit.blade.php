<x-app-layout>
        <div class="m-4 sm:m-10">
            <div class="pb-8 flex justify-start items-center">
                <a class="border-2 rounded-md border-teal-600 bg-white text-black hover:text-white hover:bg-teal-600 p-2 ml-2"
                    href="{{ route('articles.index') }}">
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
            <div class="col-lg-12 text-black font-bold">
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

                <form action="{{ route('articles.update', $article->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4">

                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Titre :</label>
                            <div class="form-group text-black">
                                <input type="text" name="title" value="{{ $article->title }}"
                                    class="form-control w-full">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Prix :</label>
                            <div class="form-group text-black">
                                <input type="number" min="0" step="0.01" name="price"
                                    class="form-control w-full" value="{{ old('price', $article->price) }}"> 
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Stock :</label>
                            <div class="form-group text-black">
                                <input type="number" name="quantity" value="{{ $article->quantity }}"
                                    class="form-control w-full">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Alerte stock :</label>
                            <div class="form-group text-black">
                                <input type="number" name="quantity_alert" value="{{ $article->quantity_alert }}"
                                    class="form-control w-full">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Catégorie :</label>
                            <select class="text-black" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $article->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group py-2">
                            <label class="font-bold text-lg" for="image">Image :</label>
                            @if($article->image)
                            <img src="{{ asset('img/' . $article->image) }}" alt="Image description" />
                            @endif
                            <input type="file" name="image" id="image" class="form-control-file">
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Description :</label>
                            <div class="form-group text-black">
                                <textarea class="form-control w-full" name="description">{{ $article->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Référence :</label>
                            <div class="form-group text-black">
                                <input type="text" name="reference" value="{{ $article->reference }}"
                                    class="form-control w-full">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Statut :</label>
                            <select class="text-black" name="status">
                                <option value="actif">actif</option>
                                <option value="inactif">inactif</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit"
                                class="border-2 rounded-md border-teal-600 bg-white text-black hover:text-white hover:bg-teal-600 p-3 px-5">Envoyer</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
</x-app-layout>
