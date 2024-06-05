@extends('frontend.master.master');
@section('title')
chat
@endsection

@section('content')

<div class="container  my-5" style="margin-bottom: 10rem">
    <h1 class="mb-4">Chat</h1>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Messages
        </div>
        <div class="card-body">
            <div class="messages mb-4">
                @foreach($messages as $message)
                    <div class="message {{ $message->sender_id == Auth::id() ? 'sent' : 'received' }} mb-2 p-2 rounded" style="background-color: {{ $message->sender_id == Auth::id() ? '#d1e7dd' : '#f8d7da' }};">
                        <p class="mb-0"><strong>{{ $message->sender->name }}:</strong> {{ $message->message }}</p>
                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>

            <form action="{{ route('chat.send') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="receiver_id" class="form-label">To:</label>
                    <select name="receiver_id" class="form-select" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea name="message" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    .message.sent {
        background-color: #d1e7dd;
    }

    .message.received {
        background-color: #f8d7da;
    }
</style>

