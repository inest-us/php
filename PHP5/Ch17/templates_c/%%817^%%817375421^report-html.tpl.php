<?php /* Smarty version 2.6.2, created on 2004-04-23 23:26:25
         compiled from report-html.tpl */ ?>
<html><title>MultiLog Report</title>
<body>

<h3><?php echo $this->_tpl_vars['title']; ?>
</h3>

<table width="2048"><tr><td>
<?php echo $this->_tpl_vars['logs']->toHTML(); ?>

</td></tr></table>

<h3>Log Count: <?php echo $this->_tpl_vars['logs']->getCount(); ?>
</h3>

</body>
</html>
