<?php
    require_once 'include/functions.php';
    $dataArr = array();
    $showTags = false;
    $textarea = '';
    $setUrl = '';
    $showCountWords = false;
    if(isset($_POST['action']) && $_POST['action'] == 'loadUrls'){
        if(!empty($_POST['url'])){
            $url = $_POST['url'];
            $setUrl = $_POST['url'];
            if(isset($_POST['showCountWords']) && $_POST['showCountWords'] == 'showCountWords'){
                $showTags = true;
                $checkUrl = checkURL($setUrl);
                if($checkUrl == true){
                    $url = str_replace("https://","",$setUrl);
                    $url = str_replace("http://","",$url);
                    $url = str_replace("www.","",$url);
                    $url = 'http://'.$url;
                    $dataArr = getWords($url);
                    if(empty($dataArr)){
                        $msg = "Something went wrong, Please again.";
                    }else{
                        $showCountWords = true;
                    }
                }else{
                    $msg = "Please add URL and Only one URL.";
                }
            }else{
                $urlArr = explode(',',$url);
                foreach($urlArr as $key => $val){
                    // $url = str_replace("https://","",$val);
                    // $url = str_replace("http://","",$url);
                    // $url = str_replace("www.","",$url);
                    $contents = getHeadingTags($url);
                    $dataArr[$val] = $contents;
                }
                if(isset($_POST['showrrecordTags']) && $_POST['showrrecordTags'] == 'showTagsRecord'){
                    $showTags = true;
                }
            }
        }
    }

    if(isset($_POST['action']) && $_POST['action'] == 'setRecord'){
        $originalRecord = unserialize(base64_decode($_POST['websiteData']));
        $setUrl = $_POST['urlname'];       
        if(isset($_POST['data'])){
            foreach($_POST['data'] as $ky => $vl){
                if(isset($vl['showRecord'])){
                    foreach($vl['showRecord'] as $shwKey => $shwVal){
                        if(isset($shwVal)){
                            $textarea .= $shwVal;
                        }
                    }
                }
            }
        }
    }

?>