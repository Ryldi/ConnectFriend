<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showRegistrationPaymentPage($user_id)
    {
        $payment = Payment::with('user')->where('user_id', $user_id)->first();
        return view('main.RegistrationPaymentPage', ['payment' => $payment]);
    }

    public function processRegistrationPayment(Request $request, $user_id)
    {
        $totalPayment = Payment::with('user')->where('user_id', $user_id)->first();

        $request->validate([
            'amount_paid' => 'required|numeric|min:0'
        ]);

        $amountPaid = $request->amount_paid;
        $unpaidAmount = $totalPayment->amount;

        if ($amountPaid < $unpaidAmount) {
            return redirect()->back()->with('underpaid', 'You are still underpaid '.($unpaidAmount-$amountPaid))->withInput();
        }

        if ($amountPaid > $unpaidAmount) {
            if ($request->has('yes') || $request->has('no')) {
                if ($request->has('yes')) {
                    $overpaidAmount = $amountPaid-$unpaidAmount;
                    $user = User::find($user_id);

                    $user->coins += $overpaidAmount;
                    $user->save();

                    $totalPayment->status = 'Completed';
                    $totalPayment->save();

                    return redirect()->route('login')->with('success', 'Registration successful! '.$overpaidAmount.' coins added to your balance.');
                }
                
                if ($request->has('no')) {
                    session()->forget('overpaid');
                    return redirect()->back();
                }
            }
            return redirect()->back()->with('overpaid', 'Sorry you overpaid '.($amountPaid - $unpaidAmount).', would you like to enter a balance?')->withInput();
        }

        $totalPayment->status = 'completed';
        $totalPayment->paid_amount = $amountPaid;
        $totalPayment->save();

        return redirect()->route('login')
            ->with('success', 'Registration successful!');
    }

    public function handleOverpayment(Request $request)
    {
        dd($request);
        // $user = Auth::user();
        // $overpaidAmount = $request->input('overpaidAmount'); // you can send this value from the form

        // // Update the user's wallet or balance here
        // $user->coins += $overpaidAmount;
        // $user->save();

        // return redirect()->route('paymentPage.view')->with('success', 'Your excess payment has been added to your wallet!');
    }

    public function topup()
    {
        $user = User::find(Auth::user()->id);
        $user->coins += 100;
        $user->save();
        
        return redirect()->back()->with('sent', (session('locale') == 'en') ? 'Topup successful!' : 'Topup berhasil!');
    }
}
