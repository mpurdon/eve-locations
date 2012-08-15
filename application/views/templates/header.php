
<!doctype html>
<html itemscope itemtype="http://schema.org/Organization" lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Eve Locator Results Tracking</title>
	<style type="text/css">
	body {
		font-family: sans-serif;
	}
	a {
		text-decoration: none;
	}
	table {
		border-collapse:collapse;
		border:1px solid black;
	}
	th {
		font-size:1.1em;
		font-weight:bold;
		border:1px solid black;
		padding: 3px;
		background-color: #FA9E0E;
		color: #000;
	}
	th a {
		color: #000;
	}
	th a:visited {
		color: #000;
	}
	th.sort_asc:after {
		content: "↑";
	}
	th.sort_desc:after {
		content: "↓";
	}
	td {
		border:1px solid black;
		padding: 3px;
	}
	span.search_link {
		float:right;
		margin-left: 5px;
	}
	ul#navigation {
		list-style:none;
		padding:0px;
	}
	ul#navigation li {
		border: 2px solid black;
		background: #666;
		color: #fff;
		display: inline-block;
		padding: 3px;
		margin-left:0px;
	}
	ul#navigation li a {
		text-decoration: none;
		color: #fff;
	}
	ul#navigation li a:visited {
		text-decoration: none;
		color: #fff;
	}
	label {
		display:inline-block;
		width: 100px;
		text-align:right;
		vertical-align:top;
		margin-right: 5px;
		padding-top: 4px;
	}
	textarea {
		width: 50%;
	}
	</style>
</head>
<body>
<ul id="navigation">
	<li><?php echo anchor('/', 'Home'); ?></li>
	<li><?php echo anchor('/locations', 'Recent Locations'); ?></li>
	<li><?php echo anchor('/locations/search', 'Search Locations'); ?></li>
	<li><?php echo anchor('/locations/create', 'Add a Location'); ?></li>
</ul>
