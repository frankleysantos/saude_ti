<?php

namespace App\Http\Resources\Especialidade;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EspecialidadeCollection extends ResourceCollection
{
    private $pagination = null;

    private $leanCollection;

    public function __construct($resource, $_params = null)
    {
        if (!$_params['notPagination']) {
            $this->pagination = [
                'total' => $resource->total(),
                'count' => $resource->count(),
                'per_page' => $resource->perPage(),
                'current_page' => $resource->currentPage(),
                'total_pages' => $resource->lastPage(),
                'links' => [    'next' => $resource->nextPageUrl() ,
                                'prev' => $resource->previousPageUrl()
                ]
            ];
        }
        $resourceClass = EspecialidadeResource::class;
        $this->leanCollection = $resourceClass;
        parent::__construct($resource->all());
    }

    public function toArray($request)
    {
        return [
            'response' => $this->leanCollection::collection($this->collection),
            'pagination' => $this->pagination
        ];
    }
}
