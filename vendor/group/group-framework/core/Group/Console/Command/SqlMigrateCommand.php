<?php

namespace Group\Console\Command;

use Group\Console\Command as Command;

class SqlMigrateCommand extends Command
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

        \FileCache::set("sql.lock", $this -> fileList, $sqlDir);
    }

    private function ListSql($sqlDir)
    {
        if (is_dir($sqlDir)) {
            $dir = opendir($sqlDir);

            while (($file = readdir($dir)) !== false) {
                $file = explode(".", $file);
                $fileName = $file[0];

                if ($fileName && isset($file[1]) && $file[1] == "php") {
                    $this -> filterLockFile($fileName);
                }
            }
            closedir($dir);
        }
    }

    private function filterLockFile($file)
    {
        $fileList = $this -> fileList;

        if (in_array($file, $fileList)) return;

        $migrateClass = "\\app\\sql\\".$file;
        $sqlMigrate = new $migrateClass;
        $sqlMigrate -> run();
        $sqlArr = $sqlMigrate -> getSqlArr();

        $this -> startMigrate($sqlArr);

        $fileList[] = $file;
        $this -> fileList = $fileList;
    }

    private function startMigrate($sqlArr)
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
