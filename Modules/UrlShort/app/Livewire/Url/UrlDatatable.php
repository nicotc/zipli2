<?php

namespace Modules\UrlShort\Livewire\Url;


use Modules\UrlShort\Models\Url;
use Nicotc\Datatable\Http\Livewire\Datatable;

class UrlDatatable extends  Datatable
{

    protected $listeners = ['deleteUrlConfirmed', 'notify'];



    public function config()
    {
        $this->itmesPerPage = 10;
        $this->visibleColumns = [
            'id',
            'url',
            'code',
            'description',
            'details',

        ];

        $this->create = false;
        $this->export = false;
        $this->actions = [
            // 'Show' => [
            //     'icon' => 'show',
            //     'isModal' => false,
            //     'event' => 'editUrl',
            //     'route' => 'urlshort.show'
            // ],
            // 'delete' => [
            //     'icon' => 'trash',
            //     'isModal' => true,
            //     'params' => ['id'],
            //     'event' => 'deleteUrl'
            // ]
        ];
        $this->createAction = [
            'label' => 'Create Url',
            'icon' => 'bx bx-plus',
            'event' => 'createUrl',
            'isModal' => true

        ];
    }

    public function buildQuery()
    {


        $query = Url::select(
            'urls.id',
            'urls.url',
            'urls.code',
            'urls.description',
            'urls.created_at',
        )
            ->where('user_id', auth()->id())
            ->with('details');

        $query->where(function ($query) {
            $query->where('url', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('code', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
        });

        if($this->search['url'] ?? false) {
            $query->where('url', "like", '%'.$this->search['url']. '%');
        }

        if($this->search['code'] ?? false) {
            $query->where('code', "like",
            '%'.$this->search['code']. '%');
        }

        if($this->search['description'] ?? false) {
            $query->where('description', 'like', '%' . $this->search['description'] . '%');
        }

        return $query;



    }

    public function getHeaders()
    {
        return [
            'url' => [
                'label' => 'url',
                'func' => function($value) {
                    return $value;
                 },
                'sortable' => true,
                'searchable' => true
            ],
            'code' => [
                'label' => 'Short Url (Code)',
                'func' => function($value) {
                    return
                    config('app.url') . '/p/' . $value;
                 },
                'sortable' => true,
                'searchable' => true
            ],
            'description' => [
                'label' => 'Description',
                'func' => function($value) {
                    return $value;
                 },
                'sortable' => true,
                'searchable' => true
            ],
            'created_at' => [
                'label' => 'Creado en',
                'func' => function($value) {
                    return $value->format('d/m/Y');
                 },
                'sortable' => true,
                'searchable' => true
            ],
            'details' => [
                'label' => 'Visitas',
                'func' => function($value) {
                    return $value->count();
                 },
                'sortable' => false,
                'searchable' => false
            ],

        ];
    }

    public function notify($message)
    {
        $this->getData();
    }

    public function deleteUrlConfirmed($id)
    {
        $url = Url::find($id);
        $url->delete();
        $this->notify('Url Deleted');
    }

    public function deleteUrl($id)
    {
        $this->modelDelete = $id;
        $this->dispatch('confirm-delete', [
            'title' => 'Delete Url',
            'message' => 'Are you sure you want to delete this url?',
        ]);
    }

    public function editUrl($id)
    {
        $this->dispatch('edit-url', ['id' => $id]);
    }

}
