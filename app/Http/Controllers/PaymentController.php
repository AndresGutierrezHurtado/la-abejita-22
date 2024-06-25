<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\PaymentDetail;
use App\Models\SoldProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function form() {
        $cart = session()->get('cart', []);
        foreach ($cart as &$item) {
            $item['product'] = Product::with('sizes')->findOrFail($item['product_id']);

            $item['size_name'] = Size::findOrFail($item['size_id'])->size_name;
            $item['size_price'] = $item['product']->sizes->firstWhere('size_id', $item['size_id'])->pivot->product_size_price;
        }

        return view('pay.payform', compact('cart'));
    }

    public function callback(Request $request)
    {
        $cart = session()->get('cart', []);


        // Extraer la información necesaria de la solicitud de PayU
        $referenceCode = $request->input('referenceCode');
        $transactionId = $request->input('transactionId');
        $buyerEmail = $request->input('buyerEmail');
        $paymentAmount = $request->input('TX_VALUE');
        $paymentState = $request->input('polTransactionState');
        $paymentMethod = $request->input('polPaymentMethodType');
        $paymentDescription = $request->input('lapResponseCode');

        if ($paymentState != 4) { 
            return redirect()->to('/profile/user')->withError('Hubo un error al procesar la orden.'); 
        }

        DB::beginTransaction();

        try {
            $order = new Order();
            $order->user_id = Auth::user()->user_id; 
            $order->save();

            // Guardar los detalles del pago
            $paymentDetail = new PaymentDetail();
            $paymentDetail->order_id = $order->order_id;
            $paymentDetail->payment_state = $paymentState;
            $paymentDetail->payment_method = $paymentMethod;
            $paymentDetail->payment_amount = $paymentAmount;
            $paymentDetail->payment_buyer_email = $buyerEmail;
            $paymentDetail->payment_description = $paymentDescription;
            $paymentDetail->save();

            // Guardar los productos vendidos
            foreach ($cart as $item) {
                $soldProduct = new SoldProduct();
                $soldProduct->order_id = $order->order_id;
                $soldProduct->product_id = $item['product_id'];
                $soldProduct->size_id = $item['size_id'];
                $soldProduct->product_quantity = $item['product_quantity'];
                $soldProduct->save();
            }

            DB::commit();
            session()->forget('cart');
            Session::flash('payment_status', 'la compra fue realizada con éxito');
            return redirect()->to('/profile/user');
            // return redirect()->route('order.confirmation', ['order_id' => $order->order_id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->to('/profile/user')->withError('Hubo un error al procesar la orden.');
        }
    }
}
