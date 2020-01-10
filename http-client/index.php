<?php
function http_client_download_file($url, $base_url='http://intranet.igp.gob.pe/bdsismos/downloads/'){
    $path_to_save = __DIR__.'/../downloads/';
    $url = 'http://10.10.210.71/admsismos/public/mapas-sismicidad/'.$url;

    $exploded = explode('/', $url);
    $size = count($exploded);
    $file_name = $exploded[$size-2].'-'.$exploded[$size-1];

    $exist = file_exists($path_to_save.$file_name);

    if (!$exist){
        require_once __DIR__.'/vendor/autoload.php';
        $resource = fopen($path_to_save.$file_name, 'w');
        try{
            $client = new GuzzleHttp\Client();
            //$client->get($url,['sink' => $resource]);
            //return $base_url_for_this_site.$file_name;
            $response = $client->get($url, ['save_to'=>$resource]);
            if ($response->getStatusCode() == 200){
                return $base_url.$file_name;
            }else{
                //fclose($resource);
                unlink($path_to_save.$file_name);
            }
            return '';
        }catch (Exception $e){
            //fclose($resource);
            unlink($path_to_save.$file_name);
            return '';
        }

    }
    return $base_url.$file_name;
}

