<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\Util\HttpMethods;
use OpenTelemetry\DistroTests\Util\HttpStatusCodes;
use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;
use PHPUnit\Framework\Assert;
use Psr\Http\Message\ResponseInterface;

class HttpServerHandle implements LoggableInterface
{
    use LoggableTrait;

    public const CLIENT_LOCALHOST_ADDRESS = '127.0.0.1';
    public const SERVER_LOCALHOST_ADDRESS = self::CLIENT_LOCALHOST_ADDRESS;
    public const STATUS_CHECK_URI_PATH = TestInfraHttpServerProcessBase::BASE_URI_PATH . 'status_check';
    public const PID_KEY = 'pid';

    /**
     * @param int[] $ports
     */
    public function __construct(
        public readonly string $dbgProcessName,
        public readonly int $spawnedProcessOsId,
        public readonly string $spawnedProcessInternalId,
        public readonly array $ports
    ) {
    }

    public function getMainPort(): int
    {
        Assert::assertNotEmpty($this->ports);
        return $this->ports[0];
    }

    /**
     * @param array<string, string> $headers
     */
    public function sendRequest(string $httpMethod, string $path, array $headers = []): ResponseInterface
    {
        return HttpClientUtilForTests::sendRequest(
            $httpMethod,
            new UrlParts(port: $this->getMainPort(), path: $path),
            new TestInfraDataPerRequest(spawnedProcessInternalId: $this->spawnedProcessInternalId),
            $headers
        );
    }

    public function signalAndWaitForItToExit(): void
    {
        $response = $this->sendRequest(HttpMethods::POST, TestInfraHttpServerProcessBase::EXIT_URI_PATH);
        Assert::assertSame(HttpStatusCodes::OK, $response->getStatusCode());

        $hasExited = ProcessUtil::waitForProcessToExitUsingPid($this->dbgProcessName, $this->spawnedProcessOsId, /* maxWaitTimeInMicroseconds - 10 seconds */ 10 * 1000 * 1000);
        Assert::assertTrue($hasExited);
    }
}
