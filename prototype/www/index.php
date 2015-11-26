<?php

$t_init = time();
date_default_timezone_set('Asia/Taipei');
define('DATA_PATH', '../data/');
define('COLOR_JCB', '30,255,0');
define('COLOR_MC', '255,0,25');
define('COLOR_VISA', '0,0,255');

$currencyDict = json_decode(file_get_contents(DATA_PATH.'currency.json'),true);


if(empty($_GET['days'])) $showDays = 30;
else $showDays = $_GET['days'];
if($showDays > 100) $showDays = 100;
if(empty($_GET['from'])) $currFrom = 'USD';
else $currFrom = strtoupper($_GET['from']);
if(empty($_GET['to'])) $currTo = 'TWD';
else $currTo = strtoupper($_GET['to']);


?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<form method="get">
    <div style="margin-bottom: 20px;">
        1 <select name="from"><?php
            foreach($currencyDict as $curr => $pf){
                echo '<option value="'.$curr.'" '.($curr === $currFrom ? 'selected' : '').'>'.$curr.(empty($pf['name']) ? '' : ' - '.$pf['name']).'</option>';
            }
        ?></select> = ? <select name="to"><?php
            foreach($currencyDict as $curr => $pf){
                echo '<option value="'.$curr.'" '.($curr === $currTo ? 'selected' : '').'>'.$curr.(empty($pf['name']) ? '' : ' - '.$pf['name']).'</option>';
            }
        ?></select><br />
        <input type="text" size="3" name="days" value="<?php echo $showDays;?>" /> days
        <input type="submit" value="GO" />
    </div>
</form>

<canvas id="myChart" width="800" height="600"></canvas>

<div>
    <span style="display:inline-block;width:30px;height:14px;background-color: rgb(<?php echo COLOR_VISA;?>)"></span>VISA
    <span style="display:inline-block;width:30px;height:14px;background-color: rgb(<?php echo COLOR_MC;?>)"></span>MasterCard
    <span style="display:inline-block;width:30px;height:14px;background-color: rgb(<?php echo COLOR_JCB;?>)"></span>JCB
</div>

<script src="Chart.min.js"></script>
<script>
var ctx = document.getElementById("myChart").getContext("2d");

<?php

echo "/*\n";

$t_start = false;

for($t=$t_init; $t>$t_init - 86400*14; $t-=86400){
    if(file_exists(DATA_PATH.date('Ymd',$t))){
        $t_start = $t;
        break;
    }
    else echo '--not found '.date('Ymd',$t).'--';
}

$labels = array();

for($t=$t_start; $t>= $t_start-86400 * $showDays; $t-=86400){
    $labels[] = date('Ymd',$t);
}

$labels = array_reverse($labels);

$minMaxValues = array();

function getUSDBase($extable, $curr, $type){
    if($curr === 'USD') return 1;
    if(empty($extable[$curr][$type])){
        return $extable[$curr]['mid'];
    }
    return $extable[$curr][$type];
}

function getDataset($org, $conf){
    global $labels;
    global $currFrom;
    global $currTo;
    global $minMaxValues;
    $data = array();
    foreach($labels as $label){
        $extable = false;
        $extable =@ json_decode(file_get_contents(DATA_PATH.$label.'/'.$org.'.json'),true);
        if(empty($extable)){
            $data[] = null;
            continue;
        }
        if(getUSDBase($extable,$currFrom,'buy') == 0){
            $data[] = null;
            continue;
        }
        //$val = (empty($extable[$currTo]['sell']) ? $extable[$currTo]['mid']: $extable[$currTo]['sell']) / (empty($extable[$currFrom]['buy']) ? $extable[$currFrom]['mid']: $extable[$currFrom]['buy']);
        $val = getUSDBase($extable,$currTo,'sell') / getUSDBase($extable,$currFrom,'buy');
        $val = round($val, 4);
        $minMaxValues[] = $val;
        $data[] = $val;
    }
    $conf['data'] = $data;
    return $conf;
}
function checkDataset($dataset){
    foreach($dataset['data'] as $item){
        if(!empty($item)) return true;
    }
    return false;
}

$datasets = array();

$color = COLOR_JCB;
$dataset = getDataset('jcb', array(
            'label' => 'JCB',
            'fillColor' => "rgba({$color},0.1)",
            'strokeColor' => "rgba({$color},1)",
            'pointColor' => "rgba({$color},1)",
            'pointStrokeColor' => "#fff",
            'pointHighlightFill' => "#fff",
            'pointHighlightStroke' => "rgba({$color},1)",
            )); 
if(checkDataset($dataset)){
    $datasets[] = $dataset;
}
$color = COLOR_MC;
$dataset = getDataset('mc', array(
            'label' => 'MasterCard',
            'fillColor' => "rgba({$color},0.1)",
            'strokeColor' => "rgba({$color},1)",
            'pointColor' => "rgba({$color},1)",
            'pointStrokeColor' => "#fff",
            'pointHighlightFill' => "#fff",
            'pointHighlightStroke' => "rgba({$color},1)",
            ));   
if(checkDataset($dataset)){
    $datasets[] = $dataset;
}
$color = COLOR_VISA;
$dataset = getDataset('visa', array(
            'label' => 'VISA',
            'fillColor' => "rgba({$color},0.1)",
            'strokeColor' => "rgba({$color},1)",
            'pointColor' => "rgba({$color},1)",
            'pointStrokeColor' => "#fff",
            'pointHighlightFill' => "#fff",
            'pointHighlightStroke' => "rgba({$color},1)",
            ));   
if(checkDataset($dataset)){
    $datasets[] = $dataset;
}

$data = array(
            'labels' => $labels,
            'datasets' => $datasets,
        );

//print_r($data);
echo "*/\n";

?>

var data = <?php echo json_encode($data);?>;

/*
var data_sample = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [650, 590, 800, 810, 560, 550, 400]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [280, 480, 400, 190, 800, 270, 900]
        }
    ]
};
*/

<?php

    $step = (max($minMaxValues)-min($minMaxValues)) / 10;
    $step = round($step,2);
    if($step == 0) $step = 0.001;

?>

var myNewChart = new Chart(ctx).Line(data, {
            bezierCurve: false,
            scaleOverride : true,
            scaleSteps : <?php echo ceil((max($minMaxValues)-min($minMaxValues))/$step);?>,
            scaleStepWidth : <?php echo $step;?>,
            scaleStartValue : <?php echo min($minMaxValues);?>,
            scaleLabel: function(object) {
                return "     " + object.value;
            },
            multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>" 
});

</script>
</body>
</html>
