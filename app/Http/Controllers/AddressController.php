<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Services\AddressService;


class AddressController extends Controller
{
    public function index() {

    }

    public function store(CreateAddressRequest $request, AddressService $address) {
        return $address->create($request->user(), collect($request->validated()));
    }
}
