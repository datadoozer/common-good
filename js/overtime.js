var parseDate = d3.time.format("%Y").parse;
var dateFormat = d3.time.format("%Y");
var moneyFormat = d3.format(",");

function formatShortMoney(d) {
	var out = d3.round(d/1000000,0);
	if (out < 1000) {
		out = "$" + out + " M";
	}
	else {
		out = d3.round(out / 1000, 0);
		out = "$" + out + " B"
	}
	return out;
}	

$(document).ready(function() {
var data;

var overtime_view_width = $("#mainCol").width();

var margin_overtime = {top: 30, right: overtime_view_width*.20, bottom: 30, left: overtime_view_width*.10},
    width_overtime = overtime_view_width - margin_overtime.left - margin_overtime.right,
    height_overtime = 400 - margin_overtime.top - margin_overtime.bottom;

$("#timechart").append("<br><br><div id = 'time-title' class = 'buffer'><h4 class = 'text-center' id = 'indicatorTitle'>Average Establishments</h4><h5 id = 'timeperiod' class = 'text-center'></h5></div>");

	
var svg_overtime = d3.select("#timechart")
    .append("svg")
    .attr("width", width_overtime + margin_overtime.left + margin_overtime.right)
    .attr("height", height_overtime + margin_overtime.top + margin_overtime.bottom)
   .append("g")
    .attr("transform", "translate(" + margin_overtime.left + "," + margin_overtime.top + ")");
	
var x_overtime = d3.time.scale()
    .range([0, width_overtime]);

var y_overtime = d3.scale.linear()
    .range([height_overtime, 0]);

var xAxis_overtime = d3.svg.axis()
    .scale(x_overtime)
    .orient("bottom");

var yAxis_overtime = d3.svg.axis()
    .scale(y_overtime)
	.ticks(7)
    .orient("left");
	
var yAxis_overtime_money = d3.svg.axis()
    .scale(y_overtime)
	.ticks(7)
	.tickFormat(function(d) { return "$" + moneyFormat(d); })
    .orient("left");	
	
var yAxis_overtime_big_money = d3.svg.axis()
    .scale(y_overtime)
	.ticks(7)
	.tickFormat(function(d) { return "$" + d3.round(d/1000); })
    .orient("left");	
	
var establishLine = d3.svg.line()
	.interpolate("monotone")			
	.x(function(d) { return x_overtime(d.Year); })
	.y(function(d) { return y_overtime(d.establishments); });
	
var employLine = d3.svg.line()
	.interpolate("monotone")			
	.x(function(d) { return x_overtime(d.Year); })
	.y(function(d) { return y_overtime(d.employment); });	
	
var totalWagesLine = d3.svg.line()
	.interpolate("monotone")			
	.x(function(d) { return x_overtime(d.Year); })
	.y(function(d) { return y_overtime(d.totalWages); });	
	

var annualWagesLine = d3.svg.line()
	.interpolate("monotone")			
	.x(function(d) { return x_overtime(d.Year); })
	.y(function(d) { return y_overtime(d.annualWages); });	
	
var weeklyWagesLine = d3.svg.line()
	.interpolate("monotone")			
	.x(function(d) { return x_overtime(d.Year); })
	.y(function(d) { return y_overtime(d.weeklyWages); });		
	
	$.ajax({		
		type: "POST",
		url: "/data/getOvertime.php",
        data: { indicator: "establishments" },
		success: function (response) {
			
			data = JSON.parse(response);
			
			data.forEach(function(d) {
				d.Year= parseDate(d.Year);
				d.establishments = +d.establishments;		
				d.employment = +d.employment;	
				d.totalWages = +d.totalWages;				
				d.annualWages = +d.annualWages;
				d.weeklyWages = +d.weeklyWages;				
			});
			
			x_overtime.domain(d3.extent(data, function(d) { return d.Year; }));
			y_overtime.domain([0, d3.max(data, function(d) { return d.establishments; })]);
			
			var minYear = dateFormat(d3.min(data, function(d) { return d.Year; }));
			
			var maxYear = dateFormat(d3.max(data, function(d) { return d.Year; }));
			
			$(".BLS").html(maxYear);
			
			$("#timeperiod").append("(" + minYear + " - " + maxYear + ")");
			
			svg_overtime.append("g")
				.attr("class", "x axis")
				.attr("transform", "translate(25," + height_overtime + ")")
				.call(xAxis_overtime);

			svg_overtime.append("g")
				.attr("class", "y axis")
				.call(yAxis_overtime);				

			svg_overtime.append("path")
				.attr("class", "trend")
				.attr("d", establishLine(data))
				.attr("transform", "translate(25, 0)");		

			var timepoint = svg_overtime.append("g")
				.attr("class", "timepoint");

			timepoint.selectAll('circle')
				.data(data)
			  .enter().append('circle')
				.attr("class", "dot")
				.attr("cx", function(d) { return x_overtime(d.Year) })
				.attr("cy", function(d) { return y_overtime(d.establishments) })
				.attr("r", 5)
				.attr("transform", "translate(25, 0)");	

		$("#timetable-div").html("<table class = 'table' id = 'timetable'> \
										<thead> \
											<tr> \
												<th class = 'text-right'>Indicator</th> \
												<th class = 'text-right'>2007</th> \
												<th class = 'text-right'>2008</th> \
												<th class = 'text-right'>2009</th> \
												<th class = 'text-right'>2010</th> \
												<th class = 'text-right'>2011</th> \
												<th class = 'text-right'>2012</th> \
											</tr> \
										</thead> \
										<tbody> \
										</tbody> \
									</table>");
		
		$("#timetable > tbody").append("<tr><td>Average Establishments</td>");
		
		data.forEach(function(d) {
			
			$("#timetable > tbody tr").append("<td>" + moneyFormat(d.establishments) + "</td>");
			
		});
		
		$("#timetable > tbody").append("<tr><td>Average Annual Employment</td>");		

		data.forEach(function(d) {
			
			$("#timetable > tbody tr:last-child").append("<td>" + moneyFormat(d.employment) + "</td>");
			
		});		

		$("#timetable > tbody").append("<tr><td>Total Annual Wages (in Thousands)</td>");	
		
		data.forEach(function(d) {
			
			$("#timetable > tbody tr:last-child").append("<td>$" + moneyFormat(d.totalWages) + "</td>");
			
		});	
		
		$("#timetable > tbody").append("<tr><td>Annual Wages per Employee</td>");	
		
		data.forEach(function(d) {
			
			$("#timetable > tbody tr:last-child").append("<td>$" + moneyFormat(d.annualWages) + "</td>");
			
		});		

		$("#timetable > tbody").append("<tr><td>Average Weekly Wage</td>");	
		
		data.forEach(function(d) {
			
			$("#timetable > tbody tr:last-child").append("<td>$" + moneyFormat(d.weeklyWages) + "</td>");
			
		});

		d3.selectAll("td")
			.attr("class", "text-right");
		
		 },
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
			
	});  			
	


											

$("#overtime-select").change(function() {
		
	var indicator = $(this).val();
		
	updateovertime(indicator);
  
});


function updateovertime(indicator) {
	
	var svg_overtime = d3.select("#timechart").transition();
	

	if (indicator == "establishments") {
		
		y_overtime.domain([0, d3.max(data, function(d) { return d.establishments; })]);			
			
		svg_overtime.select(".y.axis") // change the y axis
			.duration(750)
			.call(yAxis_overtime);
			
		svg_overtime.selectAll(".trend").duration(750).ease("in-out")
			.attr("d", establishLine(data));		
			
		svg_overtime.selectAll(".dot")   // change the line
			.duration(750).ease("in-out")
			.attr("cx", function(d) { return x_overtime(d.Year) })			
			.attr("cy", function(d) { return y_overtime(d.establishments) });			

			
		$("#indicatorTitle").html("Average Establishments");	
		
	}
	
	else if (indicator == "employment") {
	
		y_overtime.domain([0, d3.max(data, function(d) { return d.employment; })]);			
		
		svg_overtime.select(".y.axis") // change the y axis
			.duration(750)
			.call(yAxis_overtime);
			
		svg_overtime.selectAll("path.trend").duration(750).ease("in-out")
			.attr("d", employLine(data));		
			
		svg_overtime.selectAll(".dot")
			.duration(750).ease("in-out")
			.attr("cx", function(d) { return x_overtime(d.Year) })			
			.attr("cy", function(d) { return y_overtime(d.employment) });			

			
		$("#indicatorTitle").html("Annual Average Employment");	
	
	}
	
	else if (indicator == "totalWages") {
	
		y_overtime.domain([0, d3.max(data, function(d) { return d.totalWages; })]);			
		
		svg_overtime.select(".y.axis") // change the y axis
			.duration(750)
			.call(yAxis_overtime_big_money);
			
		svg_overtime.selectAll("path.trend").duration(750).ease("in-out")
			.attr("d", totalWagesLine(data));		
			
		svg_overtime.selectAll(".dot")
			.duration(750).ease("in-out")
			.attr("cx", function(d) { return x_overtime(d.Year) })			
			.attr("cy", function(d) { return y_overtime(d.totalWages) });			

			
		$("#indicatorTitle").html("Total Annual Wages (In Millions)");	
	
	}	
	
	else if (indicator == "annualWages") {
	
		y_overtime.domain([0, d3.max(data, function(d) { return d.annualWages; })]);			
		
		svg_overtime.select(".y.axis") // change the y axis
			.duration(750)
			.call(yAxis_overtime_money);
			
		svg_overtime.selectAll("path.trend").duration(750).ease("in-out")
			.attr("d", annualWagesLine(data));		
			
		svg_overtime.selectAll(".dot")
			.duration(750).ease("in-out")
			.attr("cx", function(d) { return x_overtime(d.Year) })			
			.attr("cy", function(d) { return y_overtime(d.annualWages) });			

			
		$("#indicatorTitle").html("Annual Wages per Employee");	
	
	}		

	else if (indicator == "weeklyWages") {
	
		y_overtime.domain([0, d3.max(data, function(d) { return d.weeklyWages; })]);			
		
		svg_overtime.select(".y.axis") // change the y axis
			.duration(750)
			.call(yAxis_overtime_money);
			
		svg_overtime.selectAll("path.trend").duration(750).ease("in-out")
			.attr("d", weeklyWagesLine(data));		
			
		svg_overtime.selectAll(".dot")
			.duration(750).ease("in-out")
			.attr("cx", function(d) { return x_overtime(d.Year) })			
			.attr("cy", function(d) { return y_overtime(d.weeklyWages) });			

			
		$("#indicatorTitle").html("Average Weekly Wage");	
	
	}		
	
}

});
