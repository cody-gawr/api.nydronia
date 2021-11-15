<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function respond($data, int $status) {
        return Response::json($data, $status);
    }

    public function apiReply($data = null, int $status = HttpResponse::HTTP_OK) {
        return $this->respond($data, $status);
    }

    public function apiReject($data = null, int $status = HttpResponse::HTTP_EXPECTATION_FAILED) {
        return $this->respond($data, $status);
    }
}
