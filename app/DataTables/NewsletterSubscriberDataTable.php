<?php

namespace App\DataTables;

use App\Models\NewsletterSubscriber;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NewsletterSubscriberDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<NewsletterSubscriber> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $deleteBtn = '
                <form action="' . route('admin.newsletter-subscribers.destroy', $query->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger ml-2 mr-2 delete-item" style="background: #fc544b;" onclick="return confirm(\'Are you sure?\')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
            ';
                return $deleteBtn;
            })
            ->addColumn('is_verified', function ($query) {
                if ($query->is_verified == 1) {

                    return '<i class="badge bg-success text-light">Yes</i>';
                } else {
                    return '<i class="badge bg-danger text-light">No</i>';
                }
            })
            ->rawColumns(['action', 'is_verified'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<NewsletterSubscriber>
     */
    public function query(NewsletterSubscriber $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('newslettersubscriber-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(120),
            Column::make('email'),
            Column::make('is_verified'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'NewsletterSubscriber_' . date('YmdHis');
    }
}