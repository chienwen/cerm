<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<canvas id="myChart" width="800" height="600"></canvas>

<script src="Chart.min.js"></script>
<script>
var ctx = document.getElementById("myChart").getContext("2d");

<?php

$t_init = time();
date_default_timezone_set('Asia/Taipei');
define('DATA_PATH', '../data/');

$t_start = false;

for($t=$t_init; $t>$t_init - 86400*14; $t-=86400){
    if(file_exists(DATA_PATH.date('Ymd',$t))){
        $t_start = $t;
        break;
    }
    else echo '--not found '.date('Ymd',$t).'--';
}

$labels = array();

if(empty($_GET['days'])) $showDays = 20;
else $showDays = $_GET['days'];

for($t=$t_start; $t>= $t_start-86400 * $showDays; $t-=86400){
    $labels[] = date('Ymd',$t);
}

$labels = array_reverse($labels);

$currFrom = $_GET['from'];
$currTo = $_GET['to'];

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
        //$val = (empty($extable[$currTo]['sell']) ? $extable[$currTo]['mid']: $extable[$currTo]['sell']) / (empty($extable[$currFrom]['buy']) ? $extable[$currFrom]['mid']: $extable[$currFrom]['buy']);
        $val = getUSDBase($extable,$currTo,'sell') / getUSDBase($extable,$currFrom,'buy');
        $val = round($val, 4);
        $minMaxValues[] = $val;
        $data[] = $val;
    }
    $conf['data'] = $data;
    return $conf;
}

$datasets = array();

$color = '30,255,0';
$datasets[] = getDataset('jcb', array(
            'label' => 'JCB',
            'fillColor' => "rgba({$color},0.1)",
            'strokeColor' => "rgba({$color},1)",
            'pointColor' => "rgba({$color},1)",
            'pointStrokeColor' => "#fff",
            'pointHighlightFill' => "#fff",
            'pointHighlightStroke' => "rgba({$color},1)",
            ));  
$color = '255,0,25';
$datasets[] = getDataset('mc', array(
            'label' => 'MasterCard',
            'fillColor' => "rgba({$color},0.1)",
            'strokeColor' => "rgba({$color},1)",
            'pointColor' => "rgba({$color},1)",
            'pointStrokeColor' => "#fff",
            'pointHighlightFill' => "#fff",
            'pointHighlightStroke' => "rgba({$color},1)",
            ));   
$color = '0,0,255';
$datasets[] = getDataset('visa', array(
            'label' => 'VISA',
            'fillColor' => "rgba({$color},0.1)",
            'strokeColor' => "rgba({$color},1)",
            'pointColor' => "rgba({$color},1)",
            'pointStrokeColor' => "#fff",
            'pointHighlightFill' => "#fff",
            'pointHighlightStroke' => "rgba({$color},1)",
            ));   

$data = array(
            'labels' => $labels,
            'datasets' => $datasets,
        );

//print_r($data);

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

var myNewChart = new Chart(ctx).Line(data, {
            bezierCurve: false,
            scaleOverride : true,
            scaleSteps : <?php echo ceil((max($minMaxValues)-min($minMaxValues))/0.01);?>,
            scaleStepWidth : 0.01,
            scaleStartValue : <?php echo min($minMaxValues);?>,
            multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>" 
});

</script>
</body>
</html>
