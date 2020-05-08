  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'Port');

<?php
$sdate = $_GET['d'];
$mysqli = new mysqli("localhost", "user", "password", "packets");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("select count(d_port),d_port from entry where d_date = '$sdate' group by d_port order by count(d_port)desc limit 10"))) {
     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$out_id    = NULL;
$out_label = NULL;
if (!$stmt->bind_result($out_id, $out_label)) {
    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

#echo "<h1>Date: $sdate</h1>";
# echo  "<li>$vdbid $out_id $out_label $port</li>";
echo " data.addRows([ ";
while ($stmt->fetch()) {

    echo "['$out_label',$out_id],";
    $x++;
}

echo "]);";
#mysql_close();
?>

        // Set chart options
        var options = {'title':'Top 10 Ports By Day',
                       'width':800,
                       'height':500};

        // Instantiate and draw our chart, passing in some options.
      //  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
