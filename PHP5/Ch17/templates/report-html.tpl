<html><title>MultiLog Report</title>
<body>

<h3>{$title}</h3>

<table width="2048"><tr><td>
{$logs->toHTML()}
</td></tr></table>

<h3>Log Count: {$logs->getCount()}</h3>

</body>
</html>

