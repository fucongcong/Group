<?php
use src\Services\Group\Impl\GroupServiceImpl;

class Cmd implements PluginBase
{

    public function run($task)
    {
        $cmd = $task["cmd"];

        $status = 0;
        Main::log_write($cmd . ",已执行 status:" . $status);
        $groupService = new GroupServiceImpl();
        $groupId = $groupService -> getGroup(1);
        exec($cmd, $output, $status);
        Main::log_write($cmd . ",已执行.groupId:{$groupId} status:" . $status);
        exit($status);
    }
}