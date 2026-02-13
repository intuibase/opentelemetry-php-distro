#pragma once


#include "LoggerInterface.h"
#include "ForkableInterface.h"
#include <functional>
#include <memory>

namespace opentelemetry::php::coordinator {

class WorkerRegistrar : public ForkableInterface {
public:
    using sendPayload_t = std::function<bool(std::string const &payload)>;

    WorkerRegistrar(std::shared_ptr<LoggerInterface> logger, sendPayload_t sendPayload) : logger_(std::move(logger)), sendPayload_(std::move(sendPayload)) {
    }

    ~WorkerRegistrar() {
        unregisterWorker();
    }

    void prefork() final {
    }

    void postfork([[maybe_unused]] bool child) final {
        if (child) {
            registerWorker();
        }
    }

private:
    void registerWorker();
    void unregisterWorker();

    std::shared_ptr<LoggerInterface> logger_;
    sendPayload_t sendPayload_;

};

}