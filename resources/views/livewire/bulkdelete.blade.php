<div>
    <h3 class="text-2xl font-bold">Bulk Delete Confirmation</h3>

    @if(!empty($loanIds))
     <p class="mt-2">The following number of IDs will be affected and the action is irreversible:</p>
        {{count($loanIds)}}
        <div class="d-flex flex-column">
            <button wire:click="confirmDelete" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                Yes! delete
            </button>
            <button wire:click="cancelDelete" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                No! Cancel
            </button>
        </div>
    @elseif(!empty($loanProductIds))
           <p class="mt-2">The following number of IDs will be affected and the action is irreversible:</p>
        {{count($loanProductIds)}}

        <div class="d-flex flex-column">
            <button wire:click="confirmDelete" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">
                Yes! delete
            </button>
            <button wire:click="cancelDelete" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                No! Cancel
            </button>
        </div>
    @else
        <h1 class="text-orange-900 text-xl">No rows selected</h1>
    @endif

</div>
