<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class LengthAwareCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        if (!($this->resource instanceof LengthAwarePaginator)) {
            if (static::$wrap) {
                return [
                    static::$wrap => $this->collection
                ];
            }

            return [...$this->collection];
        }

        /** @var LengthAwarePaginator $this */

        return [
            'data' => $this->collection,
            'pagination' => [
                'current_page' => $this->resource->currentPage(),
                'last_page' => $this->resource->lastPage(),
                'per_page' => $this->resource->perPage(),
                'first_item' => $this->resource->firstItem(),
                'last_item' => $this->resource->lastItem(),
                'total' => $this->resource->total(),
            ],
        ];
    }
}
