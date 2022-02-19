<!DOCTYPE html>
<html>
    <head>
        <title>Get Header Tags</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/richtexteditor/rte_theme_default.css" />
    </head>
    <body>
        <?php require_once 'include/handler.php'; ?>
        <p>Enter your sites: (up to 10, comma seperated) <a href="<?php echo $_SERVER['REQUEST_URI']; ?>">Back</a></p>
        <div style="width:100%;float:left;">
            <form action="" method="POST">
                <input type="text" name="url" value="<?php echo $setUrl; ?>" style="width: 40%;">
                <input type="hidden" name="action" value="loadUrls" />
                <button type="submit" class="submitButton" name="submitVal" value="submit">Submit</button>
                <button type="submit" class="submitButton" name="showrrecordTags" value="showTagsRecord">Show Only Tags</button>
                <button type="submit" class="submitButton" name="showCountWords" value="showCountWords">Count Words</button>
            </form>
        </div><br><br><br>
        <hr>
        <?php
        if(count($dataArr) > 0){
            if($showCountWords == true){
                echo '<div class="wordsCountSec">';
                    echo '<div class="wordsCountHalfWrap">';
                        echo '<div class="wordsCountWrap">';
                            echo 'We found <span class="totalWordCount">'.$dataArr['totalWord'].'<span> words on '.$setUrl.' </span></span>';
                        echo '</div>';

                        echo '<div class="keywordsBoxList">';
                            echo '<div class="keywordsBoxhlfWrap">';
                                echo '<div class="keywordsHalfBox">';
                                    echo '<h3>Popular Keywords</h3>';
                                    echo '<div class="table-data">';
                                        echo '<table class="table duplicated-keywords">';
                                                echo '<thead>';
                                                    echo '<tr>';
                                                        echo '<th>Keyword</th>';
                                                        echo '<th>Quantity</th>';
                                                    echo '</tr>';
                                                echo '</thead>';
                                                echo '<tbody>';
                                                    foreach($dataArr['popularKeywords'] as $poplarKey => $poplarVal){
                                                        echo '<tr>';
                                                            echo '<td>'.$poplarKey.'</td>';
                                                            echo '<td class="textcenter">'.$poplarVal.'</td>';
                                                        echo '</tr>';    
                                                    }
                                            echo '</tbody>';
                                        echo '</table>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="keywordsHalfBox">';
                                    echo '<h3>Non-Common Keywords</h3>';
                                    echo '<div class="table-data">';
                                        echo '<table class="table duplicated-keywords">';
                                                echo '<thead>';
                                                    echo '<tr>';
                                                        echo '<th>Keyword</th>';
                                                        echo '<th>Quantity</th>';
                                                    echo '</tr>';
                                                echo '</thead>';
                                                echo '<tbody>';
                                                    foreach($dataArr['nonCommonKeywords'] as $nonCmnKey => $nonCmnVal){
                                                        echo '<tr>';
                                                            echo '<td>'.$nonCmnKey.'</td>';
                                                            echo '<td class="textcenter">'.$nonCmnVal.'</td>';
                                                        echo '</tr>';    
                                                    }
                                            echo '</tbody>';
                                        echo '</table>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="keywordsHalfBox">';
                                    echo '<h3>All Keywords</h3>';
                                    echo '<div class="table-data">';
                                        echo '<table class="table duplicated-keywords">';
                                                echo '<thead>';
                                                    echo '<tr>';
                                                        echo '<th>Keyword</th>';
                                                        echo '<th>Quantity</th>';
                                                    echo '</tr>';
                                                echo '</thead>';
                                                echo '<tbody>';
                                                    foreach($dataArr['commonKeywords'] as $cmnKey => $cmnVal){
                                                        echo '<tr>';
                                                            echo '<td>'.$cmnKey.'</td>';
                                                            echo '<td class="textcenter">'.$cmnVal.'</td>';
                                                        echo '</tr>';    
                                                    }
                                            echo '</tbody>';
                                        echo '</table>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';

                    echo '</div>';
                echo '</div>';
            }else{
                if($showTags == true){
                    echo '<div id="getResultHere">';
                        foreach($dataArr as $dataKey => $dataVal){
                            echo '<div id="headingFetchMetaTag"><h3> All Meta Tags (Site Name - '. $dataKey.')</h3></div>';
                            foreach($dataVal as $tkey => $tval){
                                foreach($tval as $kk => $vv){
                                    if(!empty($vv) && $vv != ' ' && $vv != 'nbsp;'){
                                        echo '<div class="fetchHeadingRow">';
                                            echo '<div class="fetchHeadingLeft"><strong>'.strtoupper($tkey).'</strong></div>';
                                            echo '<div class="fetchHeadingRight">'.$vv.'</div>';
                                        echo '</div>';
                                    }
                                }
                            }
                        }
                    echo '</div>';
                }else{
                    echo '<p>Select Data</p>';
                    echo '<form action="" method="POST">';
                        echo "<input type='hidden' name='websiteData' value='".base64_encode(serialize($dataArr))."'>";
                        echo '<input type="hidden" name="action" value="setRecord">';
                        echo '<input type="hidden" name="urlname" value="'.$setUrl.'">';
                        $dataWebUrl = array();
                        $j = 1;
                        foreach($dataArr as $dataKey => $dataVal){
                            echo '<p>'.$dataKey.'</p>';
                            $i = 1;
                            echo '<p>';
                            foreach($dataVal as $dKey => $dVal){
                                foreach($dVal as $kkey => $vval){
                                    if($i == 1){
                                        echo '<input type="hidden" name="data['.$j.'][websiteUrl]" value="'.$dataKey.'">';
                                        echo '<input type="checkbox" class="slectAllcheclbox" data-getval="'.$j.'" name="data['.$j.'][showRecord]" value="all"> Select All<br>';
                                    }
                                    if(!empty($vval)){
                                        echo '<input type="checkbox" class="slectAllcheclbox_'.$j.'" name="data['.$j.'][showRecord][]" value="<'.$dKey.'>'.preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $vval).'</'.$dKey.'>"> '.strtoupper($dKey).' '.$vval.'<br>';
                                    }
                                    $i++;
                                }
                            }
                            echo '</p>';
                            $j++;
                        }
                        echo '<button type="submit" class="continueBtnSet">continue</button>';
                    echo '</form>';
                }
            }
        }
        if(!empty($textarea)){
            echo '<div id="div_editor1">'.$textarea.'</div>';
        }        
        ?>
    </body>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/my.js"></script>
    <script type="text/javascript" src="assets/richtexteditor/rte.js"></script>
    <script type="text/javascript" src='assets/richtexteditor/plugins/all_plugins.js'></script>
</html>