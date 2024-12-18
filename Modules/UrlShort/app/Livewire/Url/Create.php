<?php

namespace Modules\UrlShort\Livewire\Url;

use Livewire\Component;
use Modules\UrlShort\Http\Controllers\UrlShortController;
use Modules\UrlShort\Models\Url;

class Create extends Component
{
    public $url = '';
    public $variantes = [['descripcion' => '']]; // Siempre al menos una descripción

    public function addVariante()
    {

        $this->variantes[] = ['descripcion' => ''];
    }

    public function removeVariante($index)
    {
        // Asegurarse de que siempre queda al menos una entrada
        if (count($this->variantes) > 1) {
            unset($this->variantes[$index]);
            $this->variantes = array_values($this->variantes); // Reindexar el array
        }
    }

    public function save()
    {
        $this->validate([
            'url' => 'required|url',
            'variantes.*.descripcion' => 'required|string|max:255',
        ]);

        foreach ($this->variantes as $variante) {
            $code = UrlShortController::shortUrl($this->url);
            Url::create([
                'user_id' => auth()->id(),
                'url' => $this->url,
                'code' => $code,
                'description' => $variante['descripcion'],
            ]);
        }

        $this->dispatch('notify', [
            'message' => 'Url creada correctamente',
            'type' => 'success'
        ]);
    }


    public function render()
    {
        return view('urlshort::livewire.url.create');
    }
}
