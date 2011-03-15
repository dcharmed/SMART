<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Admin" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" pasteActions="pasteActions" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" dataSource="smart_referencecode" name="TcktSummary" pageSizeLimit="100" wizardCaption="List of Smart Referencecode " wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Label id="3" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_description" fieldSource="ref_description" wizardCaption="Ref Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="rightbarTcktSummaryref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="True" name="ref_value" fieldSource="ref_value" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="rightbarTcktSummaryref_value">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="5"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="7" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="tcktstatus"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="6" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
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
		<CodeFile id="Events" language="PHPTemplates" name="rightbar_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="rightbar.php" forShow="True" url="rightbar.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
