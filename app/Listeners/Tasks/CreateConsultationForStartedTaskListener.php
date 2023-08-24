<?php

namespace App\Listeners\Tasks;

use App\Events\TaskStartedEvent;
use App\Enums\Tasks\TaskTypeEnum;
use App\Enums\Tasks\TaskActionEnum;
use App\Actions\Tasks\AssignTaskAction;
use App\Actions\Tasks\AttachTaskActionableAction;
use App\Actions\Consultations\CreateConsultationAction;

class CreateConsultationForStartedTaskListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TaskStartedEvent $event)
    {
        $task = $event->task;
        if ($task->type == TaskTypeEnum::CONSULTATION && $task->action == TaskActionEnum::CREATE){
            $details = 'auto assigned from previous task';
            $consultation = (new CreateConsultationAction)->run($task->assignedTo, $task->due_at);
            (new AttachTaskActionableAction)->run($task, $consultation);
            (new AssignTaskAction)->assignedBy($task->assignedBy)
                ->type(TaskTypeEnum::CONSULTATION)->action(TaskActionEnum::START)
                ->parent($task)
                ->run($consultation, $task->assignedTo, $details, $task->due_at);
        }
    }
}
