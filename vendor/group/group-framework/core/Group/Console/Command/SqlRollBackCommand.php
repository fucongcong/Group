<?php

namespace Group\Console\Command;

use Group\Console\Command as Command;
use Group\Console\Command\SqlCleanCommand as SqlCleanCommand;

class SqlRollBackCommand extends Command
{
    protected $fileList = [];

    public function init()
    {
        $sqlDir = __ROOT__."app/sql/";

        $lock = \FileCache::isExist("sql.lock", $sqlDir);
        if($lock) {
            $this -> fileList = \FileCache::get("sql.lock", $sqlDir);
        }

        $this -> ListSql($sqlDir);

        //清除lock
        $clean = new SqlCleanCommand;
        $clean -> init();
    }

    private function ListSql($sqlDir)
    {   
        $files = [];
        if (is_dir($sqlDir)) {
            $dir = opendir($sqlDir);
            while (($file = readdir($dir)) !== false) {
                $file = explode(".", $file);
                $fileName = $file[0];

                if ($fileName && isset($file[1]) && $file[1] == "php") {
                    $files[] = $fileName;     
                }
            }
            closedir($dir);
        }

        krsort($files);
        foreach ($files as $fileName) {
            $this -> filterLockFile($fileName);
        }

    }

    private function filterLockFile($file)
    {
        $fileList = $this -> fileList;

        if (!in_array($file, $fileList)) return;

        $migrateClass = "\\app\\sql\\".$file;
        $sqlMigrate = new $migrateClass;
        $sqlMigrate -> back();
        $sqlArr = $sqlMigrate -> getSqlArr();

        $this -> startRollBack($sqlArr);
    }

    private function startRollBack($sqlArr)
    {
        $dao = new \Dao();
        foreach ($sqlArr as $sql) {
            $this -> doSql($dao, $sql);
        }
    }

    private function doSql($dao, $sql) {

        $input = $this -> getArgv();
        $type = isset($input[0]) ? $input[0] : 'default';
        $subType = isset($input[1]) ? $input[1] : 'all';

        switch ($type) {
            case 'write':
                    if ($subType == 'all') {
                        $dao -> querySql($sql, 'all_write');
                    }else {
                        $dao -> querySql($sql, 'write', $subType);
                    }
                break;
            case 'read':
                    if ($subType == 'all') {
                        $dao -> querySql($sql, 'all_read');
                    }else {
                        $dao -> querySql($sql, 'read', $subType);
                    }
                break;
            case 'default':
                    $dao -> querySql($sql, 'default');
                break;
            case 'all':
                    $dao -> querySql($sql, 'default');
                    $dao -> querySql($sql, 'all_write');
                    $dao -> querySql($sql, 'all_read');
                break;
            default:
                break;
        }

        $this -> outPut($sql);
    }
}
