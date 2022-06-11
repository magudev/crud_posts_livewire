<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $open;
    public $title;
    public $content;
    public $image;
    public $identificador;

    public function mount()
    {
        $this->identificador = rand();
    }

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'image' => 'required|image|max:2048'
    ];

    public function save()
    {
        $this->validate();

        $image = $this->image->store('posts');

        // Creamos el registro del post
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image
        ]);

        $this->reset(['open', 'title', 'content', 'image']);
        $this->identificador = rand();

        // Eventos
        $this->emitTo('show-posts', 'render');
        $this->emit('alert', '¡El post se creó correctamente!');

    }

    public function render()
    {
        return view('livewire.create-post');
    } 

    public function updatingOpen()
    {
        if ($this->open == false) {
            $this->identificador = rand();
            $this->reset(['title', 'content', 'image']);
        }
    }
}
