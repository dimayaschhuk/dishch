<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="backoffice.mobimill.com:8086/api/v1",
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="LNZ",
 *         description="JWT_REFRESH_TTL=999999 JWT_TTL=999999",
 *         termsOfService="",
 *         @SWG\License(
 *             name="Private License",
 *         )
 *     ),
 *  )
 */
class ApiController extends Controller
{
    const SUCCESS_STATUS = 'success';
    const ERROR_STATUS = 'error';

    private $status = self::SUCCESS_STATUS;
    private $data = [];
    private $message = '';
    private $code = 200;
    protected $cacheTime = '';

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setErrorStatus($errorCode = 200)
    {
        $this->code = $errorCode;
        $this->status = self::ERROR_STATUS;
    }

    public function setData($data)
    {
        if (is_assoc($data)) {
            $resp = new \stdClass();
            foreach ($data as $key => $value) {
                $resp->$key = $value;
            }

            $data = $resp;
        }

        $this->data = $data;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getResponse()
    {
        return get_json_response_data($this->status, $this->message, $this->data, $this->code);
    }
}
