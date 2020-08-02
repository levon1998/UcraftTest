@extends('userPages.layout.app')

@section('title')
    My Wallets
@endsection

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-between">
            <h2>My Wallets</h2>
            <a href="{{ route('addWallet') }}" class="btn btn-success"><i class="fa fa-plus"></i> Create</a>
        </div>

        <br>
        <div class="panel panel-default">
            <p>Choose card for add or remove records.</p>
            <div class="panel-body">
                @include('userPages.partials.walletTable')
            </div>
        </div>
        {{ $wallets->links() }}
    </div>
@endsection

@section('scripts')
    <script>
        const deleteRoute = "{{ route('deleteWallet') }}"
    </script>
    <script src="{{ asset('/js/custom/wallet.js') }}"></script>
@endsection