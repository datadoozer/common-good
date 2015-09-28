var flowchart_view_width = $("#mainCol").width();

var margin_flowchart = {top: 5, right: flowchart_view_width*.02, bottom: 100, left: flowchart_view_width*.02},
    width_flowchart = flowchart_view_width - margin_flowchart.left - margin_flowchart.right,
    height_flowchart = 400 - margin_flowchart.top - margin_flowchart.bottom;

var tree_flowchart = d3.layout.tree()
    .separation(function(a, b) { return a.parent === b.parent ? 1 : 1.2; })
    .children(function(d) { return d.parents; })
    .size([width_flowchart, height_flowchart]);

var svg_flowchart = d3.select("#flowchart")
    .append("svg")
    .attr("width", width_flowchart + margin_flowchart.left + margin_flowchart.right)
    .attr("height", height_flowchart + margin_flowchart.top + margin_flowchart.bottom)
   .append("g")
    .attr("transform", "translate(" + margin_flowchart.left + "," + margin_flowchart.top + ")");
	
$.ajax({
	type: "POST",
	url: "/data/getTotals.php",
	success: function (response) {
		response = JSON.parse(response);
		var total = response['total'];
		var not3 = response['not3'];
		var c3 = response['c3'];
		var pc = response['pc'];
		var pf = response['pf'];
		var asOf = response['asOf'];
		var rev = response['rev'];
		var asset = response['asset'];
		var smallRev = response['smallRev'];
		var noRev = response['noRev'];
		var lessThan100 = response['lt100'];
		var btw100and500 = response['btw100and500'];
		var btw500and1mil = response['btw500and1mil'];
		var btw1and5mil = response['btw1and5mil'];
		var morethan5mil = response['moreThan5mil'];

		$(".totalN").html(total);
		$("#totalc3").html(c3);
		$(".totalChar").html(pc);
		$("#totalFound").html(pf);
		$(".asOf").html(asOf);
		$("#charRev").html('$' + rev + ' billion');
		$("#charAss").html('$' + asset + ' billion');
		$("#smallRev").html(smallRev + "%");
		$("#notSmallRev").html(100-smallRev + "%");
		$("#noIncomeN").html(noRev);
		$("#noIncomePct").html(Math.round(noRev/pc*100) + "%");
		$("#lessThan100N").html(lessThan100);
		$("#lessThan100Pct").html(Math.round(lessThan100/pc*100) + "%");
		$("#between100and500").html(Math.round(btw100and500/pc*100) + "%");
		$("#between500and1milPct").html(Math.round(btw500and1mil/pc*100) + "%");
		$("#between500and1milN").html(btw500and1mil);
		$("#between1and5milPct").html(Math.round(btw1and5mil/pc*100) + "%");
		$("#between1and5milN").html(btw1and5mil);	
		$("#moreThan5Pct").html(Math.round(morethan5mil/pc*100) + "%");
		$("#moreThan5N").html(morethan5mil);			
		
		var ajaxResponse = {  
				"name": "All Vermont Nonprofits",
				"n": total,
				"parents": [
				  {
					"name": "Other 501(c)'s",
					"n": not3
				  },
				  {
				"name": "501(c)(3)'s",
				"n": c3,
					"parents": [
					  {
						"name": "Public Charities",
						"n": pc
					  },
					  {
						"name": "Private Foundations",
						"n": pf
					  }
					]
				  }
				]
			  };
	
		var nodes_flowchart = tree_flowchart.nodes(ajaxResponse);
  
		var node_flowchart = svg_flowchart.selectAll(".node")
			.data(nodes_flowchart)
		 .enter().append("g");
		
		node_flowchart.append("rect")
			.attr("width", 180)
			.attr("height", 50)
			.attr("fill", "white")
			.attr("stroke", "darkgreen")
			.attr("x", function(d) { return d.x - 90; })
			.attr("y", function(d) { return d.y; });

		node_flowchart.append("text")
			.attr("font-size", "16px")
			.attr("fill", "darkgreen")
			.attr("x", function(d) { return d.x; })
			.attr("y", function(d) { return d.y + 20; })
			.style("text-anchor", "middle")
			.text(function(d) { return d.name; });
			
		node_flowchart.append("text")
			.attr("font-size", "16px")
			.attr("fill", "darkgreen")
			.attr("font-weight", "bold")
			.attr("x", function(d) { return d.x; })
			.attr("y", function(d) { return d.y + 40; })
			.style("text-anchor", "middle")
			.text(function(d) { return d.n; });		

		var link_flowchart = svg_flowchart.selectAll(".link")
			.data(tree_flowchart.links(nodes_flowchart))
		  .enter().insert("path", "g")
			.attr("fill", "none")
			.attr("stroke", "darkgreen")
			.attr("shape-rendering", "crispEdges")
			.attr("d", connect);
	 },
	error: function (xhr, ajaxOptions, thrownError) {
		alert(xhr.status);
		alert(thrownError);
	}
			
		
});    

  
function connect(d, i) {
    return     "M" + d.source.x + "," + (d.source.y)
             + "V" + ((3*d.source.y + 4*d.target.y)/7)
             + "H" + d.target.x
             + "V" + d.target.y;
};


