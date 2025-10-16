<div class="max-w-4xl mx-auto bg-gray-50 rounded-lg shadow-lg p-6 mt-6">
    <!-- Cabeçalho -->
    <div class="bg-blue-600 text-black rounded-md px-6 py-4 mb-6">
        <h2 class="text-2xl font-bold">Detalhes do Chamado #{{ $ticket->id }} ( {{$ticket->title}} ) </h2>
    </div>

    <!-- Informações do chamado -->
    <div class="bg-white rounded-lg border border-gray-200 p-5 mb-6">
        <p class="text-gray-800"><strong>Título:</strong> {{ $ticket->title }}</p>
        <p class="text-gray-800 mt-1"><strong>Descrição:</strong> {{ $ticket->description }}</p>
        <p class="mt-2">
            <strong>Status:</strong>
            <span class="inline-block px-2 py-1 rounded text-sm font-semibold
                @if($ticket->status === 'aberto') bg-green-100 text-green-700
                @elseif($ticket->status === 'fechado') bg-red-100 text-red-700
                @else bg-yellow-100 text-yellow-700 @endif">
                {{ ucfirst($ticket->status) }}
            </span>
        </p>
    </div>

    <!-- Seção de respostas -->
    <h3 class="text-lg font-semibold text-gray-800 mb-3">Respostas</h3>

    <div class="space-y-3">
        @forelse($ticket->responses as $response)
            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow transition">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-blue-600 font-semibold">{{ $response->user->name }}</span>
                    <span class="text-sm text-gray-500">{{ $response->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <p class="text-gray-700">{{ $response->message }}</p>
            </div>
        @empty
            <div class="bg-white border border-gray-200 rounded-lg p-4 text-gray-500 italic">
                Nenhuma resposta ainda.
            </div>
        @endforelse
    </div>

    <!-- Formulário de resposta -->
    @if(auth()->user()->role === 'staff' || auth)
        <div class="mt-8 border-t pt-4">
            <h4 class="font-semibold text-gray-800 mb-2">Adicionar Resposta</h4>

            <form wire:submit.prevent="sendresponse" class="space-y-3">
                <textarea
                    wire:model="message"
                    rows="5"
                    class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-800"
                    placeholder="Escreva sua resposta aqui..."
                ></textarea>

                @error('message')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="bg-blue-600 hover:bg-blue-700 text-black px-5 py-2 rounded-md shadow-sm transition duration-150"
                >
                    <span wire:loading.remove>Enviar Resposta</span>
                    <span wire:loading>Enviando...</span>
                </button>
            </form>
        </div>
    @endif

    <!-- Mensagens de feedback -->
    @if (session('success'))
        <div class="mt-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mt-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-md">
            ⚠️ {{ session('error') }}
        </div>
    @endif
</div>
