<?php
/**
 * Copyright (C) 2018. Huawei Technologies Co., LTD. All rights reserved.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of Apache License, Version 2.0.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * Apache License, Version 2.0 for more details.
 */

namespace SMN\Request\Sms;

use Http\Http as Http;
use SMN\Common\Constants as Constants;
use SMN\Exception\SMNException as SMNException;
use SMN\Request\AbstractRequest as AbstractRequest;

/**
 * Class SmsPublishRequest
 * the request message for sms publish
 * @package SMN\Request\Auth
 * @author zhangyx
 * @version 1.1.0
 */
class SmsPublishRequest extends AbstractRequest
{
    private $endpoint;
    private $message;
    private $signId;
    private $messageIncludeSignFlag = false;

    public function getUrl()
    {
        if (empty($this->message)) {
            throw new SMNException("SDK.SmsPublishRequestException", "SmsPublishRequestException : No Message!");
        }

        if (empty($this->endpoint)) {
            throw new SMNException("SDK.SmsPublishRequestException", "SmsPublishRequestException : phone number is invalid");
        }

        if (!$this->messageIncludeSignFlag && empty($this->signId)) {
            throw new SMNException("SDK.SmsPublishRequestException", "SmsPublishRequestException : sign id is null.");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}'), array($this->projectId), Constants::SMS_PUBLISH_API_URI));
        return join($url);
    }

    public function getMethod()
    {
        return Http::POST;
    }

    /**
     * @param mixed $endpoint
     * @return $this
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        $this->bodyParams["endpoint"] = $endpoint;
        return $this;
    }

    /**
     * @param mixed $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        $this->bodyParams["message"] = $message;
        return $this;
    }

    /**
     * @param mixed $signId
     * @return $this
     */
    public function setSignId($signId)
    {
        $this->signId = $signId;
        $this->bodyParams["sign_id"] = $signId;
        return $this;
    }

    /**
     * @param bool $messageIncludeSignFlag
     * @return $this
     */
    public function setMessageIncludeSignFlag($messageIncludeSignFlag)
    {
        $this->messageIncludeSignFlag = $messageIncludeSignFlag;
        $this->bodyParams["message_include_sign_flag"] = $messageIncludeSignFlag;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMessageIncludeSignFlag()
    {
        return $this->messageIncludeSignFlag;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getSignId()
    {
        return $this->signId;
    }
}
