<?php

namespace App\Http\Controllers\Backend;


use App\Models\Order;
use App\DataTables\OrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\ProcessedOrderDataTable;
use App\DataTables\DroppedOffOrderDataTable;
use App\DataTables\ShippedOrderDataTable;
use App\DataTables\OutForDeliveryOrderDataTable;
use App\DataTables\DeliveredOrderDataTable;
use App\DataTables\CanceledOrderDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable) {
        return $dataTable->render('admin.order.index');
    }

    public function pendingOrders(PendingOrderDataTable $dataTable) {
        return $dataTable->render('admin.order.pending-orders');
    }

    public function processedOrders(ProcessedOrderDataTable $dataTable) {
        return $dataTable->render('admin.order.processed-orders');
    }

    public function droppedOffOrders(DroppedOffOrderDataTable $dataTable) {
        return $dataTable->render('admin.order.dropped-off-orders');
    }

     public function shippedOrders(ShippedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.shipped-orders');
    }

    public function outForDeliveryOrders(OutForDeliveryOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.out-for-delivery-orders');
    }

    public function deliveredOrders(DeliveredOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.delivered-orders');
    }

    public function canceledOrders(CanceledOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.canceled-orders');
    }

    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);

        // delete order products
        $order->orderProducts()->delete();
        // delete transaction
        $order->transaction()->delete();

        $order->delete();

        notify()->success('Order has been deleted');
        return redirect()->route('admin.order.index');
    }

    public function changeOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();

        return response(['status' => 'success', 'message' => 'Updated Order Status']);
    }

    public function changePaymentStatus(Request $request)
    {
        $paymentStatus = Order::findOrFail($request->id);
        $paymentStatus->payment_status = $request->status;
        $paymentStatus->save();

        return response(['status' => 'success', 'message' => 'Updated Payment Status Successfully']);
    }

}
