<?php

namespace App\Lib;

use Illuminate\Http\Request;
use App\Element;
use Storage;
use PieChart, XYChart;

class Chart
{   
    public function pieChat()
    {
		# This script can draw different charts depending on the chartIndex
		$chartIndex = (int)(request("img"));

		# The data for the pie chart
		$data = array(25, 18, 15, 12, 8, 30, 35);

		# The labels for the pie chart
		$labels = array("Labor", "Licenses", "Taxes", "Legal", "Insurance", "Facilities", "Production");

		# Create a PieChart object of size 280 x 240 pixels
		$c = new PieChart(280, 240);

		# Set the center of the pie at (140, 130) and the radius to 80 pixels
		$c->setPieSize(140, 130, 80);

		# Add a title to the pie to show the start angle and direction
		if ($chartIndex == 0) {
		  $c->addTitle("Start Angle = 0 degrees\nDirection = Clockwise");
		} else {
		  $c->addTitle("Start Angle = 90 degrees\nDirection = AntiClockwise");
		  $c->setStartAngle(90, false);
		}

		# Draw the pie in 3D
		$c->set3D();

		# Set the pie data and the pie labels
		$c->setData($data, $labels);

		# Explode the 1st sector (index = 0)
		$c->setExplode(0);

		# Output the chart
		header("Content-type: image/png");
		print($c->makeChart2(PNG));
		return;
		file_put_contents('img/charts/chart.png', $c->makeChart2(PNG));
    }

    public function scatter()
    {
    	# The XY points for the scatter chart
		$dataX0 = array(10, 15, 6, 12, 14, 8, 13, 13, 16, 12, 10.5);
		$dataY0 = array(130, 150, 80, 110, 110, 105, 130, 115, 170, 125, 125);

		$dataX1 = array(6, 12, 4, 3.5, 7, 8, 9, 10, 12, 11, 8);
		$dataY1 = array(65, 80, 40, 45, 70, 80, 80, 90, 100, 105, 60);

		# Create a XYChart object of size 450 x 420 pixels
		$c = new XYChart(450, 420);

		# Set the plotarea at (55, 65) and of size 350 x 300 pixels, with a light grey border (0xc0c0c0).
		# Turn on both horizontal and vertical grid lines with light grey color (0xc0c0c0)
		$c->setPlotArea(55, 65, 350, 300, -1, -1, 0xc0c0c0, 0xc0c0c0, -1);

		# Add a legend box at (50, 30) (top of the chart) with horizontal layout. Use 12pt Times Bold Italic
		# font. Set the background and border color to Transparent.
		$legendObj = $c->addLegend(50, 30, false, "timesbi.ttf", 12);
		$legendObj->setBackground(Transparent);

		$title = 'Genetically Modified Predator';

		if(request('title')) {
			$title = request('title');
		}

		# Add a title to the chart using 18pt Times Bold Itatic font.
		$c->addTitle($title, "timesbi.ttf", 18);

		# Add a title to the y axis using 12pt Arial Bold Italic font
		$c->yAxis->setTitle("Length (cm)", "arialbi.ttf", 12);

		# Add a title to the x axis using 12pt Arial Bold Italic font
		$c->xAxis->setTitle("Weight (kg)", "arialbi.ttf", 12);

		# Set the axes line width to 3 pixels
		$c->xAxis->setWidth(3);
		$c->yAxis->setWidth(3);

		# Add an orange (0xff9933) scatter chart layer, using 13 pixel diamonds as symbols
		$c->addScatterLayer($dataX0, $dataY0, "Genetically Engineered", DiamondSymbol, 13, 0xff9933);

		# Add a green (0x33ff33) scatter chart layer, using 11 pixel triangles as symbols
		$c->addScatterLayer($dataX1, $dataY1, "Natural", TriangleSymbol, 11, 0x33ff33);

		header("Content-type: image/png");
		print($c->makeChart2(PNG));

		# Output the chart
		file_put_contents('img/charts/scatter.png', $c->makeChart2(PNG));
    }

    public function lineChart($data, $labels, $userIdFolder, $activityId, $q)
    {
		# Create a XYChart object of size 250 x 250 pixels
		$c = new XYChart(354, 314);

		# Set the plotarea at (30, 20) and of size 200 x 200 pixels
		$c->setPlotArea(30, 20, 280, 250);

		# Add a line chart layer using the given data
		// $c->addLineLayer($data);

		// # Set the labels on the x axis.
		// $c->xAxis->setLabels($labels);

		// # Display 1 out of 3 labels on the x-axis.
		// $c->xAxis->setLabelStep(1);

		# Set the plotarea at (70, 20) and of size 500 x 300 pixels, with transparent background and border
		# and light grey (0xcccccc) horizontal grid lines
		//$c->setPlotArea(70, 20, 500, 300, Transparent, -1, Transparent, 0xcccccc);

		# Set the x and y axis stems to transparent and the label font to 12pt Arial
		$c->xAxis->setColors(Transparent);
		$c->yAxis->setColors(Transparent);
		$c->xAxis->setLabelStyle("arial.ttf", 12);
		$c->yAxis->setLabelStyle("arial.ttf", 12);

		# Add a blue (0x6699bb) bar chart layer using the given data
		$layer = $c->addBarLayer($data, 0x6699bb);

		# Use bar gradient lighting with the light intensity from 0.8 to 1.3
		$layer->setBorderColor(Transparent, barLighting(0.8, 1.3));

		# Set rounded corners for bars
		$layer->setRoundedCorners();

		# Display labela on top of bars using 12pt Arial font
		$layer->setAggregateLabelStyle("Arial", 12);

		# Set the labels on the x axis.
		$c->xAxis->setLabels($labels);

		# For the automatic y-axis labels, set the minimum spacing to 40 pixels.
		$c->yAxis->setTickDensity(40);

		# Add a title to the y axis using dark grey (0x555555) 14pt Arial Bold font
		$c->yAxis->setTitle("Y-Axis Title Placeholder", "arialbd.ttf", 14, 0x555555);

		# Output the chart
		// header("Content-type: image/png");
		// print($c->makeChart2(PNG));

		// create folder if exists
		$folder = 'img/charts/' . $userIdFolder . '/' . $activityId;

		if ( ! is_dir('img/charts/' . $userIdFolder)) {
			mkdir('img/charts/' . $userIdFolder, 0777);
		}

		if ( ! is_dir($folder)) {
			mkdir($folder, 0777);
		}

		file_put_contents($folder . '/' . $q . '.png', $c->makeChart2(PNG));
    }
}
