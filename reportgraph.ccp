<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0" connection="SMART" accessDeniedPage="index.ccp">
	<Components>
		<IncludePage id="2" name="header" PathID="header" page="smartheader.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="4" name="footer" PathID="footer" page="footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<FlashChart id="5" secured="False" dataSeriesIn="Columns" chartType="3d_columns" sourceType="Table" defaultPageSize="50" returnValueType="Number" name="FlashChart1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="FlashChart1" connection="SMART" dataSource="smart_ticket" groupBy="MONTH(tckt_r_date)" schemaName="Metall" layout="7" gridCaptionField="month" width="800" height="600" displayTitle="True" title="Graph of Tickets By Year" displayLegend="True" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
	&lt;schema name=&quot;Metall&quot;&gt;
		&lt;mask/&gt;
		&lt;colors/&gt;
	&lt;/schema&gt;
	&lt;separator decimal=&quot;,&quot; group=&quot;&quot;/&gt;
	&lt;background border=&quot;yes&quot;/&gt;
	&lt;chartarea border=&quot;yes&quot;&gt;
		&lt;grid line_style=&quot;medium&quot; visible=&quot;yes&quot;/&gt;
		&lt;vertical_axis visible=&quot;yes&quot;/&gt;
		&lt;horizontal_axis visible=&quot;yes&quot; rotation=&quot;degrees&quot; autoRotate=&quot;yes&quot;/&gt;
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; type=&quot;3d_columns&quot; series=&quot;columns&quot;&gt;
			&lt;inscriptions visible=&quot;yes&quot;/&gt;
			&lt;animation type=&quot;none&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot;/&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; position=&quot;bottom-right&quot; layout=&quot;horizontal&quot; visible=&quot;yes&quot;/&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Graph of Tickets By Year&quot;/&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;ticketnumber&quot; name=&quot;Number of Tickets&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;
			&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{ticketnumber}&quot; name=&quot;{month}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;
	&lt;/data&gt;
&lt;/root&gt;
" isCaption="true">
<Components/>
<Events/>
<Attributes/>
<DataSeries>
<Field id="49" fieldName="ticketnumber" alias="Number of Tickets"/>
</DataSeries>
<TableParameters/>
<JoinTables>
<JoinTable id="6" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
</JoinTables>
<JoinLinks/>
<Fields>
<Field id="7" fieldName="count(tckt_refnumber)" isExpression="True" alias="ticketnumber"/>
<Field id="8" fieldName="MONTH(tckt_r_date)" isExpression="True" alias="month"/>
</Fields>
<AllFields>
<Field id="45" fieldName="ticketnumber"/>
<Field id="47" fieldName="month"/>
</AllFields>
<SelectedFields>
<Field id="46" fieldName="ticketnumber" isExpression="True"/>
<Field id="48" fieldName="month" isExpression="True"/>
</SelectedFields>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Features/>
</FlashChart>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="reportgraph.php" forShow="True" url="reportgraph.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="FlashChartXML5" language="PHPTemplates" name="reportgraphFlashChart1.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
<CodeFile id="Events" language="PHPTemplates" name="reportgraph_events.php" forShow="False" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups>
<Group id="41" groupID="1"/>
<Group id="42" groupID="2"/>
<Group id="43" groupID="3"/>
</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="44"/>
</Actions>
</Event>
</Events>
</Page>
