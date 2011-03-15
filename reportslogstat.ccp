<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="9" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" activeCollection="TableParameters" name="GStatLogStatus" pageSizeLimit="100" wizardCaption="List of Smart Referencecode " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" wizardUsePageScroller="True" dataSource="smart_ticket" orderBy="tckt_refnumber desc">
			<Components>
				<Label id="16" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="reportslogstatGStatLogStatuslblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="refno" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportslogstatGStatLogStatusrefno" fieldSource="tckt_refnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="True" name="dateopen" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatusdateopen">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="42" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="True" name="dateassign" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatusdateassign">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="True" name="datereassign" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatusdatereassign">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="True" name="datewip" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatusdatewip">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="True" name="dateresolved" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatusdateresolved">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="True" name="dateclosed" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatusdateclosed">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblYear" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatuslblYear">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="54" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatusNavigator1" wizardPagingType="Custom" wizardPageNumbers="Simple" wizardTotalPages="True" wizardImages="Images" wizardHideDisabled="False" wizardFirst="True" wizardPrev="True" wizardNext="True" wizardLast="True" wizardPageSize="False" wizardFirstText="First" wizardPrevText="Prev" wizardNextText="Next" wizardLastText="Last" wizardOfText="of">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="55" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblMonth" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatuslblMonth">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="59" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_site" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatustckt_site" fieldSource="tckt_site">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="60" fieldSourceType="DBColumn" dataType="Text" html="True" name="tckt_r_helpdesk" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatustckt_r_helpdesk" fieldSource="tckt_r_helpdesk">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="61" fieldSourceType="DBColumn" dataType="Text" html="True" name="tckt_eng1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatustckt_eng1">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="62" fieldSourceType="DBColumn" dataType="Text" html="True" name="tckt_eng2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatustckt_eng2">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="63" fieldSourceType="DBColumn" dataType="Text" html="True" name="tckt_c_helpdesk" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatustckt_c_helpdesk" fieldSource="tckt_c_helpdesk">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Hidden id="64" fieldSourceType="DBColumn" dataType="Text" name="ticketid" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatGStatLogStatusticketid" fieldSource="id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="32" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="33" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="51" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
				<JoinTable id="49" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
				<Field id="50" tableName="smart_ticket" fieldName="tckt_refnumber"/>
				<Field id="53" tableName="smart_ticket" fieldName="tckt_r_date"/>
				<Field id="56" tableName="smart_ticket" fieldName="tckt_site"/>
<Field id="57" tableName="smart_ticket" fieldName="tckt_r_helpdesk"/>
<Field id="58" tableName="smart_ticket" fieldName="tckt_c_helpdesk"/>
<Field id="65" tableName="smart_ticket" fieldName="id"/>
</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<ImageLink id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslogstatImageLink1" hrefSource="printreportslogstat.ccp">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="45" sourceType="URL" format="yyyy-mm-dd" name="year" source="year"/>
				<LinkParameter id="46" sourceType="URL" format="yyyy-mm-dd" name="set" source="set"/>
				<LinkParameter id="47" sourceType="Expression" format="yyyy-mm-dd" name="print" source="1"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</ImageLink>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="reportslogstat_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="reportslogstat.php" forShow="True" url="reportslogstat.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
