var formatPercent = d3.format("0%");

var revchart_view_width = $("#mainCol").width();

var margin_revchart = {top: 30, right: revchart_view_width*.20, bottom: 30, left: revchart_view_width*.20},
    width_revchart = revchart_view_width - margin_revchart.left - margin_revchart.right,
    height_revchart = 400 - margin_revchart.top - margin_revchart.bottom;

$("#revchart").append("<br><br><div id = 'revchart-title' class = 'buffer'><h4 class = 'text-center'>Annual Revenue</h4><span id = 'org-type' class = 'title'><p id = 'org-name' class = 'text-center'></p><p id = 'org-n' class = 'text-center'></p></span></div>");

	
var svg_revchart = d3.select("#revchart")
    .append("svg")
    .attr("width", width_revchart + margin_revchart.left + margin_revchart.right)
    .attr("height", height_revchart + margin_revchart.top + margin_revchart.bottom)
   .append("g")
    .attr("transform", "translate(" + margin_revchart.left + "," + margin_revchart.top + ")");

var revchart_y_values = ["No income", "Less than $100k", "$100k to $499k", "$500k to $999k", "$1M to $4.9M", "$5M +"];	

var y_revchart = d3.scale.ordinal()
	.rangeRoundBands([0, height_revchart], .25)
	.domain(revchart_y_values);

var x_revchart = d3.scale.linear()
	.range([0, width_revchart])
	.domain([0, 1]);
	
var xAxis_revchart = d3.svg.axis()
	.scale(x_revchart)
	.tickSize(0)
	.orient("top")
	.ticks(4, "%");
	
var yAxis_revchart = d3.svg.axis()
	.scale(y_revchart)
	.orient("left")
	
svg_revchart.append("g")
	.attr("class", "x axis")
	.call(xAxis_revchart);

svg_revchart.append("g")
	.attr("class", "y axis")
	.call(yAxis_revchart);		
	
	$.ajax({
		type: "POST",
		url: "/data/getRevenueTotals.php",
        data: { org: "all" },
		success: function (response) {
			
			response = JSON.parse(response);
			
			svg_revchart.selectAll(".revBar")
				.data(response)
			  .enter().append("rect")
				.attr("class", "revBar")
				.attr("y", function(d) { return y_revchart(d.inc_class); })
				.attr("height", y_revchart.rangeBand())
				.attr("x", "0")
				.attr("width", function(d) { return x_revchart(d.pct); });
				
			svg_revchart.selectAll(".revLabel")
				.data(response)
			  .enter().append("text")
				.attr("class", "revLabel")
				.attr("font-size", "smaller")
				.attr("y", function(d) { return y_revchart(d.inc_class) + y_revchart.rangeBand()/2 + 2; })
				.attr("x", function(d) { return x_revchart(d.pct) + 5; })
				.text(function(d) { return formatPercent(d.pct) + " (" + d.n + ")"; });
		
			var total = d3.sum(response, function(d) {
					return (d.n);
			});
			
			$("#org-n").append('(' + total + ' total)');
			$("#org-name").append("All Vermont Nonprofits");
		 },
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
			
	});  	
	

$("#revchart-select").change(function() {
		
	var org = $(this).val();
		
	$.ajax({
		type: "POST",
		url: "/data/getRevenueTotals.php",
        data: { org: org },
		success: function (response) {
			response = JSON.parse(response);
			updateRevChart(response, org);
		 },
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
			
	});    
});


function updateRevChart(data, org) {

	svg_revchart.selectAll(".revBar")
		.data(data)
	  .transition().duration(300).ease("in-out")
		.attr("width", function(d) { return x_revchart(d.pct); });
		
	svg_revchart.selectAll(".revLabel")
		.data(data)
	  .transition().duration(300).ease("in-out")
		.attr("x", function(d) { return x_revchart(d.pct) + 5; })
		.text(function(d) { return formatPercent(d.pct) + " (" + d.n + ")"; });

	var total = d3.sum(data, function(d) {
		return (d.n);
	});
			
	$("#org-n").html('(' + total + ' total)').fadeIn(300);
	
	if (org == 'all') {
	
		$("#org-name").html("All Vermont Nonprofits").fadeIn(300);
	}
	
	else if (org == 'c3') {
		
		$("#org-name").html("All Vermont 501(c)(3)'s").fadeIn(300);
	}	
	
	else if (org == 'char') {
		
		$("#org-name").html("All Vermont Public Charities").fadeIn(300);
	}	
	
	else if (org == 'found') {
		
		$("#org-name").html("All Vermont Private Foundations").fadeIn(300);
	}		
	
	else if (org == 'notc3') {
		
		$("#org-name").html("Other 501(c)(3)'s").fadeIn(300);
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
