@if (isset($wallet))
    <aside class="col-sm-12 mt-3">
        <article class="card">
            <div class="card-body p-5">
                <div class="row justify-content-sm-between">
                    <p>Total: {{ $wallet->transactions->sum('amount') }}</p>
                    <button class="btn btn-success addTransaction"><i class="fa fa-plus"></i> Add</button>
                </div>
                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Type</th>
                        <th scope="col">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($types = \App\Models\Transaction::TYPES)
                    @foreach ($wallet->transactions as $transaction)
                        <tr>
                            <th scope="row">{{ $transaction->id }}</th>
                            <td>{{ $types[$transaction->type] }}</td>
                            <td>{{ $transaction->amount}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </article>
    </aside>

    <div class="modal fade" id="addTransactionModal" role="dialog">
        <div class="modal-dialog">

            @php ($typeCredit = \App\Models\Transaction::TYPE_CREDIT)
            @php ($typeDebit = \App\Models\Transaction::TYPE_DEBIT)
            <form action="{{ route('storeTransaction') }}" method="post" role="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Transaction! </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Please choose the type of record:</p>
                        <div class="row">
                            <div class="col">
                                <input type="radio" id="credit" name="type" value="{{ $typeCredit }}">
                                <label for="credit">{{ \App\Models\Transaction::TYPES[$typeCredit] }}</label><br>
                            </div>
                            <div class="col">
                                <input type="radio" id="debit" name="type" value="{{ $typeDebit }}">
                                <label for="debit">{{ \App\Models\Transaction::TYPES[$typeDebit] }}</label><br>
                            </div>
                        </div>
                        <br>

                        <p>Please choose the operation:</p>
                        <div class="row">
                            <div class="col">
                                <input type="radio" id="add" name="is_add" value="1">
                                <label for="add">Add Money</label><br>
                            </div>
                            <div class="col">
                                <input type="radio" id="remove" name="is_add" value="0">
                                <label for="remove">Remove Money</label><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" name="amount" placeholder="2500.10" required="">
                        </div>
                        <input type="hidden" value="{{ $wallet->id }}" name="wallet_id">
                        {{ csrf_field() }}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" >Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endif

