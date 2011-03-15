<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0" connection="SMART">
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
		<FlashChart id="5" secured="False" dataSeriesIn="Rows" chartType="round_columns" sourceType="Table" defaultPageSize="25" returnValueType="Number" name="FlashChartStatus" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="FlashChartStatus" connection="SMART" dataSource="smart_ticket, smart_referencecode" activeCollection="TableParameters" groupBy="smart_ticket.tckt_status" schemaName="Metall" layout="7" gridCaptionField="tckt_status" isCaption="true" width="600" height="500" displayTitle="True" title="Tickets Reports By Status" displayLegend="True" displayLabels="True" displayGridLines="True" directionType="degrees" autoRotate="yes" template="&lt;root&gt;
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
		&lt;chart line_thick=&quot;2&quot; enabled=&quot;yes&quot; type=&quot;round_columns&quot; series=&quot;rows&quot;&gt;
			&lt;inscriptions visible=&quot;yes&quot;/&gt;
			&lt;animation type=&quot;none&quot;/&gt;
			&lt;markers size=&quot;8&quot; type=&quot;0&quot;/&gt;
			&lt;hints border=&quot;yes&quot; enabled=&quot;yes&quot;/&gt;
		&lt;/chart&gt;
		&lt;legend sqr_size=&quot;12&quot; sqr_borders=&quot;yes&quot; border_thick=&quot;0&quot; position=&quot;bottom-right&quot; layout=&quot;horizontal&quot; visible=&quot;yes&quot;/&gt;
		&lt;title position=&quot;top&quot; align=&quot;center&quot; border=&quot;no&quot; alpha=&quot;100&quot; visible=&quot;yes&quot; text=&quot;Tickets Reports By Status&quot;/&gt;
	&lt;/chartarea&gt;
	&lt;objects&gt;
	&lt;/objects&gt;
	&lt;data&gt;
		&lt;columns&gt;
			&lt;column field=&quot;numTicket&quot; name=&quot;numTicket&quot;/&gt;&lt;/columns&gt;
		&lt;rows&gt;
			&lt;!-- BEGIN Row --&gt;&lt;row col1=&quot;{numTicket}&quot; name=&quot;{tckt_status}&quot;/&gt;&lt;!-- END Row --&gt;&lt;/rows&gt;
	&lt;/data&gt;
&lt;/root&gt;
">
			<Components/>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="14"/>
					</Actions>
				</Event>
			</Events>
			<Attributes/>
			<DataSeries>
				<Field id="13" fieldName="numTicket" alias="numTicket"/>
			</DataSeries>
			<TableParameters>
				<TableParameter id="19" conditionType="Parameter" useIsNull="False" field="smart_referencecode.ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="tcktstatus"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="6" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
				<JoinTable id="15" tableName="smart_referencecode" posLeft="191" posTop="10" posWidth="117" posHeight="152"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="20" tableLeft="smart_ticket" tableRight="smart_referencecode" fieldLeft="smart_ticket.tckt_status" fieldRight="smart_referencecode.ref_value" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="7" fieldName="Count(tckt_refnumber)" isExpression="True" alias="numTicket"/>
				<Field id="8" tableName="smart_ticket" fieldName="tckt_status" isExpression="False"/>
				<Field id="21" tableName="smart_referencecode" fieldName="ref_description" alias="status"/>
			</Fields>
			<AllFields>
				<Field id="9" fieldName="numTicket"/>
				<Field id="11" fieldName="tckt_status"/>
			</AllFields>
			<SelectedFields>
				<Field id="10" fieldName="numTicket" isExpression="True"/>
				<Field id="12" tableName="smart_ticket" fieldName="tckt_status" isExpression="False"/>
			</SelectedFields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Features/>
		</FlashChart>
		<Record id="22" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="FCharts" wizardCaption="Search Smart Ticket " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="smartcharts.ccp" PathID="FCharts" pasteActions="pasteActions">
			<Components>
				<ListBox id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ftype" wizardCaption="Tckt Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="FChartsftype" sourceType="ListOfValues" connection="SMART" _valueOfList="probcat" _nameOfList="By Ticket Category" dataSource="tcktstatus;By Ticket Status;state;By State;tcktseverity;By Ticket Severity;probcat;By Ticket Category">
					<Components/>
					<Events>
<Event name="OnChange" type="Client">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="29"/>
</Actions>
</Event>
</Events>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="state" wizardCaption="Tckt State" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="FChartsstate" sourceType="Table" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="26" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="state"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="27" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<Button id="23" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="FChartsButton_DoSearch">
					<Components/>
					<Events>
<Event name="OnClick" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="31"/>
</Actions>
</Event>
</Events>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="smartcharts.php" forShow="True" url="smartcharts.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="FlashChartXML5" language="PHPTemplates" name="smartchartsFlashChartStatus.xml" forShow="False" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="smartcharts_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="28"/>
			</Actions>
		</Event>
		<Event name="OnLoad" type="Client">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="30"/>
</Actions>
</Event>
</Events>
</Page>
