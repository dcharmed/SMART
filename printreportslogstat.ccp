<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10000" connection="SMART" activeCollection="TableParameters" name="GStatLogStatus" pageSizeLimit="10000" wizardCaption="List of Smart Referencecode " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" wizardUsePageScroller="True" dataSource="smart_ticket" orderBy="tckt_refnumber desc">
			<Components>
				<Label id="3" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GStatLogStatuslblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="False" name="refno" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GStatLogStatusrefno" fieldSource="tckt_refnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="5" fieldSourceType="DBColumn" dataType="Text" html="True" name="dateopen" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatusdateopen">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="6" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="7" fieldSourceType="DBColumn" dataType="Text" html="True" name="dateassign" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatusdateassign">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="8" fieldSourceType="DBColumn" dataType="Text" html="True" name="datereassign" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatusdatereassign">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="9" fieldSourceType="DBColumn" dataType="Text" html="True" name="datewip" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatusdatewip">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="True" name="dateresolved" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatusdateresolved">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="True" name="dateclosed" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatusdateclosed">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="True" name="lblYear" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatuslblYear">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_site" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatustckt_site" fieldSource="tckt_site">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="True" name="tckt_r_helpdesk" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatustckt_r_helpdesk" fieldSource="tckt_r_helpdesk">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="True" name="tckt_eng1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatustckt_eng1">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="True" name="tckt_eng2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatustckt_eng2">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="True" name="tckt_c_helpdesk" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatustckt_c_helpdesk" fieldSource="tckt_c_helpdesk">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Hidden id="27" fieldSourceType="DBColumn" dataType="Text" name="ticketid" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatLogStatusticketid" fieldSource="id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Hidden>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="14"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="15"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="16"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
				<JoinTable id="17" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
				<Field id="18" tableName="smart_ticket" fieldName="tckt_refnumber"/>
				<Field id="19" tableName="smart_ticket" fieldName="tckt_r_date"/>
				<Field id="28" tableName="smart_ticket" fieldName="tckt_r_helpdesk"/>
<Field id="29" tableName="smart_ticket" fieldName="tckt_site"/>
<Field id="30" tableName="smart_ticket" fieldName="tckt_c_helpdesk"/>
<Field id="31" tableName="smart_ticket" fieldName="id"/>
</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="printreportslogstat.php" forShow="True" url="printreportslogstat.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="printreportslogstat_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="20"/>
			</Actions>
		</Event>
	</Events>
</Page>
