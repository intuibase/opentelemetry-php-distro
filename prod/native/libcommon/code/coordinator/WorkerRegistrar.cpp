#include "WorkerRegistrar.h"

#include "os/OsUtils.h"
#include "coordinator/proto/CoordinatorCommands.pb.h"

namespace opentelemetry::php::coordinator {

void WorkerRegistrar::registerWorker() {
    coordinator::WorkerStartedCommand command;
    command.set_process_id(osutils::getCurrentProcessId());
    command.set_parent_process_id(osutils::getParentProcessId());

    coordinator::CoordinatorCommand coordCommand;
    coordCommand.set_type(coordinator::CoordinatorCommand::WORKER_STARTED);
    *coordCommand.mutable_worker_started() = command;

    if (!sendPayload_(coordCommand.SerializeAsString())) {
        ELOG_DEBUG(logger_, COORDINATOR, "WorkerRegistrar: failed to send worker registration message to coordinator process");
    } else {
        ELOG_DEBUG(logger_, COORDINATOR, "WorkerRegistrar: sent worker registration message to coordinator process");
    }
}

void WorkerRegistrar::unregisterWorker() {
    coordinator::WorkerIsGoingToShutdownCommand command;
    command.set_process_id(osutils::getCurrentProcessId());
    command.set_parent_process_id(osutils::getParentProcessId());

    coordinator::CoordinatorCommand coordCommand;
    coordCommand.set_type(coordinator::CoordinatorCommand::WORKER_IS_GOING_TO_SHUTDOWN);
    *coordCommand.mutable_worker_is_going_to_shutdown() = command;

    if (!sendPayload_(coordCommand.SerializeAsString())) {
        ELOG_DEBUG(logger_, COORDINATOR, "WorkerRegistrar: failed to send worker unregister message");
    } else {
        ELOG_DEBUG(logger_, COORDINATOR, "WorkerRegistrar: sent worker unregistration message to coordinator process");
    }
}

}