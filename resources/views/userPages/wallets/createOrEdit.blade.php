@extends('userPages.layout.app')

@section('title')
    {{isset($wallet) ? "Edit {$wallet->name} Wallet" : "Create Wallet" }}
@endsection

@section('content')
    <div class="container">
        <hr>
        <div class="">
            <a href="{{ route('wallets') }}" class="pull-right btn btn-default">Back</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <aside class="col-sm-12">
                <article class="card">
                    <div class="card-body p-5">

                        @php ($action = isset($wallet) ? route('updateWallet', [$wallet->id]):route('storeWallet'))
                        @php ($typeCreditCard = \App\Models\Wallet::TYPE_CREDIT_CARD)
                        @php ($typeCash = \App\Models\Wallet::TYPE_CASH)
                        <form action="{{ $action }}" method="post" role="form">

                            <p>Please choose the type of wallet:</p>
                            <div class="row">
                                <div class="col">
                                    <input type="radio" id="credit_card" name="type" value="{{ $typeCreditCard }}" {{ isset($wallet) && $wallet->type == $typeCreditCard ? 'checked' : '' }}>
                                    <label for="credit_card">Credit Card</label><br>
                                </div>
                                <div class="col">
                                    <input type="radio" id="cash" name="type" value="{{ $typeCash }}" {{ isset($wallet) && $wallet->type == $typeCash ? 'checked' : '' }}>
                                    <label for="cash">Cash</label><br>
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name (Example` Wallet 1)" value="{{ $wallet->name ?? '' }}" required="">
                            </div>

                            {{ csrf_field() }}

                            <button class="subscribe btn btn-primary btn-block" type="submit"> Save And Continue</button>
                        </form>
                    </div>
                </article>
            </aside>

            @include('userPages.wallets.transactions')
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const deleteRoute = "{{ route('deleteWallet') }}"
    </script>
    <script src="{{ asset('/js/custom/wallet.js') }}"></script>
@endsection