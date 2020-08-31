<?php
namespace App\Services;

/**
 * Class BaseService
 * @package App\Service
 */
class BaseService
{
    protected $errorMessage;

    public function getErrorMessage()
    {
        return $this->errorMessage ?? trans('messages.error.system');
    }

    protected function setErrorMessage(string $message)
    {
        $this->errorMessage = ($message !== '') ? $message : trans('messages.error.system');
    }
}
