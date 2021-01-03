<?php /* Smarty version 2.6.2, created on 2004-04-23 23:26:21
         compiled from report.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_select_date', 'report.tpl', 8, false),array('function', 'html_options', 'report.tpl', 10, false),)), $this); ?>
<html><title>MultiLog Report</title>
<body>

<h3><?php echo $this->_tpl_vars['title']; ?>
</h3>

<form action="report.php" method="post">
<table>
<tr><td align="right">Start Date:</td><td><?php echo smarty_function_html_select_date(array('prefix' => 'start_','start_year' => "-2"), $this);?>
</td></tr>
<tr><td align="right">End Date:</td>  <td><?php echo smarty_function_html_select_date(array('prefix' => 'stop_','start_year' => "-2"), $this);?>
</td></tr>
<tr><td align="right">Site:</td>      <td><select name=site> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sites']), $this);?>
 </select> </td></tr>
<tr><td align="right">Section:</td>   <td><select name=section> <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sections']), $this);?>
 </select> </td></tr>
<tr><td align="right"></td>           <td><input type="submit" value=" Show Report "></td></tr>
</table>
<input type="hidden" name="action" value="html">
</form>

</body>
</html>