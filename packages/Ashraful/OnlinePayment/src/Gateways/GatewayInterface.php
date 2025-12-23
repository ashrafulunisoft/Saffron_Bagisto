<?php

namespace Ashraful\OnlinePayment\Gateways;

use Illuminate\Http\Request;

interface GatewayInterface
{
    public function redirect();
    public function success(Request $request);
    public function fail();
    public function cancel();
}
