<?php

function asyncJob($data, $getRecv = false){
    static $redis_client = null;
    if (is_null($redis_client)){
        $redis_client = pfsockopen('0.0.0.0', 9519);
    }
    if (!$redis_client){
        //能否fallback到同步的模式?
        return false;
    }
    fwrite($redis_client, $data . "\r\n");
    if ($getRecv){
        $content = '';
        // stream_set_blocking($redis_client, FALSE );
        //设置一个5s的超时
        stream_set_timeout($redis_client, 3);
        $info = stream_get_meta_data($redis_client);
        while (!$info['timed_out']) {
            $content .= fread($redis_client, 8192);
            if (stristr($content,"\r\n")){
                break;
            }
            $info = stream_get_meta_data($redis_client);
        }
        //不一定一定是json对象
        return trim($content);
    }
}
class DataPack 
{
    public static function pack($cmd = '', $data = [])
    {
        return json_encode(['cmd' => $cmd, 'data' => $data]);
    }

    public static function unpack($data = [])
    {
        $data = json_decode($data, true);
        return [$data['cmd'], $data['data']];
    }
}

$cmd = "getUserInfo";
$data = [1,2,3,4,5,6,7,8,9,10];
$data = DataPack::pack($cmd, $data);
var_dump(asyncJob($data, true));