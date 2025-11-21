@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Importar CSV
            </h2>
            <p class="mt-2 text-sm text-gray-700">
                Faça upload de um arquivo CSV para atualizar as quantidades dos produtos
            </p>
        </div>
    </div>

    <div class="mt-8">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Formato do CSV
                </h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500">
                    <p>O arquivo CSV deve seguir o seguinte formato:</p>
                </div>
                <div class="mt-3">
                    <pre class="bg-gray-50 rounded-md p-4 text-xs overflow-x-auto">Referência;Código;Produto;Quantidade
24;24;ELÉTRICA;1.130,00
21;21;ABRAÇADEIRA;27.807,00
18;18;LAMPADAS;1.472,00</pre>
                </div>
                <div class="mt-3 text-sm">
                    <ul class="list-disc list-inside text-gray-600 space-y-1">
                        <li>Separador: ponto e vírgula (;)</li>
                        <li>Decimal: vírgula (,)</li>
                        <li>A coluna "Referência" é usada para identificar o produto</li>
                        <li>Apenas a quantidade será atualizada</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <form action="{{ route('csv.import.process') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                @csrf

                <div>
                    <label for="csv_file" class="block text-sm font-medium text-gray-700">Arquivo CSV</label>
                    <input type="file" name="csv_file" id="csv_file" accept=".csv,.txt" required
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('csv_file') border-red-500 @enderror">
                    @error('csv_file')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">Tamanho máximo: 10MB</p>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('products.index') }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Cancelar
                    </a>
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Importar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
