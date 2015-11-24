<?php
namespace core\Group\Console\Command;

use core\Group\Console\Command as Command;
use Filesystem;
use FileCache;
use Dao;

class SqlMigrateCommand extends Command
{
    protected $fileList = [];

    public function init()
    {
        $sqlDir = __ROOT__."app/sql/";

        $lock = FileCache::isExist("sql.lock", $sqlDir);
        if($lock) {
            $this -> fileList = FileCache::get("sql.lock", $sqlDir);
        }

        if (is_dir($sqlDir)) {

            $dir = opendir($sqlDir);

            while (($file = readdir($dir)) !== false)
            {
                $file = explode(".", $file);

                $fileName = $file[0];

                if ($fileName && isset($file[1]) && $file[1] == "php") {

                    $this -> isLockFile($fileName);
                }
            }
            closedir($dir);
        }

        FileCache::set("sql.lock", $this -> fileList, $sqlDir);
    }

    private function isLockFile($file)
    {
        $fileList = $this -> fileList;

        if(in_array($file, $fileList)) return;

        $migrateClass = "\\app\\sql\\".$file;
        $sqlMigrate = new $migrateClass;
        $sqlMigrate -> run();
        $sqlArr = $sqlMigrate -> getSqlArr();

        $dao = new Dao();
        foreach ($sqlArr as $sql) {
            $dao -> getConnection() -> query($sql);
            $this -> outPut($sql);
        }

        $fileList[] = $file;
        $this -> fileList = $fileList;
    }
}