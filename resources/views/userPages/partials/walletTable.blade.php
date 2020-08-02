<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Type</th>
        <th scope="col">Total Amount</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @php ($types = \App\Models\Wallet::TYPES)
    @php ($total = 0)
    @foreach ($wallets as $wallet)
        @php($amount = $wallet->transactions()->sum('amount'))
        @php ($total += $amount)
        <tr class="row{{$wallet->id}}">
            <th scope="row">{{ $wallet->id }}</th>
            <td>{{ $wallet->name }}</td>
            <td>{{ $types[$wallet->type] }}</td>
            <td>{{ $amount }}</td>
            <td>
                <a href="{{ route('editWallet', [$wallet->id]) }}" type="button" class="btn btn-sm"><i class="fa fa-pencil"></i></a>
                <button type="button" class="btn btn-sm btn-danger removeWallet" data-id="{{ $wallet->id }}"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    @endforeach
        <tr>
            <td colspan="5">Total of All wallets is: {{$total}}</td>
        </tr>
    </tbody>
</table>