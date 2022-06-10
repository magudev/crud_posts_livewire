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
                {{-- <input type="text" wire:model="search"> --}}
                <x-jet-input wire:model="search" type="text" class="flex-1 mr-4" placeholder="Filtre su búsqueda aquí..."></x-jet-input>
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
                        @foreach ($posts as $post)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $post->id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $post->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $post->content }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
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
        </div>

    </div>

</div>