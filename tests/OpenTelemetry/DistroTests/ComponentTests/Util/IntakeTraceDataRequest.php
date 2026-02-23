<?php

/** @noinspection PhpInternalEntityUsedInspection */

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\ComponentTests\Util\OtlpData\ExportTraceServiceRequest;
use OpenTelemetry\DistroTests\ComponentTests\Util\OtlpData\OTelResource;
use OpenTelemetry\DistroTests\ComponentTests\Util\OtlpData\Span;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;
use OpenTelemetry\Contrib\Otlp\ProtobufSerializer;
use Opentelemetry\Proto\Collector\Trace\V1\ExportTraceServiceRequest as OTelProtoExportTraceServiceRequest;
use Override;

final class IntakeTraceDataRequest extends IntakeDataRequestDeserialized
{
    use LoggableTrait;

    private function __construct(
        IntakeDataRequestRaw $raw,
        private readonly ExportTraceServiceRequest $deserialized,
    ) {
        parent::__construct($raw);
    }

    public static function deserializeFromRaw(IntakeDataRequestRaw $raw): self
    {
        $serializer = ProtobufSerializer::getDefault();
        $otelProtoRequest = new OTelProtoExportTraceServiceRequest();
        $serializer->hydrate($otelProtoRequest, $raw->body);

        return new self($raw, ExportTraceServiceRequest::deserializeFromOTelProto($otelProtoRequest));
    }

    #[Override]
    public function isEmptyAfterDeserialization(): bool
    {
        return $this->deserialized->isEmptyAfterDeserialization();
    }

    /**
     * @return iterable<Span>
     */
    public function spans(): iterable
    {
        yield from $this->deserialized->spans();
    }

    /**
     * @return iterable<OTelResource>
     */
    public function resources(): iterable
    {
        yield from $this->deserialized->resources();
    }
}
