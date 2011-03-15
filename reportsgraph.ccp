<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Panel id="2" visible="True" name="pangraphbranch" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsgraphpangraphbranch" connection="SMART">
			<Components>
				<FlashChart id="3" secured="False" dataSeriesIn="Columns" chartType="3d_columns" sourceType="SQL" defaultPageSize="100" returnValueType="Number" name="ChartBranch" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsgraphpangraphbranchChartBranch" connection="SMART" dataSource="SELECT count(tckt_refnumber) AS ticketsum, tckt_site AS branch 
FROM smart_ticket
WHERE YEAR(tckt_r_date) = '{year}'
GROUP BY tckt_site " groupBy="tckt_site" activeCollection="SQLParameters" schemaName="{user}_smart-chart" layout="9" gridCaptionField="branch" isCaption="true" width="950" displayTitle="True" title="Graph of Tickets According To Branch By Year {year}" displayLegend="True" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
	&lt;schema name=&quot;Metall&quot;&gt;
		&lt;mask name=&quot;4&quot;/&gt;
		&lt;colors&gt;&lt;color value=&quot;A6651D&quot;/&gt;&lt;color value=&quot;88524E&quot;/&gt;&lt;color value=&quot;7E4860&quot;/&gt;&lt;color value=&quot;543D63&quot;/&gt;&lt;color value=&quot;3E3C6A&quot;/&gt;&lt;color value=&quot;365263&quot;/&gt;&lt;color value=&quot;496857&quot;/&gt;&lt;color value=&quot;71724E&quot;/&gt;&lt;color value=&quot;8E743A&quot;/&gt;&lt;color value=&quot;6F5D45&quot;/&gt;&lt;color value=&quot;735245&quot;/&gt;&lt;color value=&quot;525344&quot;/&gt;&lt;color value=&quot;516268&quot;/&gt;&lt;color value=&quot;6B7A66&quot;/&gt;&lt;color value=&quot;586177&quot;/&gt;&lt;color value=&quot;817E84&quot;/&gt;&lt;color value=&quot;976263&quot;/&gt;&lt;color value=&quot;8B876F&quot;/&gt;&lt;color value=&quot;888F5B&quot;/&gt;&lt;color value=&quot;7A8D66&quot;/&gt;&lt;color value=&quot;6F8A74&quot;/&gt;&lt;color value=&quot;748988&quot;/&gt;&lt;color value=&quot;5A7A95&quot;/&gt;&lt;color value=&quot;596A8E&quot;/&gt;&lt;color value=&quot;585386&quot;/&gt;&lt;color value=&quot;7D5D84&quot;/&gt;&lt;color value=&quot;8C6358&quot;/&gt;&lt;color value=&quot;7F6E59&quot;/&gt;&lt;color value=&quot;8E9194&quot;/&gt;&lt;color value=&quot;7C6A43&quot;/&gt;&lt;color value=&quot;B07D19&quot;/&gt;&lt;color value=&quot;A34B2A&quot;/&gt;&lt;color value=&quot;A15342&quot;/&gt;&lt;color value=&quot;8F4854&quot;/&gt;&lt;color value=&quot;7F3553&quot;/&gt;&lt;color value=&quot;564164&quot;/&gt;&lt;color value=&quot;345E66&quot;/&gt;&lt;color value=&quot;496857&quot;/&gt;&lt;color value=&quot;5F733E&quot;/&gt;&lt;color value=&quot;A68927&quot;/&gt;&lt;/colors&gt;
	&lt;/schema&gt;
	&lt;separator decimal=&quot;,&quot; group=&quot;&quot;/&gt;
	&lt;background border=&quot;yes&quot; beginColor=&quot;FFFFFF&quot; endColor=&quot;FFFFFF&quot; color=&quot;FFFFFF&quot; gradient=&quot;no&quot;/&gt;
	&lt;chartarea border=&quot;yes&quot; gradient=&quot;yes&quot; bgcolor=&quot;f6f6f4&quot; beginColor=&quot;f6f6f4&quot; endColor=&quot;C6D5E3&quot; alpha=&quot;100&quot;&gt;
		&lt;grid line_style=&quot;medium&quot; alpha=&quot;100&quot; color=&quot;c1bcb2&quot; visible=&quot;yes&quot;/&gt;
		&lt;vertical_axis visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;10&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot; color=&quot;73706a&quot;/&gt;&lt;/vertical_axis&gt;
		&lt;horizontal_axis visible=&quot;yes&quot; rotation=&quot;degrees&quot; autoRotate=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;9&quot; bold=&quot;yes&quot; italic=&quot;no&quot; uline=&quot;no&quot; color=&quot;73706a&quot;/&gt;&lt;/horizontal_axis&gt;
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; border=&quot;yes&quot; isBorderBright=&quot;no&quot; alpha=&quot;100&quot; type=&quot;3d_columns&quot; series=&quot;columns&quot;&gt;
			&lt;inscriptions color=&quot;000000&quot; visible=&quot;yes&quot;&gt;&lt;font face=&quot;ArialNarrow&quot; size=&quot;8&quot; bold=&quot;yes&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/inscriptions&gt;
			&lt;animation type=&quot;conc_resize&quot; time=&quot;3000&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot; color=&quot;FFFF99&quot;&gt;&lt;font color=&quot;FF0000&quot; face=&quot;Verdana&quot; size=&quot;9&quot; bold=&quot;no&quot; italic=&quot;yes&quot; uline=&quot;no&quot;/&gt;&lt;/hints&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; alpha=&quot;100&quot; position=&quot;bottom-left&quot; layout=&quot;horizontal&quot; visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;10&quot; bold=&quot;yes&quot; italic=&quot;no&quot; uline=&quot;no&quot; color=&quot;73706a&quot;/&gt;&lt;/legend&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Graph of Tickets According To Branch By Year {year}&quot;&gt;&lt;font color=&quot;808080&quot; face=&quot;Verdana&quot; size=&quot;12&quot; bold=&quot;yes&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/title&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;ticketsum&quot; name=&quot;ticketsum&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{ticketsum}&quot; name=&quot;{branch}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;&lt;/data&gt;
&lt;/root&gt;
" parameterTypeListName="ParameterTypeList" height="550">
					<Components/>
					<Events/>
					<Attributes/>
					<DataSeries>
						<Field id="39" fieldName="ticketsum" alias="Number of Tickets"/>
</DataSeries>
					<TableParameters>
						<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="tckt_r_date" dataType="Date" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="year"/>
					</TableParameters>
					<JoinTables/>
					<JoinLinks/>
					<Fields>
						<Field id="5" fieldName="count(tckt_refnumber)" isExpression="True" alias="ticketsum"/>
					</Fields>
					<AllFields>
						<Field id="35" fieldName="ticketsum"/>
<Field id="37" fieldName="tckt_site" alias="branch"/>
</AllFields>
					<SelectedFields>
						<Field id="36" fieldName="ticketsum" isExpression="True"/>
<Field id="38" fieldName="tckt_site" alias="branch" isExpression="True"/>
</SelectedFields>
					<SPParameters/>
					<SQLParameters>
						<SQLParameter id="14" parameterType="URL" variable="year" dataType="Text" parameterSource="year" designDefaultValue="2010" defaultValue="2010"/>
					</SQLParameters>
					<SecurityGroups/>
					<Features/>
				</FlashChart>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="40" visible="True" name="pangraphprob" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsgraphpangraphprob" connection="SMART">
<Components>
<FlashChart id="41" secured="False" dataSeriesIn="Columns" chartType="3d_columns" sourceType="SQL" defaultPageSize="90" returnValueType="Number" name="ChartProb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsgraphpangraphprobChartProb" connection="SMART" activeCollection="TableParameters" groupBy="tckt_category" parameterTypeListName="ParameterTypeList" schemaName="{user}_smart-chart" layout="9" gridCaptionField="probcat" isCaption="true" width="900" height="600" displayTitle="True" title="Graph of Tickets According To Problem Categories By Year" displayLegend="True" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
	&lt;schema name=&quot;Metall&quot;&gt;
		&lt;mask name=&quot;4&quot;/&gt;
		&lt;colors&gt;&lt;color value=&quot;A6651D&quot;/&gt;&lt;color value=&quot;88524E&quot;/&gt;&lt;color value=&quot;7E4860&quot;/&gt;&lt;color value=&quot;543D63&quot;/&gt;&lt;color value=&quot;3E3C6A&quot;/&gt;&lt;color value=&quot;365263&quot;/&gt;&lt;color value=&quot;496857&quot;/&gt;&lt;color value=&quot;71724E&quot;/&gt;&lt;color value=&quot;8E743A&quot;/&gt;&lt;color value=&quot;6F5D45&quot;/&gt;&lt;color value=&quot;735245&quot;/&gt;&lt;color value=&quot;525344&quot;/&gt;&lt;color value=&quot;516268&quot;/&gt;&lt;color value=&quot;6B7A66&quot;/&gt;&lt;color value=&quot;586177&quot;/&gt;&lt;color value=&quot;817E84&quot;/&gt;&lt;color value=&quot;976263&quot;/&gt;&lt;color value=&quot;8B876F&quot;/&gt;&lt;color value=&quot;888F5B&quot;/&gt;&lt;color value=&quot;7A8D66&quot;/&gt;&lt;color value=&quot;6F8A74&quot;/&gt;&lt;color value=&quot;748988&quot;/&gt;&lt;color value=&quot;5A7A95&quot;/&gt;&lt;color value=&quot;596A8E&quot;/&gt;&lt;color value=&quot;585386&quot;/&gt;&lt;color value=&quot;7D5D84&quot;/&gt;&lt;color value=&quot;8C6358&quot;/&gt;&lt;color value=&quot;7F6E59&quot;/&gt;&lt;color value=&quot;8E9194&quot;/&gt;&lt;color value=&quot;7C6A43&quot;/&gt;&lt;color value=&quot;B07D19&quot;/&gt;&lt;color value=&quot;A34B2A&quot;/&gt;&lt;color value=&quot;A15342&quot;/&gt;&lt;color value=&quot;8F4854&quot;/&gt;&lt;color value=&quot;7F3553&quot;/&gt;&lt;color value=&quot;564164&quot;/&gt;&lt;color value=&quot;345E66&quot;/&gt;&lt;color value=&quot;496857&quot;/&gt;&lt;color value=&quot;5F733E&quot;/&gt;&lt;color value=&quot;A68927&quot;/&gt;&lt;/colors&gt;
	&lt;/schema&gt;
	&lt;separator decimal=&quot;,&quot; group=&quot;&quot;/&gt;
	&lt;background border=&quot;yes&quot; beginColor=&quot;FFFFFF&quot; endColor=&quot;FFFFFF&quot; color=&quot;FFFFFF&quot; gradient=&quot;no&quot;/&gt;
	&lt;chartarea border=&quot;yes&quot; alpha=&quot;100&quot; beginColor=&quot;f6f6f4&quot; endColor=&quot;C6D5E3&quot; bgcolor=&quot;f6f6f4&quot; gradient=&quot;yes&quot;&gt;
		&lt;grid line_style=&quot;medium&quot; alpha=&quot;100&quot; color=&quot;c1bcb2&quot; visible=&quot;yes&quot;/&gt;
		&lt;vertical_axis visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;10&quot; color=&quot;73706a&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/vertical_axis&gt;
		&lt;horizontal_axis visible=&quot;yes&quot; rotation=&quot;degrees&quot; autoRotate=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;9&quot; bold=&quot;yes&quot; color=&quot;73706a&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/horizontal_axis&gt;
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; border=&quot;yes&quot; alpha=&quot;100&quot; isBorderBright=&quot;no&quot; type=&quot;3d_columns&quot; series=&quot;columns&quot;&gt;
			&lt;inscriptions color=&quot;000000&quot; visible=&quot;yes&quot;&gt;&lt;font face=&quot;ArialNarrow&quot; size=&quot;9&quot; bold=&quot;yes&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/inscriptions&gt;
			&lt;animation type=&quot;conc_resize&quot; time=&quot;3000&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot; color=&quot;FFFF99&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;9&quot; italic=&quot;yes&quot; color=&quot;FF0000&quot; bold=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/hints&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; alpha=&quot;100&quot; position=&quot;bottom-left&quot; layout=&quot;horizontal&quot; visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;10&quot; bold=&quot;yes&quot; color=&quot;73706a&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/legend&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Graph of Tickets According To Problem Categories By Year&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;12&quot; bold=&quot;yes&quot; color=&quot;808080&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/title&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;ticketnum&quot; name=&quot;ticketnum&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;
			&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{ticketnum}&quot; name=&quot;{probcat}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;
	&lt;/data&gt;
&lt;/root&gt;
" dataSource="SELECT COUNT(tckt_refnumber) AS ticketnum, ref_description AS probcat 
FROM smart_ticket LEFT JOIN smart_referencecode ON
smart_ticket.tckt_category = smart_referencecode.ref_value
WHERE smart_referencecode.ref_type = 'probcat'
AND YEAR(smart_ticket.tckt_r_date) = '{year}'
GROUP BY tckt_category "><Components/>
<Events/>
<Attributes/>
<DataSeries>
<Field id="57" fieldName="ticketnum" alias="ticketnum"/>
</DataSeries>
<TableParameters>
<TableParameter id="45" conditionType="Parameter" useIsNull="False" field="smart_referencecode.ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="probcat"/>
<TableParameter id="51" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_r_date" dataType="Date" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="year"/>
</TableParameters>
<JoinTables/>
<JoinLinks/>
<Fields>
<Field id="47" fieldName="COUNT(tckt_refnumber)" isExpression="True" alias="ticketnum"/>
</Fields>
<AllFields>
<Field id="53" fieldName="ticketnum"/>
<Field id="55" fieldName="probcat"/>
</AllFields>
<SelectedFields>
<Field id="54" fieldName="ticketnum" isExpression="True"/>
<Field id="56" fieldName="probcat" isExpression="True"/>
</SelectedFields>
<SPParameters/>
<SQLParameters>
<SQLParameter id="52" parameterType="URL" variable="year" dataType="Text" parameterSource="year" designDefaultValue="2010"/>
</SQLParameters>
<SecurityGroups/>
<Features/>
</FlashChart>
</Components>
<Events/>
<Attributes/>
<Features/>
</Panel>
<Panel id="59" visible="True" name="pangraphmethod" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsgraphpangraphmethod" connection="SMART">
<Components>
<FlashChart id="60" secured="False" dataSeriesIn="Columns" chartType="3d_columns" sourceType="SQL" defaultPageSize="90" returnValueType="Number" name="ChartMethod" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportsgraphpangraphmethodChartMethod" connection="SMART" activeCollection="SQLParameters" groupBy="tckt_c_method" parameterTypeListName="ParameterTypeList" schemaName="{user}_smart-chart" layout="9" gridCaptionField="method" isCaption="true" width="900" height="600" displayTitle="True" title="Graph of Tickets According to Resolution Method By Year" displayLegend="True" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
	&lt;schema name=&quot;Metall&quot;&gt;
		&lt;mask name=&quot;4&quot;/&gt;
		&lt;colors&gt;&lt;color value=&quot;A6651D&quot;/&gt;&lt;color value=&quot;88524E&quot;/&gt;&lt;color value=&quot;7E4860&quot;/&gt;&lt;color value=&quot;543D63&quot;/&gt;&lt;color value=&quot;3E3C6A&quot;/&gt;&lt;color value=&quot;365263&quot;/&gt;&lt;color value=&quot;496857&quot;/&gt;&lt;color value=&quot;71724E&quot;/&gt;&lt;color value=&quot;8E743A&quot;/&gt;&lt;color value=&quot;6F5D45&quot;/&gt;&lt;color value=&quot;735245&quot;/&gt;&lt;color value=&quot;525344&quot;/&gt;&lt;color value=&quot;516268&quot;/&gt;&lt;color value=&quot;6B7A66&quot;/&gt;&lt;color value=&quot;586177&quot;/&gt;&lt;color value=&quot;817E84&quot;/&gt;&lt;color value=&quot;976263&quot;/&gt;&lt;color value=&quot;8B876F&quot;/&gt;&lt;color value=&quot;888F5B&quot;/&gt;&lt;color value=&quot;7A8D66&quot;/&gt;&lt;color value=&quot;6F8A74&quot;/&gt;&lt;color value=&quot;748988&quot;/&gt;&lt;color value=&quot;5A7A95&quot;/&gt;&lt;color value=&quot;596A8E&quot;/&gt;&lt;color value=&quot;585386&quot;/&gt;&lt;color value=&quot;7D5D84&quot;/&gt;&lt;color value=&quot;8C6358&quot;/&gt;&lt;color value=&quot;7F6E59&quot;/&gt;&lt;color value=&quot;8E9194&quot;/&gt;&lt;color value=&quot;7C6A43&quot;/&gt;&lt;color value=&quot;B07D19&quot;/&gt;&lt;color value=&quot;A34B2A&quot;/&gt;&lt;color value=&quot;A15342&quot;/&gt;&lt;color value=&quot;8F4854&quot;/&gt;&lt;color value=&quot;7F3553&quot;/&gt;&lt;color value=&quot;564164&quot;/&gt;&lt;color value=&quot;345E66&quot;/&gt;&lt;color value=&quot;496857&quot;/&gt;&lt;color value=&quot;5F733E&quot;/&gt;&lt;color value=&quot;A68927&quot;/&gt;&lt;/colors&gt;
	&lt;/schema&gt;
	&lt;separator decimal=&quot;,&quot; group=&quot;&quot;/&gt;
	&lt;background border=&quot;yes&quot; beginColor=&quot;FFFFFF&quot; endColor=&quot;FFFFFF&quot; color=&quot;FFFFFF&quot; gradient=&quot;no&quot;/&gt;
	&lt;chartarea border=&quot;yes&quot; alpha=&quot;100&quot; beginColor=&quot;f6f6f4&quot; endColor=&quot;C6D5E3&quot; bgcolor=&quot;f6f6f4&quot; gradient=&quot;yes&quot;&gt;
		&lt;grid line_style=&quot;medium&quot; alpha=&quot;100&quot; color=&quot;c1bcb2&quot; visible=&quot;yes&quot;/&gt;
		&lt;vertical_axis visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;10&quot; color=&quot;73706a&quot; bold=&quot;no&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/vertical_axis&gt;
		&lt;horizontal_axis visible=&quot;yes&quot; rotation=&quot;degrees&quot; autoRotate=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;9&quot; bold=&quot;yes&quot; color=&quot;73706a&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/horizontal_axis&gt;
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; border=&quot;yes&quot; alpha=&quot;100&quot; isBorderBright=&quot;no&quot; type=&quot;3d_columns&quot; series=&quot;columns&quot;&gt;
			&lt;inscriptions color=&quot;000000&quot; visible=&quot;yes&quot;&gt;&lt;font face=&quot;ArialNarrow&quot; size=&quot;9&quot; bold=&quot;yes&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/inscriptions&gt;
			&lt;animation type=&quot;conc_resize&quot; time=&quot;3000&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot; color=&quot;FFFF99&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;9&quot; italic=&quot;yes&quot; color=&quot;FF0000&quot; bold=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/hints&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; alpha=&quot;100&quot; position=&quot;bottom-left&quot; layout=&quot;horizontal&quot; visible=&quot;yes&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;10&quot; bold=&quot;yes&quot; color=&quot;73706a&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/legend&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Graph of Tickets According to Resolution Method By Year&quot;&gt;&lt;font face=&quot;Verdana&quot; size=&quot;12&quot; bold=&quot;yes&quot; color=&quot;808080&quot; italic=&quot;no&quot; uline=&quot;no&quot;/&gt;&lt;/title&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;ticketnum&quot; name=&quot;Number of Tickets&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{ticketnum}&quot; name=&quot;{method}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;&lt;/data&gt;
&lt;/root&gt;
" dataSource="SELECT COUNT(tckt_refnumber) AS ticketnum, ref_description AS method 
FROM smart_ticket LEFT JOIN smart_referencecode ON
smart_ticket.tckt_c_method = smart_referencecode.ref_value
WHERE smart_referencecode.ref_type = 'rsltnmethod'
AND YEAR(smart_ticket.tckt_r_date) = '{year}'
GROUP BY tckt_c_method ORDER BY smart_referencecode.ref_rank ASC"><Components/>
<Events/>
<Attributes/>
<DataSeries>
<Field id="84" fieldName="ticketnum" alias="Number of Tickets"/>
</DataSeries>
<TableParameters>
<TableParameter id="67" conditionType="Parameter" useIsNull="False" field="smart_referencecode.ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="rsltnmethod"/>
<TableParameter id="68" conditionType="Parameter" useIsNull="False" field="smart_ticket.tckt_r_date" dataType="Date" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="year"/>
</TableParameters>
<JoinTables/>
<JoinLinks/>
<Fields>
<Field id="64" fieldName="COUNT(tckt_refnumber)" isExpression="True" alias="ticketnum"/>
</Fields>
<AllFields>
<Field id="80" fieldName="ticketnum"/>
<Field id="82" fieldName="method"/>
</AllFields>
<SelectedFields>
<Field id="81" fieldName="ticketnum" isExpression="True"/>
<Field id="83" fieldName="method" isExpression="True"/>
</SelectedFields>
<SPParameters/>
<SQLParameters>
<SQLParameter id="70" parameterType="URL" variable="year" dataType="Text" parameterSource="year" designDefaultValue="2010"/>
</SQLParameters>
<SecurityGroups/>
<Features/>
</FlashChart>
</Components>
<Events/>
<Attributes/>
<Features/>
</Panel>
</Components>
	<CodeFiles>
		<CodeFile id="FlashChartXML3" language="PHPTemplates" name="reportsgraphpangraphbranchChartBranch.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="reportsgraph_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="reportsgraph.php" forShow="True" url="reportsgraph.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="FlashChartXML41" language="PHPTemplates" name="reportsgraphpangraphprobChartProb.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
<CodeFile id="FlashChartXML60" language="PHPTemplates" name="reportsgraphpangraphmethodChartMethod.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
<Event name="AfterInitialize" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="58"/>
</Actions>
</Event>
</Events>
</Page>
