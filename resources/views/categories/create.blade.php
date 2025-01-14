<x-app-layout>
    <div class="m-10">
        <div class="pb-8 flex justify-start items-center">
            
            <a class="border-2 border-teal-600 rounded-sm hover:text-white hover:bg-teal-600 bg-white text-black font-paragraph p-2 ml-2" href="{{ route('categories.index') }}">
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

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Nom</label>
                            <div class="form-group text-black">
                                <input type="text" name="name" class="form-control w-full">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Couleur:</label>
                            <div class="form-group text-black">
                                <input type="color" name="color" class="form-control w-full">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pb-5">
                            <label class="font-bold text-lg">Description:</label>
                            <div class="form-group text-black">
                                <input type="text" name="description" class="form-control w-full">
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
            </div>
            </form>
        </div>
    </div>

    </div>
    </div>
</x-app-layout>
