<?php

$title= "Dashbaord";
require_once "layout/header.php"; 
$ORDERS = new Orders;


?>

    <h1 class="mt-4">Dashboard</h1>

    <div class="dashboard">

<div class="row">

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card bg-info border-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center text-light">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                        Earnings Today</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        $<?php 
                        if(is_array($ORDERS->dashboardEarnings("daily",$_SESSION['customer_id']))){
                            echo ($ORDERS->dashboardEarnings("daily",$_SESSION['customer_id'])[0]['SUM(amount)']);
                        }else{
                            echo "0";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-wallet fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card bg-primary border-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center text-light">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                        Earnings (Monthly)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">$
                        <?php 
                            if(is_array($ORDERS->dashboardEarnings("monthly",$_SESSION['customer_id']))){
                                echo ($ORDERS->dashboardEarnings("monthly",$_SESSION['customer_id'])[0]['SUM(amount)']);
                            }else{
                                echo "0";
                            }
                            ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card bg-success border-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center text-light">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                        Earnings (Annual)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">$
                        <?php 
                        if(is_array($ORDERS->dashboardEarnings("yearly",$_SESSION['customer_id']))){
                            echo ($ORDERS->dashboardEarnings("yearly",$_SESSION['customer_id'])[0]['SUM(amount)']);
                        }else{
                            echo "0";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card bg-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                        <a style="text-decoration:none;" href="orders.php">Pending Orders</a></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                            if($ORDERS->pendingOrders($_SESSION['customer_id']) > 0){
                                echo count($ORDERS->pendingOrders($_SESSION['customer_id'])); 
                            }else{
                                echo "0";
                            }
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-funnel-dollar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <div>
        <h3>Generate Report Charts</h3>
        <button id="Daily" value="daily" onclick="getChart(this.value)">Daily</button>
        <button id="Daily" value="weekly" onclick="getChart(this.value)">Weekly</button>
        <button id="Daily" value="monthly" onclick="getChart(this.value)">Monthly</button>
        <button id="Daily" value="yearly" onclick="getChart(this.value)">Yearly</button>
    </div>                        
<div id="chart" class="col-md-6 col-lg-8" style="margin:35px auto;">
</div>

<script>
    function getChart(x){
    if(x=='daily'){
        document.getElementById("chart").innerHTML = "";
        var options ={
            chart: {
                height: 280,
                type: "area"
            },
            dataLabels: {
                enabled: false
            },
            series: [
                {
                name: "Daily Reports",
                data: [ 
                    <?php 
                        if($ORDERS->filterGraph('DATE',$_SESSION['customer_id']) > 0){
                            foreach($ORDERS->filterGraph("DATE",$_SESSION['customer_id']) as $data){
                                echo $data['SUM(amount)'].","; 
                            }
                        } 
                        ?>
                    ]
                }
            ],
            fill: {
                type: "gradient",
                gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.9,
                stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: [
                    <?php 
                        if($ORDERS->filterGraph('DATE',$_SESSION['customer_id']) > 0){
                            foreach($ORDERS->filterGraph("DATE",$_SESSION['customer_id']) as $data){
                                echo "'".$data['DATE(order_date)']."'".","; 
                            }
                        } 
                        ?>
                ]
            }
        }
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }
    if(x=='weekly'){
        document.getElementById("chart").innerHTML = "";
        var options ={
            chart: {
                height: 280,
                type: "area"
            },
            dataLabels: {
                enabled: false
            },
            series: [
                {
                name: "Weekly Reports",
                data: [ 
                    <?php 
                        if($ORDERS->filterGraph('WEEK',$_SESSION['customer_id']) > 0){
                            foreach($ORDERS->filterGraph("WEEK",$_SESSION['customer_id']) as $data){
                                echo $data['SUM(amount)'].","; 
                            }
                        } 
                        ?>
                    ]
                }
            ],
            fill: {
                type: "gradient",
                gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.9,
                stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: [
                    <?php 
                        if($ORDERS->filterGraph('WEEK',$_SESSION['customer_id']) > 0){
                            foreach($ORDERS->filterGraph("WEEK",$_SESSION['customer_id']) as $data){
                                echo "'".$data['YEAR(order_date)']."/".$data['WEEK(order_date)']."'".","; 
                            }
                        } 
                        ?>
                ]
            }
        }
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }
    if(x=='monthly'){
        document.getElementById("chart").innerHTML = "";
        var options ={
            chart: {
                height: 280,
                type: "area"
            },
            dataLabels: {
                enabled: false
            },
            series: [
                {
                name: "Monthly Reports",
                data: [ 
                    <?php 
                        if($ORDERS->filterGraph('MONTH',$_SESSION['customer_id']) > 0){
                            foreach($ORDERS->filterGraph("MONTH",$_SESSION['customer_id']) as $data){
                                echo $data['SUM(amount)'].","; 
                            }
                        } 
                        ?>
                    ]
                }
            ],
            fill: {
                type: "gradient",
                gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.9,
                stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: [
                    <?php 
                        if($ORDERS->filterGraph('MONTH',$_SESSION['customer_id']) > 0){
                            foreach($ORDERS->filterGraph("MONTH",$_SESSION['customer_id']) as $data){
                                echo "'".$data['YEAR(order_date)']."/".$data['MONTHNAME(order_date)']."'".",";
                            }
                        } 
                        ?>
                ]
            }
        }
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }
    if(x=='yearly'){
        document.getElementById("chart").innerHTML = "";
        var options ={
            chart: {
                height: 280,
                type: "area"
            },
            dataLabels: {
                enabled: false
            },
            series: [
                {
                name: "Weekly Reports",
                data: [ 
                    <?php 
                        if($ORDERS->filterGraph('YEAR',$_SESSION['customer_id']) > 0){
                            foreach($ORDERS->filterGraph("YEAR",$_SESSION['customer_id']) as $data){
                                echo $data['SUM(amount)'].","; 
                            }
                        } 
                        ?>
                    ]
                }
            ],
            fill: {
                type: "gradient",
                gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.9,
                stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: [
                    <?php 
                        if($ORDERS->filterGraph('YEAR',$_SESSION['customer_id']) > 0){
                            foreach($ORDERS->filterGraph("YEAR",$_SESSION['customer_id']) as $data){
                                echo "'".$data['YEAR(order_date)']."'".","; 
                            }
                        } 
                        ?>
                ]
            }
        }
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }

    }
</script>
    
<?php require_once "layout/footer.php" ?>
