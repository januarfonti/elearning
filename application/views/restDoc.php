<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>CodeIgniter 2 - XMLRPC Example</title>

<style type="text/css">

body {
 background-color: #fff;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #000;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 24px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

dt {
 	font-weight: bold;
}

dd {
	margin-bottom: 10px;
}

pre {
	font-style: italic;
	margin-left: 10px;
	color: black;
	background-color: #999;
	padding: 6px;
}
</style>
</head>
<body>

<h1>REST documentation</h1>

<p>REST server url: <a href="<?php echo site_url('rest_server'); ?>" target="_blank"><?php echo site_url('rest_server'); ?></a>
</p>

<hr/>
<H2>REST API</H2>

<?php print_r($methods_list); ?>

<hr/>
<h2>USAGE</h2>
<p>
The REST method helloWorld() returns an array like this one:
<pre>
Array
(
    [0] => hello
    [1] => world
    [2] => and
    [3] => everybody else
)
</pre>

With rest there are several way to get such result: for ex. the client has to send a GET request like this one:
<pre>
$words = $this->rest->get('helloWorld/format/json');
</pre>
Look at the rest_client.php controller for more examples.<br/><br/>

Click <a href=<?php echo site_url('/rest_client/helloWorld'); ?> target="_blank">here</a> to test the helloWorld_get method.<br/>

Click <a href=<?php echo site_url('/rest_client/getContacts'); ?> target="_blank">here</a> to test the contacts_get method.
</p>
<hr/>
</body>
</html>