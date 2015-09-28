<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Common Good Demo</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">	 

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body>
	
	<header style = "height: 50px;">

	</header>

	<div class="container">
		<div class="row">
				<div class="col-md-2" id="leftCol">
					<h2 class="text-center"><small>Menu</small></h2>				  
					<ul class="nav nav-pills nav-stacked" role = "tablist" id="sidebar">
					  <li role = "presentation" class = "active"><a href="#welcome" aria-controls = "welcome" role="tab" data-toggle="tab">Welcome</a></li>
					  <li role = "presentation"><a href="#statewide" aria-controls="statewide" role="tab" data-toggle="tab">Statewide Overview</a></li>
					  <li role = "presentation"><a href="#sectors" aria-controls="sectors" role="tab" data-toggle="tab">Compare Sectors</a></li>
					  <li role = "presentation"><a href="#counties" aria-controls="counties" role="tab" data-toggle="tab">Compare Counties</a></li>					  
					  <li role = "presentation"><a href="#overtime" aria-controls="overtime" role="tab" data-toggle="tab">Labor Statistics</a></li>	
					  <li role = "presentation"><a href="#explore" aria-controls="explore" role="tab" data-toggle="tab">Explore the Data</a></li>					  
					  <li role = "presentation"><a href="#otherData" aria-controls="otherData" role="tab" data-toggle="tab">Other Interesting Data Points</a></li>
					  <li role = "presentation"><a href="#sources" aria-controls="sources" role="tab" data-toggle="tab">Data Sources</a></li>
				  </ul>
				  
				</div>  
				<div class="col-md-8 tab-content" id="mainCol">
				  
					<br>
					<div role = "tabpanel" class = "tab-pane active container-fluid" id = "welcome">
						<div>
							<div class = "row">
								<img src = "img/logo.jpg" class = "img-responsive col-md-10"/>
							</div>
							<br>
							<div class = "clearfix row">
								<h3 class = "page-head"> Vermont’s Nonprofit Sector: An Economic Driver & Vital Community Partner</h3>
								<!--<h3 class = "page-head"><small>Interact with the data!</small></h3>-->
								<p class = "intro-text">If you have comments about how to make this more useful please we'd like to <a href = "mailto:Coordinator@CommonGoodVT.org">hear from you</a>.
								<p class = "intro-text">
								   Every person in Vermont is served, in some way, by state and local nonprofit 
								   organizations--classified as public charities. We've put together an 
								   interactive visualization of Vermont's nonprofit sector so that you can make 
								   better decisions, locate organizations that share your mission and 
								   communicate the meaningful difference these organizations make in the life 
								   of Vermonters and the overall health of our economy.
								</p>
								<p class = "intro-text">
									Get the <a href = "http://blog.commongoodvt.org/2015/02/fast-facts-the-economic-power-of-vermonts-nonprofit-sector/" target = "_blank">Fast Facts</a>, 
									gain an overview of the <a href="statewide" class = 'aToggle'>sector’s statewide financial impact</a>, 
									<a href = "counties" class = "aToggle">compare counties</a>, 
									<a href = "sectors" class = "aToggle">compare sectors</a>, 
									and <a href = "explore" class = "aToggle">dive into the detail of Vermont’s nonprofit organizations</a>.
								</p>						
								<p class = "intro-text">
									Special thanks to the <a href="http://www.vermontcf.org" target = "_blank">Vermont Community Foundation</a>, 
									the <a href = "http://www.hendersonfdn.org" target="_blank">A.D. Henderson Foundation</a>, <a href = "http://publicassets.org" target = "_blank"> Public Assets Institute</a>, and 
									the <a href = "http://www.uvm.edu/crs/Census/" target = "_blank">Vermont State Data Center</a>, and <a href = "http://www.datadoozer.com/" target = "_blank">Data Doozer</a>
									for helping the numbers come to life.
								</p>
								<br>
								<h4 class = "page-head"> Short Story </h4>
								<ul>
									<li class = "lead">More than <strong><span class = "totalN"> 4100 </span> Vermont nonprofits</strong> serve all corners of the state. With healthcare and education driving sector revenue, public charities generate nearly <strong>$6 billion in revenue in 2014.</li></strong>
									<li class = "lead">Vermont nonprofits paid nearly <strong>$2 billion</strong> in <strong>wages</strong>, which translates into an estimated $34 million of personal income tax revenue for Vermont’s state and local governments and over $334 million in federal tax revenues.</li>
									<li class = "lead">Nonprofits employ <strong>1 in 7 Vermont workers</strong>, making the nonprofit sector the largest industry in the state after the government.</li>
									<li class = "lead">Vermont nonprofits contribute <strong>$5.7 billion</strong> per year to the economy through wages paid, retail and wholesale purchases, and professional service contracts. This contribution is equivalent to nearly <strong>20% of the State’s gross state product</strong>–greater than the manufacturing and construction industries combined.</li>
								<ul>
								<br>
								<h5 class = "text-right"><a href="statewide" class = 'aToggle'>Get an Overview of the Vermont Nonprofit Sector > </a></h5>
							</div>

							
						</div> <!-- row -->
					</div> <!-- container-fluid -->
		
					<div role = "tabpanel" class = "tab-pane container-fluid" id = "statewide">
						<div class = "row">
							<img src = "img/logo.jpg" class = "img-responsive col-md-4 pull-right"/>
						</div>
						<div class = "row">
							<h4 class = "page-head">Scope of the Sector</h4>			
							<div>
								<p>
									<br>
									As of <span class = "asOf">June 2015</span> , there are <span class = "totalN">5619</span> nonprofits 
									serving Vermonters (defined as 501(c) organizations). Of these, <span id = "totalc3">4386</span> are classified as 501(c)(3)s,
									the most common type of tax-exempt nonprofit organization. Of these, <span class = 'totalChar'>4109</span> are <strong>Public Charities</strong> 
									and <span id = "totalFound">277</span> are <strong>Private Foundations</strong>. The following numbers reflect an analysis of 
									Vermont Public Charities.
								</p>
							</div>
							<div class = "well">
								<div id = "flowchart"></div>
								<div>
									<p> Source:
										<a href = "http://www.irs.gov/Charities-&-Non-Profits/Exempt-Organizations-Business-Master-File-Extract-EO-BMF" target = "_blank">
										IRS Master File for NonProfit Business (<span class = "asOf">June 2015</span>)</a>
									</p>
								</div>							
							</div>

						</div> <!-- row -->
						
						<div class = "row">
							<h4 class = "page-head">Nonprofit Revenue</h4>			
							<div>
								<p>
									Vermont’s <span class = "totalChar">4109</span> public charities 
									generate <strong>nearly $6 billion in annual Revenue </strong>
									and represent just under <strong>$10 billion in Assets</strong>. 
									But Vermont’s public charities tend to be small and operate with 
									modest revenues. Of those filing with the IRS as of 
									<span class = "asOf">2014</span>, <span id = "smallRev">81%</span> reported less than 
									$500,000 in revenue and <span id = "notSmallRev">19%</span> reported 
									more. Looking at revenue categories, <strong><span id = "noIncomePct">51%</span> reported 
									no income at all</strong> (<span id = "noIncomeN">2098</span>). The next largest 
									revenue group, those reporting <strong>less than $100,000, represent <span id = "lessThan100Pct">17%</span></strong> of 
									the	sector (<span id = "lessThan100N">718</span>). Nearly 
									<strong><span id = "between100and500">12%</span> of Vermont’s public charities report revenue 
									between $100K and $500K.</strong>				
								</p>
								<p>
									The larger organizations tend to be hospitals, colleges, major arts and cultural 
									institutions, and those that serve larger geographic groups of organizations. Of 
									these, <strong><span id = "between500and1milPct">6%</span> report between $500K and $1 million 
									in revenue</strong> (<span id = "between500and1milN">252</span>), 
									<span id = "between1and5milPct">8%</span> report $1 to 5 
									million (<span id = "between1and5milN">330</span>), and 
									<strong><span id = "moreThan5Pct">5%</span> report more than $5 million</strong> (<span id = "moreThan5N">212</span>).
								</p>
							</div>
							<br>
							<p>
								<strong><a href = "http://blog.commongoodvt.org/2015/02/fast-facts-the-economic-power-of-vermonts-nonprofit-sector/" target = "_blank">More Analysis</a></strong>
							</p>							
						
							<div class = "well">
								<div class = "form-group pull-right">
									<label><strong>Select an Organization Type:</strong> 
										<select id = "revchart-select" class = "form-control">
											<optgroup label="All VT Nonprofits">
												<option value = "all"> All VT Nonprofits</option>
											</optgroup>
											<optgroup label = "501(c)(3)'s">
												<option value = "c3"> All 501(c)(3)'s</option>
												<option value = "char"> Public Charities</option>
												<option value = "found"> Private Foundations</option>
											</optgroup>
											<optgroup label = "Other 501(c)'s">
												<option value = "notc3"> Other 501(c)'s</option>
											</optgroup>
											<!--<option value = "HandC"> Hospitals & Colleges </option>-->
										</select>
									</label>
								</div>
								<div id = "revchart"></div>
								<div>
									<p> Source:
										<a href = "http://www.irs.gov/Charities-&-Non-Profits/Exempt-Organizations-Business-Master-File-Extract-EO-BMF" target = "_blank">
										IRS Master File for NonProfit Business (<span class = "asOf">June 2015</span>)</a>
									</p>
									
								</div>
							<br>								
							</div>
							<h5 class = "text-right">Compare <a href="sectors" class = 'aToggle'>sectors</a> or <a href = "counties" class = "aToggle">counties ></a></h5>
						</div> <!-- row -->
					</div> <!-- container-fluid -->	
				
					<div role = "tabpanel" class = "tab-pane container-fluid" id = "sectors">
						<div class = "row">
							<img src = "img/logo.jpg" class = "img-responsive col-md-4 pull-right"/>
						</div>					
						<div class = "row">
							<h4 class = "page-head"><h4 class = "page-head">A Variety of Sectors Deliver Vital Community Services</h4>	</h4>	
								<div>
									<p>
									<br>
										Every person in Vermont is served, in some way, 
										by state and local nonprofit organizations. <strong>Health care</strong> 
										and <strong>education constitute</strong> the largest number of nonprofits, 
										the largest nonprofits and the largest portion of 
										Vermont nonprofit revenue.	
									</p>

						<div class = "well">
							<div class = "form-group pull-right">
								<label><strong>Select an Indicator:</strong> 
									<select id = "sectors-select" class = "form-control">
										<option value = "n"> Number of Nonprofits </option>
										<option value = "rev"> Percent of Revenue </option>
									</select>
								</label>	
							</div>
							<div id = "sectorschart"></div>
								<div>
									<p> Source:
										<a href = "http://www.irs.gov/Charities-&-Non-Profits/Exempt-Organizations-Business-Master-File-Extract-EO-BMF" target = "_blank">
										IRS Master File for NonProfit Business (<span class = "asOf">June 2015</span>)</a>
									</p>
								</div>							
						</div>									

								</div>
						</div> <!-- row -->
							
						<div class = "row">
							<div>
								<h4 class = "page-head">Value of the Sector </h4>									
							</div>
							<br>
							<p>
								Taken together, Vermont’s public charities represent <strong>nearly $6 billion in annual Revenue</strong> and <strong>$10 billion in Assets</strong>.
								Large organizations, especially <strong>hospitals and colleges</strong> dominate the financial activity of Vermont’s charitable sector. These organizations receive the majority of their revenue from program services, while smaller organizations rely on contributions, gifts, and grants as their primary source of revenue.
							</p>	
							<p>
								<strong>The balance of Vermont public charities that are not hospitals or colleges</strong> contribute $3 billion in revenue, (45% of the total sector).
							<br>
							<br>
								(Source: IRS Nonprofit Organizations Business Master File, <span class = "asOf">October 2014</span>).							
							</p>
							<br>
							<p>
								<strong><a href = "http://blog.commongoodvt.org/2015/02/fast-facts-the-economic-power-of-vermonts-nonprofit-sector/" target = "_blank">More Analysis</a></strong>
							</p>
							<br>
						</div> <!-- row -->
							

						<h5 class = "text-right"><a href="counties" class = 'aToggle'>Compare counties > </a></h5>
					</div> <!-- container-fluid -->					

					<div role = "tabpanel" class = "tab-pane container-fluid" id = "counties">
						<div class = "row">
							<img src = "img/logo.jpg" class = "img-responsive col-md-4 pull-right"/>
						</div>					
						<div class = "row">
							<h4 class = "page-head">Serving All Corners of Vermont</h4>			
							<div>
							<br>
								<p>
									Vermont public charities can be found in every county except Essex.  More than a 
									quarter of Vermont nonprofits are found in Chittenden County (<span id = "chittendenPctN">24%</span>) 
									with <span id = "chittendenN">nearly 1000</span> reporting to the IRS as of <span class = "asOf">October 2014</span>. 
									Central Vermont/ Washington County represents <span id = "centralPctN">13%</span> of the sector 
									(<span id = "centralN">550+</span>). Windham (<span if = "windhamPctN">10%</span>) and Windsor County 
									(<span id = "windsorPctN">11%</span>) report more than <span id = "windhamAndWindsorN">400</span> nonprofits in 
									each of their counties. Just over <span id = "rutlandN">350</span> operate in Rutland 
									County (<span id = "rutlandPctN">8%</span> of the state’s total). Their distribution tracks closely to county 
									population in most counties–with the notable exception of Franklin County.				
								</p>
							</div>
						</div> <!-- row -->

							<div class = "well">
								<div class = "form-group pull-right">
									<label><strong>Select an Indicator:</strong> 
										<select id = "counties-select" class = "form-control">
											<option value = "n"> Number of Nonprofits </option>
											<option value = "rev"> Percent of Income </option>
										</select>
									</label>	
								</div>
								<div id = "countieschart"></div>
								<div>
									<p> Source:
										<a href = "http://www.irs.gov/Charities-&-Non-Profits/Exempt-Organizations-Business-Master-File-Extract-EO-BMF" target = "_blank">
										IRS Master File for NonProfit Business (<span class = "asOf">June 2015</span>)</a>
									</p>
								</div>								
							</div>						
						
						<div class = "row">
							<h4 class = "page-head">Revenue Distribution</h4>			
							<div>
							<br>
								<p>
									Nearly <span id = "chittendenRevPct">40%</span> of Vermont nonprofit revenue is 
									centered in Chittenden County, with the balance dispersed across every county 
									but Essex and Grand Isle. (The organizations that serve these regions are based 
									in adjacent counties.)	
								</p>
							</div>
							<br>
							<p>
								<strong><a href = "http://blog.commongoodvt.org/2015/02/fast-facts-the-economic-power-of-vermonts-nonprofit-sector/" target = "_blank">More Analysis</a></strong>
							</p>							
						</div> <!-- row -->						
						

						<h5 class = "text-right"><a href="sectors" class = 'aToggle'>Compare sectors > </a></h5>						
					</div> <!-- container-fluid -->					

					<div role = "tabpanel" class = "tab-pane container-fluid" id = "overtime">
						<div class = "row">
							<img src = "img/logo.jpg" class = "img-responsive col-md-4 pull-right"/>
						</div>					
						<div class = "row">
							<h4 class = "page-head">Labor Statistics</h4>			
							<div>
							<br>
								<p>
									The U.S. Bureau of Labor Statistics develops research data on employment, wages and establishment figures for nonprofit institutions with a specific focus on 501(c)(3)'s. They recently released comparative data 
									on the number of Vermont nonprofit employees between 2007-20012, which provides insight into the growth of the sector and changes in compensation. 
								</p>
								<br>
								<p>
									Learn more about the <a href = "http://www.bls.gov/bdm/nonprofits/nonprofits.htm" target="_blank">
										methodology behind these numbers</a>. 		
								</p>
							</div>
						</div> <!-- row -->

							<div class = "well">
								<div class = "form-group pull-right">
									<label><strong>Select an Indicator:</strong> 
										<select id = "overtime-select" class = "form-control">
											<option value = "establishments"> Average Establishments </option>
											<option value = "employment"> Average Annual Employment </option>
											<option value = "totalWages"> Total Annual Wages </option>
											<option value = "annualWages"> Annual Wages per Employee </option>
											<option value = "weeklyWages"> Average Weekly Wages </option>
										</select>
									</label>	
								</div>
								<div id = "timechart"></div>
								<br>
								<div id = "timetable-div"></div>
								<br>
								<div>
									<p> Source:
										<a href = "http://www.bls.gov/bdm/nonprofits/nonprofits.htm" target = "_blank">
										US Bureau of Labor Statistics Research Data on the Nonprofit Sector (<span class = "BLS">2012</span>)</a>
									</p>
								</div>								
							</div>						
											
						

						<h5 class = "text-right"><a href="explore" class = 'aToggle'>Explore the Data > </a></h5>						
					</div> <!-- container-fluid -->							
	
					<div role = "tabpanel" class = "tab-pane container-fluid" id = "explore">
						<div class = "row">
							<img src = "img/logo.jpg" class = "img-responsive col-md-4 pull-right"/>
						</div>					
						<div class = "row">
							<h4 class = "page-head">Explore the Data</h4>			
							<div>
								<p>
								    The table contains details about all of Vermont's nonprofits, as reported
									in the <a href = "http://www.irs.gov/Charities-&-Non-Profits/Exempt-Organizations-Business-Master-File-Extract-EO-BMF" target = "_blank">
									IRS Nonprofit Organizations Business Master File as of <span class = "asOf"> June 2015 </span></a>.
									You can filter the results by name, county, or sector (according to the 
									<a href = "http://nccsdataweb.urban.org/kbfiles/324/NTEE_Two_Page_2005.pdf" target = "_blank">
									National Taxonomy of Exempt Entity (NTEE) Major Groups</a>).
									To filter, start typing in the search box appearing at the bottom of the column.
								</p>
								<p>
									You can also download the data by clicking on the download button.
								</p>
							</div>
							<br>
							<div id = "explore-table-container" class = "table-responsive">
								<table id = "explore-table" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Organization Name</th>
											<!--<th>Town</th>-->
											<th>County</th>
											<th>NTEE Major Group&sup1 </th>
											<!--
											<th>Assets</th>
											<th>Income</th>
											-->
											<th>Revenue</th>	
										</tr>
									</thead>
									<tbody>
									</tbody>
									<tfoot>
										<tr>
											<th>Organization Name</th>
											<!--<th>Town</th>-->
											<th>County</th>
											<th>NTEE Major Group&sup1 </th>
											<!--											
											<th>Assets</th>
											<th>Income</th>
											-->
											<th>Revenue</th>	
										</tr>
									</tfoot>									
								</table>
								<div><h5><a title = "Click for a list of Major Group Names" href = "http://nccsdataweb.urban.org/kbfiles/324/NTEE_Two_Page_2005.pdf" target = "_blank"><small>&sup1 National Taxonomy of Exempt Entities (NTEE) Major Groups </h5></small></a></div>
							</div>

						
						</div> <!-- row -->
					</div> <!-- container-fluid -->					

						<div role = "tabpanel" class = "tab-pane container-fluid" id = "otherData">
						<div class = "row">
							<img src = "img/logo.jpg" class = "img-responsive col-md-4 pull-right"/>
						</div>						
						
							<div class = "row">
								<h4 class = "page-head">Contributor to Gross State Product</h4>
								<br>
								<div>
									<p>
										Vermont’s Gross State Product (GSP) totalled $29.05 billion in 2013. Taken as a 
										whole, charitable organizations account for 19.96% of Vermont’s State Product (GSP). 
										Their share of the GSP is larger than these key Vermont industries Manufacturing, 
										or Durable Goods, Retail Trade, Finance/ Insurance, Construction, Utilities, 
										Transportation or Agriculture. In 2013,  Manufacturing accounted for $3.2 billion in 
										revenue (11% of GSP) and Retail Trade generated $2.2 billion (8% of GSP). By 
										comparison, in 2014, Vermont nonprofit Hospital revenue constitutes 8% and 
										Colleges account for 3% of the GSP. 
										<br>
									</p>
									<p>
										<strong>Source:</strong>
										<a href = "http://www.vtlmi.info/profile2014.pdf" target = "_blank">
										Vermont Department of Labor Demographic Profile Series, 2014</a>
									</p>
									<p>
										<br>
										<strong>See Interactive Chart:</strong> <a href = "https://infogr.am/vermont_industry_as_percentage_of_gross_state_product" target = "_blank">
										Vermont Industry as % of Gross State Product</a>
										<br>
										<small>Note: We’ve combined data across the two years to show the relative scale of 
										contribution to Vermont’s economic output in the Chart above.</small>
									</p>											
								</div>
							</div> <!-- row -->
							<br>
							<div class = "row">
								<h4 class = "page-head">Major Employer</h4>			
								<br>
								<div>
									<p>
										In 2012, Vermont nonprofits employed 44,131 people. This represents 14.8% of the State’s 
										total workforce or 1 in 7 Vermont workers. Nationally, approximately 10% of workers 
										are employed by a nonprofit organization.  This workforce makes Vermont’s nonprofit 
										sector the largest industry in the state, after state and local government. 
										In fact, Vermont’s nonprofits employ more than three times as many workers as the 
										construction industry and sixteen times as many workers as the state’s natural 
										resources industry (which includes agriculture, forest products, fishing and hunting). 
										<strong>Distribution of Vermont nonprofit employment is not available at this time.</strong>
									</p>
									<p>
										<br>
										<strong>Source:</strong><a href = "http://www.vtlmi.info/profile2014.pdf" target = "_blank">
										Vermont Department of Labor Demographic Profile Series, 2014</a>. 
									</p>
									<p>
										<br>
										<strong>See Interactive Chart:</strong><a href = "https://infogr.am/vermont_employment_by_industry_2012" target = "_blank">
										Vermont Employment by Industry</a>
									</p>											
								</div>
							</div> <!-- row -->							
							<br>
							<div class = "row">
								<h4 class = "page-head">Payroll</h4>			
								<br>
								<div>
									<p>
										In 2012, Vermont’s nonprofits paid their employees $1.9 Billion in wages, or more 
										than 16% of the state’s total payroll. The average wage was $44,882 or $21.75/ hour, 
										compared with the State average of $19.85/ hour. 
									</p>
									<p>
										<br>
										Learn more on Vermont’s nonprofit 
										wages and compensation in the
										<a href = "http://blog.commongoodvt.org/2014/12/hot-off-the-press-2014-report-on-nonprofit-wages-benefits-in-northern-new-england/" target = "_blank">
										2014 Vermont Nonprofit Wage & Salary Survey.</a>
									</p>										
								</div>
							</div> <!-- row -->		
							<br>
							<div class = "row">
								<h4 class = "page-head">Taxes</h4>			
								<br>
								<div>
									<p>
										Despite being exempt from corporate income tax, nonprofits generated $394 Million in 
										federal, state and local taxes.These wages translated into an estimated $33.7 million 
										in personal income tax revenue for Vermont’s state and local governments and over 
										$333.8 in federal tax revenue.  (<strong>Source:</strong> IMPLAN Analysis, based on 2012 payroll data 
										from the Vermont Department of Labor).
									</p>
								</div>
							</div> <!-- row -->	
							<br>
							<div class = "row">
								<h4 class = "page-head">Growth Industry</h4>			
								<br>
								<div>
									<p>
										The nonprofit sector is a growth industry. Between 2000 and 2010 nonprofit 
										employment increased by 1.9% while Vermont’s for-profit sector employment decreased 
										by 1.7%.
									</p>
									<p>
										<strong>Source:</strong> 
										<a href = "bls.gov/bdm/nonprofits/nonprofits.htm" target = "_blank">
										U.S. Department of Labor, Bureau of Labor Statisitics, 
										Research Data on the Nonprofit Sector
										</a>
									</p>
									<p>
										<br>
										<strong>See Interactive Chart:</strong> <a href = "https://infogr.am/vermont_job_growth_rate_2000_to_2010" target = "_blank">
										Vermont Job Growth Rate</a>									
									</p>
								</div>
							</div> <!-- row -->
							<br>
							<div class = "row">
								<h4 class = "page-head">Value of Volunteer Labor</h4>			
								<br>
								<div>
									<p>
										A recent report indicates that 33.7% of Vermont residents volunteered 19.2 
										million hours of service, adding up to $431.6 million in value.
										<br>
									</p>
									<p>
										<strong>Source:</strong> <a href = "http://www.volunteeringinamerica.gov/VT" target = "_blank">
										National Corporation on Community Service, 2014</a>							
									</p>
								</div>
							</div> <!-- row -->									
							<br>
							<div class = "row">
								<h4 class = "page-head">DIRECT & INDIRECT EFFECTS OF NONPROFIT ECONOMIC POWER</h4>			
								<br>
								<div>
									<p>
										Like all businesses, nonprofits purchase and produce goods and services and pay 
										taxable wages to employees. These transactions have an economic ripple effect as 
										monies spent by nonprofits and their employees are circulated throughout the 
										larger economy.							
									</p>
									<p>
										Using IMPLAN economic modelling software, the Vermont State Data Center used 
										Vermont nonprofit employment and wage data to create an input-output model. The 
										resulting model describes the economic activity associated with Vermont nonprofits
										and provides a baseline from which to estimate their potential economic impact.
									</p>
									<p>
										In addition to the 44,131 jobs directly produced by the nonprofit sector, the 
										economic model indicates that the nonprofit sector supports an additional 8,584 
										jobs through both induced and indirect effects. The total effect is that 57,715 
										jobs in Vermont result from nonprofit activity, adding up to $2.3 billion in labor 
										income, a multiplier effect of 1.2.
									</p>
									<p>
										The dollars spent on labor plus the sale of services generated by Vermont’s nonprofit 
										sector equals $1.6 billion. In turn, this generates more than $515 million in 
										additional purchase of goods and services (indirect effect) and $1 billion spent by 
										the beneficiaries of those businesses (employees, employers) in the economy at 
										large (induced effect). The total economic impact of Vermont’s nonprofit sector is 
										$3.2 billion. 
									</p>
									<p>
										That multiplier effect equals 1.9, Every dollar spent by nonprofits generates additional 90 
										cents in economic activity.
									</p>
									<div>
										<table class = "table" id = "implanTable">
											<thead>
												<tr>
													<th class = "text-right">Impact Type</th>
													<th class = "text-right">Employment</th>
													<th class = "text-right">Labor Income</th>
													<th class = "text-right">Value Added</th>
													<th class = "text-right">Output</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class = "text-right"><strong>Direct Effect</strong></td>
													<td class = "text-right">44,131.00</td>
													<td class = "text-right">$1,983,673,000</td>
													<td class = "text-right">$1,983,673,000</td>
													<td class = "text-right">$1,651,327,000</td>
												</tr>
												<tr>
													<td class = "text-right"><strong>Indirect Effect</strong></td>
													<td class = "text-right">2,242.70</td>
													<td class = "text-right">$99,539,872</td>
													<td class = "text-right">$261,276,603</td>
													<td class = "text-right">$515,296,455</td>												
												</tr>
												<tr>
													<td class = "text-right"><strong>Induced Effect</strong></td>
													<td class = "text-right">6,342.10</td>
													<td class = "text-right">$232,467,037</td>
													<td class = "text-right">$546,812,424</td>
													<td class = "text-right">$1,010,411,068</td>													
												</tr>
												<tr>
													<td class = "text-right"><strong>Total Effect</strong></td>
													<td class = "text-right">52,715.80</td>
													<td class = "text-right">$2,315,679,909</td>
													<td class = "text-right">$2,791,762,027</td>
													<td class = "text-right">$3,177,034,523</td>														
												</tr>
												<tr>
													<td class = "text-right"><strong>Type II Multiplier*</strong></td>
													<td class = "text-right">1.2</td>
													<td class = "text-right">1.2</td>
													<td class = "text-right">1.4</td>
													<td class = "text-right">1.9</td>			
												</tr>												
											</tbody>
										</table>
									</div>
								</div>
							</div> <!-- row -->		
							
						
						</div> <!-- container-fluid -->		

					<div role = "tabpanel" class = "tab-pane container-fluid" id = "sources">
						<div class = "row">
							<img src = "img/logo.jpg" class = "img-responsive col-md-4 pull-right"/>
						</div>					
						<div class = "row">
							<h4 class = "page-head">Data Sources</h4>			
							<div>
								<ul class = "list-group">
									<li class="list-group-item">
										<a href = "http://www.irs.gov/Charities-&-Non-Profits/Exempt-Organizations-Business-Master-File-Extract-EO-BMF" target = "_blank">
											IRS Master File for NonProfit Business (<span class = "asOf">June 2015</span>)</a>
									</li>
									<li class="list-group-item">
										<a href = "http://www.vtlmi.info/profile2014.pdf" target = "_blank">
											Vermont Department of Labor Demographic Profile Series 2012</a>
									</li>
									<li class="list-group-item">
										<a href = "http://www.leg.state.vt.us/jfo/publications/2014%20Fiscal%20Facts.pdf", target = "_blank">
										Vermont Joint Fiscal Office Fiscal Facts 2014
										</a>
									</li>
									<li class="list-group-item">
										<a href = "http://ccss.jhu.edu/wp-content/uploads/downloads/2012/01/NED_National_2012.pdf" target = "_blank">
											Johns Hopkins Economic Data Project: “Holding the Fort: Nonprofit Employment During a Decade of Turmoil 2000-2010″</a>
									</li>
									<li class="list-group-item">
										<a href = "http://www.bls.gov/bdm/nonprofits/nonprofits.htm" target = "_blank">
										US Department of Labor Bureau of Labor Statistics: “Research Data on the Nonprofit Sector”</a>
									</li>
									<li class="list-group-item">State Data Center/ University of Vermont IMPLAN Analysis (Upon Request)</li>
									<li class="list-group-item">
										<a href = "http://www.volunteeringinamerica.gov/VT" target = "_blank">
										 Corporation for National & Community Service: “Volunteering in America” (December 2014)</a>
									</li>
									<li class = "list-group-item">
										<a href = "http://www.bls.gov/bdm/nonprofits/nonprofits.htm" target = "_blank">
										US Bureau of Labor Statistics Research Data on the Nonprofit Sector (<span class = "BLS">2012</span>)</a>
									</li>
								</ul>
							</div>
							<div>
								<p>
									Please contact <i>Common Good Vermont</i> if you have questions, comments or 
									examples of how you are using this data. We are standing by to hear from 
									you at <a href = "mailto:Coordinator@CommonGoodVT.org">Coordinator@CommonGoodVT.org</a> or 802.862.1645 x19.
								</p>
							</div>
									
						</div> <!-- row -->
					</div> <!-- container-fluid -->							
						
					</div> <!-- container -->					
				</div> <!-- .mainCol -->
		</div> <!-- row -->
		
	</div> <!-- container -->		
		
		
    <!-- jQuery 1.x -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Bootstrap: Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<!-- d3.js -->
	<script src="js/d3.min.js"></script>

	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">		
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>	
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>		

	<!-- TableTools extension for DataTables -->
	<link rel="stylesheet" type="text/css" href="TableTools/dataTables.tableTools.css">		
	<script type="text/javascript" language="javascript" src="TableTools/dataTables.tableTools.js"></script>
	
	<!-- my scripts -->
	<script src="js/flowchart.js"></script>
	<script src="js/revchart.js"></script>	
	<script src="js/counties.js"></script>	
	<script src="js/sectors.js"></script>	
	<script src="js/overtime.js"></script>		
    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">	
	
	<script>
	
		$(document).ready(function() {

			$('#explore-table tfoot th').each( function () {
				var title = $('#explore thead th').eq( $(this).index() ).text();
				if (title != 'Revenue' ) {
					$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
				}
			} );		
			
			var table = $('#explore-table').DataTable( {
				"bProcessing":true,
				"bServerSide":true,
				"ajax": "data/dtProcessing.php",
				"dom": 'T<"clear">lfrtip',
				"oTableTools": {
					"aButtons": [ {
						"sExtends":    "download",
						"sButtonText": "Download Data",
						"oSelectorOpts": { filter: "applied", order: "current" },
						"sUrl":        "data/generate_csv.php"
					} ]
				}
			});
		
			
			table.columns().every( function () {
				var that = this;
			 
				$( 'input', this.footer() ).on( 'keyup change', function () {
					that
						.search( this.value )
						.draw();
				});
			});
			
		});
		
	TableTools.BUTTONS.download = {
		"sAction": "text",
		"sTag": "default",
		"sFieldBoundary": "",
		"sFieldSeperator": "\t",
		"sNewLine": "<br>",
		"sToolTip": "",
		"sButtonClass": "DTTT_button_text",
		"sButtonClassHover": "DTTT_button_text_hover",
		"sButtonText": "Download",
		"mColumns": "all",
		"bHeader": true,
		"bFooter": true,
		"sDiv": "",
		"fnMouseover": null,
		"fnMouseout": null,
		"fnClick": function( nButton, oConfig ) {
		  var oParams = this.s.dt.oApi._fnAjaxParameters( this.s.dt );
		var iframe = document.createElement('iframe');
		iframe.style.height = "0px";
		iframe.style.width = "0px";
		iframe.src = oConfig.sUrl+"?"+$.param(oParams);
		document.body.appendChild( iframe );
		},
		"fnSelect": null,
		"fnComplete": null,
		"fnInit": null
	};	
			
	$('.aToggle').on('click', function(e) {

        e.preventDefault();
		var tabname = $(this).attr('href');
        $('a[href="#' + tabname + '"]').tab('show');
		
    });
	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
      var divId = $(e.target).attr("href")
      $('html,body').animate({
        scrollTop: $(divId).offset().top - 60
      }, 500);
    });

	</script>

	
</body>

</html>
