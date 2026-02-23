<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\Util\ClassNameUtil;
use OpenTelemetry\DistroTests\Util\HttpMethods;
use OpenTelemetry\DistroTests\Util\HttpStatusCodes;
use PHPUnit\Framework\Assert;

final class ResourcesCleanerHandle extends HttpServerHandle
{
    private ResourcesClient $resourcesClient;

    public function __construct(HttpServerHandle $httpSpawnedProcessHandle)
    {
        parent::__construct(
            ClassNameUtil::fqToShort(ResourcesCleaner::class) /* <- dbgServerDesc */,
            $httpSpawnedProcessHandle->spawnedProcessOsId,
            $httpSpawnedProcessHandle->spawnedProcessInternalId,
            $httpSpawnedProcessHandle->ports
        );

        $this->resourcesClient = new ResourcesClient($this->spawnedProcessInternalId, $this->getMainPort());
    }

    public function getClient(): ResourcesClient
    {
        return $this->resourcesClient;
    }

    public function cleanTestScoped(): void
    {
        $response = $this->sendRequest(HttpMethods::POST, TestInfraHttpServerProcessBase::CLEAN_TEST_SCOPED_URI_PATH);
        Assert::assertSame(HttpStatusCodes::OK, $response->getStatusCode());
    }
}
