
Implementation Notes
--------------------

The file userlog-html.tpl (Smarty template) is used by classes in the lib directory, but smarty [may] also expect to find it in the base templates_c directory.  If you get errors when running report.php, then make a symlink (or copy the file) from ./templates/userlog-html.tpl to ./lib/templates/userlog-html.tpl

