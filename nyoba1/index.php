<?php
include 'header.php';
include 'sidebar.php';
?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <!--<div class="w3-quarter">
      <div class="w3-container w3-green w3-padding-16">
        <div class="w3-left"><i class="fa fa-bar-chart-o w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h5>1000.000</h5>
        </div>
        <div class="w3-clear"></div>
        <h4>Penjualan</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-bar-chart-o w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h5>1000.000</h5>
        </div>
        <div class="w3-clear"></div>
        <h4>Penjualan</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-bar-chart-o w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h5>1000.000</h5>
        </div>
        <div class="w3-clear"></div>
        <h4>Penjualan</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-yellow w3-padding-16">
        <div class="w3-left"><i class="fa fa-bar-chart-o w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h5>1000.000</h5>
        </div>
        <div class="w3-clear"></div>
        <h4>Penjualan</h4>
      </div>
    </div>
  </div>-->

  <div class="w3-container">
    <h5>Grafik Penjualan Bulan <?= date('F');?></h5>
    
    <div id="chartdiv" style="width:100%; height:400px;"></div>
  </div>
  <hr>
	<?php include "/akses/select_index.php";?>
  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
        <h5>Stock Hampir Habis</h5>
        <table class="w3-table w3-striped w3-white">
		<?php		
			foreach($barang as $databrg)
			{
				echo"<tr>";
					echo"<td><i class='fa fa-bookmark w3-text-red w3-large'></i></td>
						<td>{$databrg["nama_barang"]}</td>
						<td><i>{$databrg["jml_stock"]}</i></td>";
				echo"</tr>";
			};
		?>
          
        </table>
      </div>
      <div class="w3-third">
        <h5>Belum Grading</h5>
        <table class="w3-table w3-striped w3-white">
		<?php
				foreach($grading as $datagrd)
				{
					echo"<tr>";
						echo"<td><i class='fa fa-bookmark w3-text-orange w3-large'></i></td>
							<td>{$datagrd["no_faktur"]}</td>
							<td><i>{$datagrd["nama_supplier"]}</i></td>";
					echo"</tr>";
				};
			
		?>
          
        </table>
      </div>
	  <div class="w3-third">
        <h5>Penagihan Pembayaran</h5>
        <table class="w3-table w3-striped w3-white">
		<?php
				foreach($bayar as $databyr)
				{
					echo"<tr>";
						echo"<td><i class='fa fa-bookmark w3-text-blue w3-large'></i></td>
							<td>{$databyr["no_faktur"]}</td>
							<td><i>{$databyr["klien"]}</i></td>";
					echo"</tr>";
				};
			
		?>
          
        </table>
      </div>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Penjualan Tahun</h5>
    <div id="chartdiv2" style="width:100%; height:300px;"></div>
  </div>
  <hr>

  
<script>
function grafik()
{
AmCharts.makeChart("chartdiv", {
                type: "serial",                
                dataLoader: {
					url: "akses/grafik_penjualan.php",
					format: "json"
				},
                categoryField: "barang",
                startDuration: 1,
                rotate: false,

                categoryAxis: {
                    gridPosition: "start"
                },
                valueAxes: [{
                    position: "bottom",
                    title: "Jumlah Terjual",
                    minorGridEnabled: true
                }],
                graphs: [{
                    type: "column",
                    title: "Terjual",
                    valueField: "jumlah",
                    fillAlphas:1,					
					autoColor: true,
                    balloonText: "<span style='font-size:13px;'>[[category]]:<b>[[value]]</b></span>"
					
                }
				],
                export: {
                    "enabled": true
                },

                creditsPosition:"bottom-right"

        });
};


function grafikTahunan()
{
AmCharts.makeChart("chartdiv2", {
                type: "serial",                
                dataLoader: {
					url: "akses/grafik_penjualan_tahunan.php",
					format: "json"
				},
                categoryField: "bulan",
                startDuration: 1,
                rotate: false,

                categoryAxis: {
                    gridPosition: "start"
                },
                valueAxes: [{
                    position: "bottom",
                    title: "Jumlah Terjual",
                    minorGridEnabled: true
                }],
                graphs: [{
                    type: "line",
					lineColor : "#27c5ff",
					bulletColor : "#27c5ff",
					bulletBorderColor : "#27c5ff",
					bulletBorderThickness : 2,
					bulletBorderAlpha :1,
					bullet : "round",
                    title: "Terjual",
                    valueField: "jumlah",
                    fillAlphas:0,
                    balloonText: "<span style='font-size:13px;'>[[category]]:<b>[[value]]</b></span>"
					
                }
				],
                export: {
                    "enabled": true
                },

                creditsPosition:"bottom-right"

        });
};


grafik();
grafikTahunan();
</script>
<?php include 'footer.php';?>
