<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Grid id="10" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="300" connection="SMART" name="SlaSummary" pageSizeLimit="300" wizardCaption="List of Smart Eqtoppan " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" dataSource="smart_site" activeCollection="TableParameters" pasteActions="pasteActions" groupBy="site_sla" orderBy="site_rank">
			<Components>
				<Label id="11" fieldSourceType="DBColumn" dataType="Text" html="True" name="site" fieldSource="site_sla" wizardCaption="Eqtop Branch" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportslaSlaSummarysite">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Integer" html="False" name="totalticket" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummarytotalticket">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="13" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lesssla" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummarylesssla">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" fieldSourceType="DBColumn" dataType="Integer" html="False" name="oversla" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummaryoversla">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" fieldSourceType="DBColumn" dataType="Integer" html="False" name="totlesssla" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummarytotlesssla">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Integer" html="False" name="totoversla" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummarytotoversla">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblMonthYear" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummarylblMonthYear">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" name="lessrsvl" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummarylessrsvl">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" name="overrsvl" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummaryoverrsvl">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="False" name="lesscls" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummarylesscls">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="38" fieldSourceType="DBColumn" dataType="Text" html="False" name="overcls" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummaryovercls">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Text" html="False" name="totlessrsvl" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummarytotlessrsvl">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="40" fieldSourceType="DBColumn" dataType="Text" html="False" name="totoverrsvl" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummarytotoverrsvl">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="41" fieldSourceType="DBColumn" dataType="Text" html="False" name="totlesscls" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummarytotlesscls">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="42" fieldSourceType="DBColumn" dataType="Text" html="False" name="totovercls" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummarytotovercls">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="44" fieldSourceType="DBColumn" dataType="Integer" html="False" name="GTicketTotal" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportslaSlaSummaryGTicketTotal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="28"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
				<JoinTable id="43" tableName="smart_site" posLeft="10" posTop="10" posWidth="115" posHeight="168"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="reportsla.php" forShow="True" url="reportsla.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="reportsla_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="26"/>
			</Actions>
		</Event>
	</Events>
</Page>
