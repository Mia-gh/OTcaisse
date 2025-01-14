<x-app-layout>
    <div class="m-10">
        <div class="pb-8 flex justify-start items-center">
            
            <a class="border-2 border-teal-600 rounded-md bg-white text-black hover:text-white hover:bg-teal-600 p-2 ml-2"
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
            <div class="col-lg-12 p-4 bg-white text-black drop-shadow-4xl">
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

                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Titre :</label>
                            <div class="form-group text-black">
                                <input type="text" name="title" class="form-control w-full"
                                    value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Prix :</label>
                            <div class="form-group text-black">
                                <input type="number" min="0" step="0.01" value="0.00" name="price"
                                    class="form-control w-full" value="{{ old('price') }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Stock :</label>
                            <div class="form-group text-black">
                                <input type="number" name="quantity" class="form-control w-full"
                                    value="{{ old('quantity') }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Alerte stock :</label>
                            <div class="form-group text-black">
                                <input type="number" name="quantity_alert" class="form-control w-full"
                                    value="{{ old('quantity_alert') }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Catégorie :</label>
                            <select class="text-black" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group py-2">
                            <label class="font-bold text-lg" for="image">Image :</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Description :</label>
                            <div class="form-group text-black">
                                <textarea class="form-control w-full" name="description" value="{{ old('description') }}"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Référence :</label>
                            <div class="form-group text-black">
                                <input type="text" name="reference" class="form-control w-full"
                                    value="{{ old('reference') }}">
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
                                class="border-2 border-teal-600 rounded-md bg-white text-black hover:text-white hover:bg-teal-600 p-3 px-5">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
