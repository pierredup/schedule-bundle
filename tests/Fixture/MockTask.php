<?php

namespace Zenstruck\ScheduleBundle\Tests\Fixture;

use Zenstruck\ScheduleBundle\Schedule\Task;
use Zenstruck\ScheduleBundle\Schedule\Task\Result;
use Zenstruck\ScheduleBundle\Schedule\Task\SelfRunningTask;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
final class MockTask extends Task implements SelfRunningTask
{
    private $result;

    public function __construct(string $description = 'my task')
    {
        parent::__construct($description);
    }

    public function __invoke(): Result
    {
        return $this->result;
    }

    public static function success(string $name = 'my task', string $output = null): self
    {
        $task = new self($name);
        $task->result = Result::successful($task, $output);

        return $task;
    }

    public static function failure(string $description = 'failure description', string $name = 'my task', string $output = null): self
    {
        $task = new self($name);
        $task->result = Result::failure($task, $description, $output);

        return $task;
    }

    public static function exception(\Throwable $e, string $name = 'my task', string $output = null): self
    {
        $task = new self($name);
        $task->result = Result::exception($task, $e, $output);

        return $task;
    }
}
