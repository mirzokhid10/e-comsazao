<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrderDataTable;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index(UserOrderDataTable $dataTable) {
        return $dataTable->render('frontend.dashboard.orders.index');
    }

    public function show(string $id) {
        $order = Order::findOrFail($id);
        return view('frontend.dashboard.orders.show', compact('order'));
    }
}
