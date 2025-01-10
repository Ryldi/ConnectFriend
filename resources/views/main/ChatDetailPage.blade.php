@extends('layout.master')
@section('content')
<div class="container">
    <a href="{{ route('chatPage.view') }}" class="btn btn-primary mb-3">Back</a>

    <div class="mb-3" style="border: 1px solid #ccc; padding: 10px; height: 400px; overflow-y: scroll;">
        <div class="fw-semibold p-2 mb-3 fs-3 border-bottom">{{ $receiver->name }}</div>
        @if (!$messages->isEmpty())
            @foreach ($messages as $message)
                @if ($message->sender_id == Auth::user()->id)
                    <div class="d-flex justify-content-end mb-3 gap-2">
                        <div class="max-w-70 px-2 py-1 rounded-3 text-end" style="background-color: #d1e7dd">
                            <p class="my-1" style="font-size: 16px">{{ $message->message }}</p>
                            <small style="font-size: 12px">{{ $message->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                        <img src="{{ (Auth::user()->avatar == null) ? asset('images/starterAvatar.jpg') : asset('images/avatar/' . Auth::user()->avatar)  }}" alt="" class="rounded-circle" width="30" height="30">
                    </div>
                @else
                    <div class="d-flex justify-content-start mb-3 gap-2">
                        <img src="{{ ($receiver->avatar == null) ? asset('images/starterAvatar.jpg') : asset('images/avatar/' . $receiver->avatar)  }}" alt="" class="rounded-circle" width="30" height="30">
                        <div class="max-w-70 px-2 py-1 rounded-3 text-start" style="background-color: #f8d7da">
                            <p class="my-1" style="font-size: 16px">{{ $message->message }}</p>
                            <small style="font-size: 12px">{{ $message->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div style="text-align: center;">No message yet! Start your chat with {{ $receiver->name }}</div>
        @endif
    </div>
    <form method="POST" action="{{ route('chatDetailPage.send', ['receiver_id' => $receiver->id]) }}">
        @csrf
        <div class="mb-3">
            <textarea name="message" class="form-control" rows="3" placeholder="Type your message here..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Send</button>
    </form>

</div>
@endsection
