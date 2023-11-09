<?php


namespace App\Traits;


use App\Constants\ErrorCode;
use Illuminate\Http\JsonResponse;
use  \Illuminate\Http\Response as HttpResponse;

trait ApiResponse
{
    /**
     * @param $data
     * @param array $header
     * @return JsonResponse
     */
    public function success($data = [], array $header = []): JsonResponse
    {
        return $this->response(HttpResponse::HTTP_OK, 'success', $data, $header);
    }


    /**
     * @param int $code
     * @param string $message
     * @param array $data
     * @param array $header
     * @return JsonResponse
     */
    public function error(int $code, string $message = '', $data = [], array $header = []): JsonResponse
    {
        return $this->response($code, $message, $data, $header);
    }


    /**
     * @param int $code
     * @param string $message
     * @param $data
     * @param array $header
     * @param int $options
     * @return JsonResponse
     */
    protected function response(int $code, string $message, $data, array $header = [], int $options = 0): JsonResponse
    {
        if (!$message) {
            if (isset(ErrorCode::CODE_MESSAGE[$code])) {
                $message = ErrorCode::CODE_MESSAGE[$code];
            } elseif (isset(HttpResponse::$statusTexts[$code])) {
                $message = HttpResponse::$statusTexts[$code];
            } else {
                $message = 'service error';
            }
        }

        $response = [
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ];
        $status   = $code > 1000 ? HttpResponse::HTTP_OK : $code;
        return response()->json($response, $status, $header, $options);
    }
}