<?php

namespace App\Http\Middleware;

use App\Models\Payment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UnpaidOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get user_id from route parameter
        $user_id = $request->route('user_id');

        // Find the payment record for this user
        $payment = Payment::where('user_id', $user_id)->where('status', '!=', 'completed')->first();

        // If no unpaid payment exists, redirect to login
        if (!$payment) {
            return redirect()
                ->route('loginPage.view')
                ->with('error', 'No pending payment found or payment already completed');
        }
        return $next($request);
    }
}
