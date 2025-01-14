<x-app-layout>
    <div class="m-4 sm:m-10">
        <div class="pb-8 flex justify-start items-center">
                <a class="border-2 rounded-md border-teal-600 bg-white text-black hover:bg-teal-600 hover:text-white font-paragraph p-2 ml-2" href="{{ route('categories.index') }}">
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
                        <form action="{{ route('categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                              <div class="grid grid-cols-1 gap-4">
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Nom:</label>
                            <div class="form-group text-black">
                                <input type="text" name="name" class="form-control w-full" value="{{ old('name', $category->name) }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Couleur:</label>
                            <div class="form-group text-black">
                                <input type="color" name="color" class="form-control w-full" value="{{ old('color', $category->color) }}" style="background-color: {{ $category->color }}>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-4 pb-5">
                            <label class="font-bold text-lg text-white">Description:</label>
                            <div class="form-group text-black">
                                <input type="text" name="description" value="{{ old('description', $category->description) }}" class="form-control w-full">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-4 pb-5">
                            <label class="font-bold text-lg">Statut :</label>
                            <select class="text-black" name="status">
                                <option value="actif">actif</option>
                                <option value="inactif">inactif</option>
                            </select>
                        </div>
                               <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="border-2 rounded-md border-teal-600 bg-white hover:bg-teal-600 hover:text-white text-gray-800 p-3 px-5">Envoyer</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>