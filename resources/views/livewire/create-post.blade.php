<div>
    {{-- BOTÓN CREAR POST --}}
    <x-jet-danger-button wire:click="$set('open', true)">
        Crear nuevo post
    </x-jet-danger-button>

    {{-- MODAL CREAR POST --}}
    <x-jet-dialog-modal wire:model="open">

        {{-- Slot title --}}
        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        {{-- Slot content --}}
        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Título del post"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="title"/>
                <x-jet-input-error for="title"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del post"/>
                <textarea class="form-control w-full" rows="6" style="resize: none" wire:model.defer="content"></textarea>
                <x-jet-input-error for="content"/>
            </div>

            <div class="mb-4">
                <input type="file" wire:model="image" id="{{ $identificador }}">
                <x-jet-input-error for="image"/>

                <div wire:loading wire:target="image" class="my-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative w-full" role="alert">
                    <strong class="font-bold">¡Su imagen está cargando!</strong>
                    <span class="block sm:inline">Aguarde un momento...</span>
                </div>
    
                @if ($image)
                    <img class="mt-4 object-contain h-20 w-20" src="{{ $image->temporaryUrl() }}" alt="Imagen">
                @endif

            </div>        

        </x-slot>

        {{-- Slot footer --}}
        <x-slot name="footer">
            <x-jet-secondary-button class="mr-4" wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:target="save, image" wire:loading.attr="disabled">
                Crear post
            </x-jet-danger-button>

        </x-slot>
        
    </x-jet-dialog-modal>
</div> 
