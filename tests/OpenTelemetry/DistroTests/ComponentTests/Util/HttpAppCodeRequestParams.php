<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\Util\HttpMethods;
use OpenTelemetry\DistroTests\Util\HttpSchemes;
use OpenTelemetry\DistroTests\Util\HttpStatusCodes;

final class HttpAppCodeRequestParams extends AppCodeRequestParams
{
    public const DEFAULT_HTTP_REQUEST_METHOD = HttpMethods::GET;
    public const DEFAULT_HTTP_REQUEST_URL_PATH = '/';

    public string $httpRequestMethod = self::DEFAULT_HTTP_REQUEST_METHOD;
    public UrlParts $urlParts;
    public ?int $expectedHttpResponseStatusCode = HttpStatusCodes::OK;

    public function __construct(HttpServerHandle $httpServerHandle, AppCodeTarget $appCodeTarget)
    {
        parent::__construct($httpServerHandle->spawnedProcessInternalId, $appCodeTarget);

        $this->urlParts = new UrlParts(scheme: HttpSchemes::HTTP, host: HttpServerHandle::CLIENT_LOCALHOST_ADDRESS, port: $httpServerHandle->getMainPort(), path: self::DEFAULT_HTTP_REQUEST_URL_PATH);
    }
}
