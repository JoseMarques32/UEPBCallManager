<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Criar Novo Ticket</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        {{-- Título --}}
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">
                Título do Ticket <span class="text-red-600">*</span>
            </label>
            <input 
                type="text" 
                id="title" 
                wire:model="title" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring focus:border-blue-400
                @error('title') border-red-500 @enderror"
                placeholder="Digite um título descritivo"
                maxlength="255"
            >
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <p class="text-sm text-gray-500 mt-1">Mínimo de 10 caracteres. Seja claro e específico.</p>
        </div>

        {{-- Descrição --}}
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">
                Descrição <span class="text-red-600">*</span>
            </label>
            <textarea 
                id="description" 
                wire:model="description" 
                rows="4"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring focus:border-blue-400
                @error('description') border-red-500 @enderror"
                placeholder="Descreva o problema ou solicitação..."
                maxlength="1000"
            ></textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <p class="text-sm text-gray-500 mt-1">Mínimo de 15 caracteres com detalhes relevantes.</p>
        </div>

        {{-- Categoria --}}
         <div class="mb-4"> 
            <label for="category_id" class="block text-sm font-medium text-gray-700">
                Categoria <span class="text-red-600">*</span>
            </label>
            <select 
                id="category_id" 
                wire:model="category_id" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring focus:border-blue-400
                @error('category_id') border-red-500 @enderror"
            >
                
               @foreach ($categories as $category)
               <option value="{{ $category->id }}">{{ $category->name }}</option>
               @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        {{-- Status --}}
        <div class="mb-4">
            <div class="bg-blue-100 text-blue-800 p-3 rounded">
                <strong>Status:</strong> Este ticket será criado com status <span class="font-bold">Aberto</span> e será atribuído automaticamente.
            </div>
        </div>

        {{-- Botões --}}
        <div class="flex justify-end gap-3">
            <button 
                type="button" 
                wire:click="cancel"
                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded shadow"
            >
                Cancelar
            </button>

            <button 
                type="submit" 
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow"
                wire:loading.attr="disabled"
                wire:target="save"
            >
                <span wire:loading.remove wire:target="save">
                    Criar Ticket
                </span>
                <span wire:loading wire:target="save">
                    <svg class="inline w-4 h-4 animate-spin mr-1" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                    Criando...
                </span>
            </button>
        </div>
    </form>
</div>
