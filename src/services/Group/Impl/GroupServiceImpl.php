<?php
require 'src/services/BaseService.php';
require 'src/services/Group/GroupService.php';

class GroupServiceImpl extends BaseService implements GroupService
{

    public function getGroup($id)
    {
        return $this->getGroupDao()->getGroup($id);
    }
    
    public function getGroupDao()
    {
        return $this->createDao("Group:Group");
    }

}
?>