<?php

namespace App\DataTables;

use App\Models\ProductImageGallery;
use App\Models\VendorProductImageGallery;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductImageGalleriesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<VendorProductImageGallery> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $deleteBtn = "
                <form method='POST' action='" . route('vendor.products-image-gallery.destroy', $query->id) .  "' style='display:inline-block;' onsubmit='return confirm(\"Are you sure?\")'>
                    " . csrf_field() . method_field('DELETE') . "
                    <button type='submit' class='btn btn-danger ml-2' style='background:#fc544b;'><i class='far fa-trash-alt'></i></button>
                </form>";
                return $deleteBtn;
            })
            ->addColumn('image', function ($query) {
                return "<img style='width:100px;' src='" . asset($query->image) . "' ></img>";
            })
            ->rawColumns(['image', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<VendorProductImageGallery>
     */
    public function query(ProductImageGallery $model): QueryBuilder
    {
        return $model->where('product_id', request()->product)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproductimagegalleries-table')
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
            Column::make('id')->width(100),
            Column::make('image'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(400)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProductImageGalleries_' . date('YmdHis');
    }
}
