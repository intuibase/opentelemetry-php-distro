 #pragma once



#include "LoggerInterface.h"
#include "transport/HttpTransportAsyncInterface.h"
#include "WorkerRegistry.h"

#include <memory>
#include <span>


namespace opentelemetry::php::coordinator {


class CoordinatorMessagesDispatcher {
public:
    CoordinatorMessagesDispatcher(std::shared_ptr<LoggerInterface> logger, std::shared_ptr<transport::HttpTransportAsyncInterface> httpTransport, std::shared_ptr<WorkerRegistry> workerRegistry) : logger_(std::move(logger)), httpTransport_(std::move(httpTransport)), workerRegistry_(std::move(workerRegistry)) {
    }

    ~CoordinatorMessagesDispatcher() = default;

    void processRecievedMessage(const std::span<const std::byte> data);

private:
    std::shared_ptr<LoggerInterface> logger_;
    std::shared_ptr<transport::HttpTransportAsyncInterface> httpTransport_;
    std::shared_ptr<WorkerRegistry> workerRegistry_;
};

}