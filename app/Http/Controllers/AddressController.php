<?php
namespace App\Http\Controllers;

use App\Http\Requests\AddressCreateRequest;
use App\Http\Requests\AddressUpdateRequest;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class AddressController extends Controller
{
    public function index(Request $request, AddressService $address) {
        return $address->all($request->user());
    }

    public function store(AddressCreateRequest $request, AddressService $address) {
        return $address->create($request->user(), collect($request->validated()));
    }

    public function patch(AddressUpdateRequest $request, Address $address, AddressService $addressService){
        return $addressService->update($address, $request->validated());
    }

    public function delete(Request $request, Address $address, AddressService $addressService){
        Gate::authorize('delete', $address);
        return $addressService->delete($request->user(), $address);
    }

    public function show(Request $request, Address $address, AddressService $addressService) {
        Gate::authorize('view', $address);
        return $addressService->get($address);

    }
}
