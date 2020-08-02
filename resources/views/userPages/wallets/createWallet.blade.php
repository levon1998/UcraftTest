@extends('layouts.app')

@section('title')

@endsection

@section('content')
    <div class="container">
        <hr>

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
            <aside class="offset-sm-3 col-sm-6">


                <article class="card">
                    <div class="card-body p-5">

                        <p class="text-danger">Please create you first wallet until starting the work !!!</p>
                        <hr>

                        <form action="{{ route('storeFirstWallet') }}" method="post" role="form">

                            <p>Please choose the type of wallet:</p>
                            <div class="row">
                                <div class="col">
                                    <input type="radio" id="credit_card" name="type" value="{{ \App\Models\Wallet::TYPE_CREDIT_CARD }}" {{ old('type') == \App\Models\Wallet::TYPE_CREDIT_CARD ? 'checked' : '' }}>
                                    <label for="credit_card">Credit Card</label><br>
                                </div>
                                <div class="col">
                                    <input type="radio" id="cash" name="type" value="{{ \App\Models\Wallet::TYPE_CASH }}" {{ old('type') == \App\Models\Wallet::TYPE_CASH ? 'checked' : '' }}>
                                    <label for="cash">Cash</label><br>
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name (Example` Wallet 1)" value="{{ old('name') }}" required="">
                            </div>

                            {{ csrf_field() }}

                            <button class="subscribe btn btn-primary btn-block" type="submit"> Save And Continue</button>
                        </form>
                    </div>
                </article>
            </aside>
        </div>
    </div>
@endsection