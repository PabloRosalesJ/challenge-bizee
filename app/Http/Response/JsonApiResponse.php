<?php
namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

trait JsonApiResponse
{
    private function makeResponse(string $message, $data, int $status, $errors = [], array $headers = []): JsonResponse
    {
        $success = true;
        $response = compact('message', 'data');

        if($status >= 400) {
            $response['errors'] = $errors;
            unset($response['data']);
        }

        if($status >= 500) {
            $response['success'] = false;
        }

        return response()->json(
            $response,
            $status,
            $headers
        );
    }

    public function success(string $message = 'Success', $data = [], int $code = 200) {
        return $this->makeResponse(message: $message, data: $data, status: $code);
    }

    public function error(string $message = 'Ha ocurrido un error.', array $errors = [], int $code = 500) {
        return $this->makeResponse(message: $message, errors: $errors, status: $code, data: []);
    }
}
