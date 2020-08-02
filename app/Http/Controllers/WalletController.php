<?php

namespace App\Http\Controllers;

use App\Http\Requests\Wallet\DeleteWalletRequest;
use App\Http\Requests\Wallet\StoreWalletRequest;
use App\Repositories\Wallet\WalletRepositoryInterface;

class WalletController extends Controller
{
    /**
     * @var
     */
    private $walletRepository;

    /**
     * WalletController constructor.
     * @param WalletRepositoryInterface $walletRepository
     */
    public function __construct(WalletRepositoryInterface $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    /**
     * Function to fetch all wallets
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $wallets = $this->walletRepository->paginated(25);

        return view('userPages.wallets.index', compact('wallets'));
    }

    /**
     * Function to return create view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('userPages.wallets.createOrEdit');
    }

    /**
     * Function to store wallet
     *
     * @param StoreWalletRequest $storeWalletRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreWalletRequest $storeWalletRequest)
    {
        $this->walletRepository->store($storeWalletRequest->validated());

        return redirect(route('wallets'));
    }

    /**
     * Function to fetch wallet by id and return edit view
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $wallet = $this->walletRepository->findById((int)$id);

        return view('userPages.wallets.createOrEdit', compact('wallet'));
    }

    /**
     * @param StoreWalletRequest $storeWalletRequest
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StoreWalletRequest $storeWalletRequest, $id)
    {
        $this->walletRepository->update($id, $storeWalletRequest->validated());

        return redirect(route('wallets'));
    }

    /**
     * Function to delete user wallet
     *
     * @param DeleteWalletRequest $storeWalletRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(DeleteWalletRequest $storeWalletRequest)
    {
        $this->walletRepository->deleteById($storeWalletRequest->validated()['id']);

        return response()->json(['data' => []]);
    }

    /**
     * Function to return create view for first wallet
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createWallet()
    {
        return view('userPages.wallets.createWallet');
    }
}
