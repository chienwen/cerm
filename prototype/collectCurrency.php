<?php

    if(count($argv) < 4){
        die("useage: php collectCurrency.php data/20151117/visa.json data/20151117/mc.json data/20151117/jcb.json\n");
    }

    $dict = array('USD' => array('name' => 'United State Dollar'));

    foreach($argv as $n => $a){
        if($n === 0) continue;
        $json = json_decode(file_get_contents($a),true);
        foreach($json as $curr => $pf){
            if(!isset($dict[$curr])) $dict[$curr] = array();
            if(!empty($pf['name'])){
                if(empty($dict[$curr]['name'])){
                    $dict[$curr]['name'] = $pf['name'];
                }
                else{
                    if(strlen($dict[$curr]['name']) < $pf['name']){
                        $dict[$curr]['name'] = $pf['name'];
                    }
                }
            }
        }
    }

    foreach($dict as $k => $v){
        if(!empty($dict[$k]['name'])){
            $dict[$k]['name'] = ucwords($v['name']);
        }
    }

    ksort($dict);

    echo json_encode($dict);
