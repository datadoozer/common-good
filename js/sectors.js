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

var sectors_view_width = $("#mainCol").width();

var margin_sectors = {top: 30, right: sectors_view_width*.10, bottom: 30, left: sectors_view_width*.35},
    width_sectors = sectors_view_width - margin_sectors.left - margin_sectors.right,
    height_sectors = 500 - margin_sectors.top - margin_sectors.bottom;

$("#sectorschart").append("<br><br><div id = 'sectors-title' class = 'buffer'><h4 class = 'text-center' id = 'indicator'>Sector Distribution of Nonprofits</h4><h5 class = 'text-center'>for Vermont Public Charities</h5><h5 id = 'sectors-total' class = 'text-center'></h5></div>");

	
var svg_sectors = d3.select("#sectorschart")
    .append("svg")
    .attr("width", width_sectors + margin_sectors.left + margin_sectors.right)
    .attr("height", height_sectors + margin_sectors.top + margin_sectors.bottom)
   .append("g")
    .attr("transform", "translate(" + margin_sectors.left + "," + margin_sectors.top + ")");

var sectors_y_values;
// = ["Animal/Animal Rights", "Arts and Culture", "Education",
//						"Environment", "Civil Rights/Social Justice", "Community/Economic Development",
//						"Foundation/Giving Programs","Health and Human Services", "International Affairs",
//						"Affordable Housing/Homelessness", "Hunger/Food Security and Agriculture", "Religious/Spiritual",
//						"Unknown/Other"];	

var y_sectors = d3.scale.ordinal()
	.rangeRoundBands([0, height_sectors], .25);

var x_sectors = d3.scale.linear()
	.range([0, width_sectors])
	.domain([0, 1]);
	
var xAxis_sectors = d3.svg.axis()
	.scale(x_sectors)
	.tickSize(0)
	.orient("top")
	.ticks(4, "%");
	
svg_sectors.append("g")
	.attr("class", "x axis")
	.call(xAxis_sectors);	
	
	$.ajax({
		type: "POST",
		url: "/data/getSectors.php",
        data: { org: "all" },
		success: function (response) {
			
			data = JSON.parse(response);
			
			sectors_y_values = d3.map(data, function(d){return d.sector;}).keys();
			
			y_sectors.domain(sectors_y_values);
			
			var yAxis_sectors = d3.svg.axis()
				.scale(y_sectors)
				.orient("left")
			
			svg_sectors.append("g")
				.attr("class", "y axis")
				.call(yAxis_sectors);
			  //.selectAll(".tick text")
				//.call(wrap, y_sectors.rangeBand());				
			
			svg_sectors.selectAll(".sectorsBar")
				.data(data)
			  .enter().append("rect")
				.attr("class", "sectorsBar")
				.attr("y", function(d) { return y_sectors(d.sector); })
				.attr("height", y_sectors.rangeBand())
				.attr("x", "0")
				.attr("width", function(d) { return x_sectors(d.n_pct); });
				
			svg_sectors.selectAll(".sectorsLabel")
				.data(data)
			  .enter().append("text")
				.attr("class", "sectorsLabel")
				.attr("font-size", "smaller")
				.attr("y", function(d) { return y_sectors(d.sector) + y_sectors.rangeBand()/2 + 2; })
				.attr("x", function(d) { return x_sectors(d.n_pct) + 5; })
				.text(function(d) { return formatPercent(d.n_pct) + " (" + d.n + ")"; });
		
			var total = d3.sum(data, function(d) {
					return (d.n);
			});
			
			$("#sectors-total").append('(' + total + ' total)');

		 },
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
			
	});  	
	

$("#sectors-select").change(function() {
		
	var indicator = $(this).val();
		
	updatesectors(indicator);
  
});


function updatesectors(indicator) {
	

	svg_sectors.selectAll(".sectorsBar")
		.data(data)
	  .transition().duration(300).ease("in-out")
		.attr("width", function(d) { 
			if (indicator == 'n') {
				return x_sectors(d.n_pct); 
			}
				
			else return x_sectors(d.inc_pct);  	
		});
		
	svg_sectors.selectAll(".sectorsLabel")
		.data(data)
	  .transition().duration(300).ease("in-out")
		.attr("x", function(d) { 
			if (indicator == "n") {
				return x_sectors(d.n_pct) + 5;
			}
			else return x_sectors(d.inc_pct) + 5;
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
		$("#indicator").html('SECTOR DISTRIBUTION OF NONPROFITS');
		$("#sectors-total").html('(' + total + ' total)').fadeIn(300);
	}
	
	else {
		var total = d3.sum(data, function(d) { 
			return (d.inc);
		});
		$("#indicator").html('SECTOR DISTRIBUTION OF REVENUE');
		$("#sectors-total").html('(' + formatShortMoney(total) + ' total)').fadeIn(300);		
	}		
	
	

}

function wrap(text, width) {
  text.each(function() {
    var text = d3.select(this),
        words = text.text().split(/\s+/).reverse(),
        word,
        line = [],
        lineNumber = 0,
        lineHeight = 1.1, // ems
        y = text.attr("y"),
        dy = parseFloat(text.attr("dy")),
        tspan = text.text(null).append("tspan").attr("x", 0).attr("y", y).attr("dy", dy + "em");
    while (word = words.pop()) {
      line.push(word);
      tspan.text(line.join(" "));
      if (tspan.node().getComputedTextLength() > width) {
        line.pop();
        tspan.text(line.join(" "));
        line = [word];
        tspan = text.append("tspan").attr("x", 0).attr("y", y).attr("dy", ++lineNumber * lineHeight + dy + "em").text(word);
      }
    }
  });
}


