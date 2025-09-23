<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Lista de Chamados</h2>

    <table class="table-auto w-full border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Titulo</th>
                <th class="border px-4 py-2">Descrição</th>
                <th class="border px-4 py-2">Criado em</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Categoria</th>
                @if(auth()->user()->role === 'staff')    
                    <th class="border px-4 py-2">Atribuir</th>
                @endif   
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)  
                <tr>
                    <td class="border px-4 py-2">{{ $ticket->id }}</td>
                    <td class="border px-4 py-2">{{ $ticket->title }}</td>
                    <td class="border px-4 py-2">{{ $ticket->description }}</td>
                    <td class="border px-4 py-2">{{ $ticket->created_at->format('d/m/Y') }}</td>
                    <td class="border px-4 py-2">{{ $ticket->status }}</td>
                    <td class="border px-4 py-2">{{ $ticket->category_id }}</td>

                    @if(auth()->user()->role === 'staff' && $ticket->agent_id === null)
                        <td class="border px-4 py-2">
                            <form action="{{ url('/tickets/'. $ticket->id . '/claim') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500  px-4 py-2 rounded">
                                    Atribuir
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Nenhum chamado encontrado</td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>

