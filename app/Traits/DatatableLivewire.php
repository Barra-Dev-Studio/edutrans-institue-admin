<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;

trait DatatableLivewire {
    public array $columns = [];
    public int $perPage = 5;
    public array $perPageOptions = [5, 10, 50, 100];
    public bool $action = true;
    public array $order = [];
    public array $search = [];
    public function setOrder($key): void
    {
        if (isset($this->order[$key])) {
            $this->order[$key] = $this->order[$key] === 'asc' ? 'desc' : 'asc';
        } else {
            $this->order = [];
            $this->order[$key] = 'desc';
        }
    }

    public function getData($model, $conditions = [], $with = [], $paginationType = 'normal')
    {
        $data = $model;

        if (count($with) > 0) {
            $data = $data->with($with);
        }

        if (count($conditions) > 0) {
            $data = $data->where($conditions);
        }

        if (count($this->search) > 0) {
            foreach ($this->search as $column => $value) {
                if (is_array($value)) {
                    $key = key($value);
                    if ($value[$key] !== '-1' && $value[$key] !== '' && $value[$key] !== null) {
                        $data = $data->whereHas($column, function ($query) use ($key, $value) {
                            $query->where($key, $value[$key]);
                        });
                    }
                } else {
                    if ($value !== '-1' && $value !== null) {
                        $data = $data->where($column, 'like', "%$value%");
                    }
                }
            }
        }

        if (count($this->order) > 0) {
            foreach ($this->order as $column => $order) {
                if (!Str::contains($column, '.')) {
                    $data = $data->orderBy($column, $order);
                }
            }
        }

        if ($paginationType === 'cursor') {
            return $data->cursorPaginate($this->perPage);
        }

        return $data->paginate($this->perPage);
    }

    public function paginationView(): string
    {
        return 'vendor.livewire.tailwind';
    }
}
