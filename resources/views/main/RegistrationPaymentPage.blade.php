@extends('layout.master')
@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card p-4" style="width: 450px; border-radius: 10px;">
            <h1 class="text-center">Registration Payment</h1>
            @if (session('underpaid'))
                <div class="alert alert-warning mt-3">{{ session('underpaid') }}</div>
            @endif

            @if ($payment->status != "Completed")
                <form action="{{ route('registrationPaymentPage.process', ['user_id' => $payment->user->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="amount_paid">Unpaid Amount</label>
                        <input type="text" class="form-control" name="unpaid_amount" id="unpaid_amount" value="{{$payment->amount}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="amount_paid">Amount Paid</label>
                        <input type="text" class="form-control" name="amount_paid" id="amount_paid" value="{{old('amount_paid')}}">
                        @error('amount_paid')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (session('overpaid'))
                        <div class="text-warning mt-3">{{ session('overpaid') }}</div>
                        <div class="d-flex justify-content-center gap-2 my-3">
                            <button type="submit" class="btn btn-primary w-30" name="yes" value="yes">Yes</button>
                            <button type="submit" class="btn btn-secondary w-30" name="no" value="no">No</button>
                        </div>
                    @endif
                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-100">Pay Registration</button>
                    </div>    
                </form>
            @endif
        </div>
    </div>
@endsection