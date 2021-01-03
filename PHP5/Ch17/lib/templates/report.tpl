<html><title>MultiLog Report</title>
<body>

<h3>{$title}</h3>

<form action="report.php" method="post">
<table>
<tr><td align="right">Start Date:</td><td>{html_select_date prefix="start_" start_year="-2"}</td></tr>
<tr><td align="right">End Date:</td>  <td>{html_select_date prefix="stop_"  start_year="-2"}</td></tr>
<tr><td align="right">Site:</td>      <td><select name=site> {html_options options=$sites} </select> </td></tr>
<tr><td align="right">Section:</td>   <td><select name=section> {html_options options=$sections} </select> </td></tr>
<tr><td align="right"></td>           <td><input type="submit" value=" Show Report "></td></tr>
</table>
<input type="hidden" name="action" value="html">
</form>

</body>
</html>