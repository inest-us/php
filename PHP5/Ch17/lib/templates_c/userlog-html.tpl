{strip}
<tr class="UserLogTR">
{foreach from=$ul->getProperties() key=prop item=value}
   <td class="UserLog-{$prop}">{$value}</td>
{/foreach}

{foreach from=$ul->getDemographics() key=i item=demo}
   {$demo->toHTML(true)}
{/foreach}
</tr>
{/strip}
