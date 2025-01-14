<x-app-layout>
    <div class="m-10 mt-12 border-8 rounded-lg border-teal-600">
        <h1 class="text-3xl text-lobster text-black mt-4 ml-4 mb-4">Statistiques</h1>
        <!-- Statistics will be displayed here -->
        <table class="table-auto w-full mb-6">
            <thead>
                <tr class="px-4 py-3 border-gray-400">
                    <th>Date</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($totalSalesPerDay as $sale)
                    <tr>
                        <td class="border px-4 py-2">{{ $sale->date }}</td>
                        <td class="border px-4 py-2">{{ $sale->count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</x-app-layout>
