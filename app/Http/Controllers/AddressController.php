<?php
namespace App\Http\Controllers;

use App\Http\Requests\AddressCreateRequest;
use App\Http\Requests\AddressUpdateRequest;
use App\Models\Address;
use App\Services\AddressService;


class AddressController extends Controller
{
    public function index(): void {

    }

    public function store(AddressCreateRequest $request, AddressService $address) {
        return $address->create($request->user(), collect($request->validated()));
    }

    public function patch(AddressUpdateRequest $request, Address $address, AddressService $addressService){
        return $addressService->update($address, $request->validated());
    }
}
