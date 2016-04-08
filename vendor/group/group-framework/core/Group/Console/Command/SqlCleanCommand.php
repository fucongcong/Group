<?php

namespace Group\Console\Command;

use Group\Console\Command as Command;
use Filesystem;
use Config;

class SqlCleanCommand extends Command
{
    public function init()
    {   
        $dir = __ROOT__."app";
        $filesystem = new Filesystem();
        $filesystem -> remove($dir."/sql/sql.lock");

        $this -> outPut("lock文件删除成功");
    }
}
