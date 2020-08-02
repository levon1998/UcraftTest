@extends('userPages.layout.app')

@section('title')
    Report
@endsection

@section('content')
    @php($request = app('request'))
    <aside class="col-sm-12 mt-3">
        <article class="card">
            <div class="card-body p-5">
                <form action="{{ route('report') }}">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Wallet</label>
                        <select class="form-control" name="wallet_id" id="exampleFormControlSelect1">
                            <option value="">Select Wallet</option>
                            @foreach ($wallets as $wallet)
                                <option value="{{ $wallet->id }}" {{ $request->input('wallet_id') == $wallet->id ? 'selected' : '' }}>{{ $wallet->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="number" name="min_amount" class="form-control" value="{{ $request->input('min_amount') }}" placeholder="Min Amount">
                            </div>
                            <div class="form-group">
                                <input type="date" name="start_date" class="form-control" value="{{ $request->input('start_date') }}" placeholder="Start Date">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="number" name="max_amount" class="form-control" value="{{ $request->input('max_amount') }}" placeholder="Max Amount">
                            </div>
                            <div class="form-group">
                                <input type="date" name="end_date" class="form-control" value="{{ $request->input('end_date') }}" placeholder="End Date">
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success" type="submit">Search</button>
                </form>

                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Wallet</th>
                        <th scope="col">Type</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Created Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($types = \App\Models\Transaction::TYPES)
                    @foreach ($transactions as $transaction)
                        <tr>
                            <th scope="row">{{ $transaction->id }}</th>
                            <td>{{ $transaction->wallet->name }}</td>
                            <td>{{ $types[$transaction->type] }}</td>
                            <td>{{ $transaction->amount}}</td>
                            <td>{{ $transaction->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </article>
    </aside>
@endsection