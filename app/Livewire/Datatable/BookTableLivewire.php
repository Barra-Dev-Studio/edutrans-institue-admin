<?php

namespace App\Livewire\Datatable;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Book;
use App\Traits\DatatableModalTrait;
use Illuminate\Database\Eloquent\Builder;

class BookTableLivewire extends DataTableComponent
{
    use DatatableModalTrait;

    protected $model = Book::class;
    public $index = 0;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Book::query()
            ->with(['category', 'author'])
            ->select(['books.id', 'price', 'discount_price']);
    }

    public function columns(): array
    {
        return [
            Column::make('No')
                ->label(function ($row, $column) {
                    return ++$this->index +  ($this->paginators['page'] - 1) * $this->perPage;
                }),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Category", "category.name")
                ->sortable(),
            Column::make("Author", "author.name")
                ->sortable()
                ->searchable(),
            Column::make("Publisher", "publisher")
                ->sortable()
                ->searchable(),
            Column::make("Isbn", "isbn")
                ->sortable()
                ->searchable(),
            Column::make("Published year", "published_year")
                ->sortable(),
            Column::make("Price")->label(function ($row) {
                    if ($row->discount_price > 0) {
                        return "<span class='line-through'>$row->price</span> $row->discount_price";
                    }
                    return $row->price;
                })
                ->html()
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make('Action')
                ->label(function ($row) {
                    return view('components.datatable.action', [
                        'routeShow' => route('dashboard.book.show', $row->id),
                        'routeEdit' => route('dashboard.book.edit', $row->id),
                        'routeDestroy' => route('dashboard.book.destroy', $row->id),
                        'uniqueKey' => $row->id,
                    ]);
                }),
        ];
    }
}
