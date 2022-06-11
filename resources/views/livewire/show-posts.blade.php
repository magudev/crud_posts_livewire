<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- CONTAINER --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <div class="px-6 py-4 flex items-center">
                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select wire:model="cantidad" class="mx-2 form-control" id="">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entradas</span>
                </div>
                <x-jet-input wire:model="search" type="text" class="flex-1 mx-2" placeholder="Filtre su búsqueda aquí..."></x-jet-input>
                @livewire('create-post')
            </div>

            @if ($posts->count())
                {{-- TABLE --}}
                <table class="w-full text-sm text-left">

                    {{-- TABLE HEAD --}}
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-5 py-3 cursor-pointer" wire:click="order('id')">
                                ID
                                <i class="fas fa-sort float-right mt-1"></i>
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('title')">
                                Title
                                {{-- SORT --}}
                                @if ($sort == 'title')
                                    @if ($direction == 'asc')
                                        <i class="fa-solid fa-arrow-down-a-z float-right mt-1"></i>
                                    @else
                                        <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                                    @endif
                                 @else    
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('content')"> 
                                Content
                                {{-- SORT --}}
                                @if ($sort == 'content')
                                    @if ($direction == 'asc')
                                        <i class="fa-solid fa-arrow-down-a-z float-right mt-1"></i>
                                    @else
                                        <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                                    @endif
                                 @else    
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer">Action</th>
                        </tr>
                    </thead>

                    {{-- TABLE BODY --}}
                    <tbody>
                        @foreach ($posts as $item)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $item->id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->content }}
                                </td>
                                <td class="px-6 py-4">
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                    <a class="btn btn-green" wire:click="edit({{$item}})">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            @else
                <div class="px-6 py-4">
                    Ningún registro coincide con su búsqueda
                </div>
            @endif

            @if ($posts->hasPages())
                <div class="px-6 py-3">
                    {{ $posts->links() }}
                </div>
            @else
                
            @endif

        </div>

    </div>

    {{-- MODAL PARA EDITAR UN POST --}}
    <x-jet-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            <span class="font-bold">Editar: </span>{{ $post->title }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Título del post"/>
                <x-jet-input wire:model.defer="post.title" type="text" class="w-full"/>
                <x-jet-input-error for="post.title"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del post"/>
                <textarea wire:model="post.content" class="form-control w-full" rows="6" style="resize: none"></textarea>
                <x-jet-input-error for="post.content"/>
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
                @else
                    <img class="mt-4 object-contain h-20 w-20" src="{{ asset('storage/' . $post->image) }}" alt="Imagen">
                @endif
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button class="mr-4" wire:click="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled">
                Guardar cambios
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

</div>