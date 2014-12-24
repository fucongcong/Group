<?php
use src\web\controller\BaseController;

class GroupController extends BaseController
{
    public function indexAction()
    {   
        set_time_limit(0);
        $group=array();
        //$group=$this->getGroupService()->getGroup(1);
       /* set_time_limit(0);*/
       
/*    
        $data=array(
            "voteid"=>27,
            "source"=>2);

 $cookie="13".rand(100000000,999999999);
 echo $cookie.'投票成功';
 echo '<br>';
           for ($j=0; $j < 5; $j++) { 
               
                $response=$this->postRequest('http://in-ying.shznet.com/action/votingcomany',$data,$cookie);
       
                $data[]=json_decode($response,TRUE);
               
            }
  
        $data=array(
            "voteid"=>7,
            "source"=>1);
             $cookie="15".rand(100000000,999999999);
 echo $cookie.'投票成功';
           for ($j=0; $j < 5; $j++) { 
               
                $response=$this->postRequest('http://in-ying.shznet.com/action/votingcomany',$data,$cookie);
       
                $data[]=json_decode($response,TRUE);
               
            }*/
   


      
        return $this->render('web/views/Group/index.html.twig',array(
            'group'=>$group));
    }

    public function getGroupService()
    {
        return $this->createService("Group:Group");
    }

    protected function postRequest($url, $params,$cookie)
    {
        $userAgent = 'EduSoho Install Client 1.0';

        $connectTimeout = 5;

        $timeout = 5;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_COOKIE, "usermobile=".$cookie);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_URL, $url );

        // curl_setopt($curl, CURLINFO_HEADER_OUT, TRUE );

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}

?>