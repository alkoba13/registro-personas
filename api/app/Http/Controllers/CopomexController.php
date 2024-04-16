<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CopomexController extends Controller
{
    private $host;
    private $apiKey;

    /**
     * Initialize Api Key
     */
    public function __construct()
    {
        $this->host = env('COPOMEX_HOST');
        $this->apiKey = env('COPOMEX_API_KEI');
    }

    /**
     * @OA\Get(
     *     path="/api/validateCP/{postalCode}",
     *     tags={"Copomex"},
     *     @OA\Parameter(
     *         name="postalCode",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     summary="Validate Postal code and get state",
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(
     *         response=400,
     *         description="BAD REQUEST."
     *     )
     * )
     */
    public function validateCPAndGetState($postalCode)
    {
        $response = Http::get($this->host . '/info_cp/' . $postalCode . '?type=simplified&token=' . $this->apiKey);

        if ($response->status() !== Config('codes.SUCCESS')) {
            return resp(
                'codes.BAD_REQ',
                'The server cannot not process the request due to be a client error',
                $response->json()
            );
        }

        return resp('codes.SUCCESS', 'success', $response->json());
    }
}
