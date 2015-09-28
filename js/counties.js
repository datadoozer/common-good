var formatPercent = d3.format("0%");
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

var data;

var counties_view_width = $("#mainCol").width();

var margin_counties = {top: 30, right: counties_view_width*.20, bottom: 30, left: counties_view_width*.20},
    width_counties = counties_view_width - margin_counties.left - margin_counties.right,
    height_counties = 700 - margin_counties.top - margin_counties.bottom;

$("#countieschart").append("<br><br><div id = 'counties-title' class = 'buffer'><h4 class = 'text-center' id = 'indicator'>County Distribution of Nonprofits</h4><h5 class = 'text-center'>for Vermont Public Charities</h5><h5 id = 'counties-total' class = 'text-center'></h5></div>");

	
var svg_counties = d3.select("#countieschart")
    .append("svg")
    .attr("width", width_counties + margin_counties.left + margin_counties.right)
    .attr("height", height_counties + margin_counties.top + margin_counties.bottom)
   .append("g")
    .attr("transform", "translate(" + margin_counties.left + "," + margin_counties.top + ")");

var counties_y_values = ["Addison", "Bennington", "Caledonia", "Chittenden", 
						 "Essex", "Franklin", "Grand Isle", "Lamoille", 
						 "Orange", "Orleans", "Rutland", "Washington",
						 "Windham", "Windsor"];	

var y_counties = d3.scale.ordinal()
	.rangeRoundBands([0, height_counties], .25)
	.domain(counties_y_values);

var x_counties = d3.scale.linear()
	.range([0, width_counties])
	.domain([0, 1]);
	
var xAxis_counties = d3.svg.axis()
	.scale(x_counties)
	.tickSize(0)
	.orient("top")
	.ticks(4, "%");
	
var yAxis_counties = d3.svg.axis()
	.scale(y_counties)
	.orient("left")
	
svg_counties.append("g")
	.attr("class", "x axis")
	.call(xAxis_counties);

svg_counties.append("g")
	.attr("class", "y axis")
	.call(yAxis_counties);		
	
	$.ajax({
		type: "POST",
		url: "/data/getCounties.php",
        data: { org: "all" },
		success: function (response) {
			
			data = JSON.parse(response);
			
			svg_counties.selectAll(".countiesBar")
				.data(data)
			  .enter().append("rect")
				.attr("class", "countiesBar")
				.attr("y", function(d) { return y_counties(d.county); })
				.attr("height", y_counties.rangeBand())
				.attr("x", "0")
				.attr("width", function(d) { return x_counties(d.n_pct); });
				
			svg_counties.selectAll(".countiesLabel")
				.data(data)
			  .enter().append("text")
				.attr("class", "countiesLabel")
				.attr("font-size", "smaller")
				.attr("y", function(d) { return y_counties(d.county) + y_counties.rangeBand()/2 + 2; })
				.attr("x", function(d) { return x_counties(d.n_pct) + 5; })
				.text(function(d) { return formatPercent(d.n_pct) + " (" + d.n + ")"; });
		
			var total = d3.sum(data, function(d) {
					return (d.n);
			});
			
			$("#counties-total").append('(' + total + ' total)');

		 },
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
			
	});  	
	

$("#counties-select").change(function() {
		
	var indicator = $(this).val();
		
	updatecounties(indicator);
  
});


function updatecounties(indicator) {
	

	svg_counties.selectAll(".countiesBar")
		.data(data)
	  .transition().duration(300).ease("in-out")
		.attr("width", function(d) { 
			if (indicator == 'n') {
				return x_counties(d.n_pct); 
			}
				
			else return x_counties(d.inc_pct);  	
		});
		
	svg_counties.selectAll(".countiesLabel")
		.data(data)
	  .transition().duration(300).ease("in-out")
		.attr("x", function(d) { 
			if (indicator == "n") {
				return x_counties(d.n_pct) + 5;
			}
			else return x_counties(d.inc_pct) + 5;
		})
		.text(function(d) { 
			if (indicator == "n") {
				return formatPercent(d.n_pct) + " (" + d.n + ")";
			}
			else return formatPercent(d.inc_pct) + " (" + formatShortMoney(d.inc) + ")"; 
		});
	
	if (indicator == 'n') {
		var total = d3.sum(data, function(d) {
			return (d.n);
		});
		$("#indicator").html('County Distribution of Nonprofits');
		$("#counties-total").html('(' + total + ' total)').fadeIn(300);
	}
	
	else {
		var total = d3.sum(data, function(d) { 
			return (d.inc);
		});
		$("#indicator").html('County Distribution of Revenue');
		$("#counties-total").html('(' + formatShortMoney(total) + ' total)').fadeIn(300);		
	}		
	
	

}


