<x-app-layout>
    <div class="m-4 sm:m-10">
        <div class="pb-8 flex justify-start items-center">

            <a class="border-2 rounded-md border-teal-600 hover:bg-teal-600 hover:text-white bg-white text-black  font-paragraph p-2 ml-2" href="{{ route('categories.index') }}">
                Retour</a>
        </div>
        <div class="row mt-2 font-paragraph">
            <div class="col-lg-12 italic pb-4 text-black">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 p-4 bg-white text-black drop-shadow-2xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-xs-12 col-sm-12 col-md-12 pb-5 border-b">
                        <div class="form-group">
                            <label class="font-bold text-lg">Nom :</label><br>
                            {{ $category->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 pb-5 border-b">
                        <div class="form-group">
                            <label class="font-bold text-lg">Couleur :</label><br>
                          <div class="h-10 w-16" style="background-color: {{ $category->color }}"></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 pb-5 border-b">
                        <div class="form-group">
                            <label class="font-bold text-lg">Description :</label><br>
                            {{ $category->description }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 pb-5 border-b">
                        <div class="form-group">
                            <label class="font-bold text-lg">Statut :</label><br>
                            {{ $category->status }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>
