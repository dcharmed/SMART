<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" dataSource="smart_referencecode, smart_referencecode smart_referencecode1" activeCollection="TableParameters" name="GStatProbCat" pageSizeLimit="100" wizardCaption="List of Smart Referencecode " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" wizardUsePageScroller="True">
			<Components>
				<Label id="3" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GStatProbCatlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="4" fieldSourceType="DBColumn" dataType="Integer" html="True" name="TotalTic" wizardCaption="Ref Rank" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GStatProbCatTotalTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="5" fieldSourceType="DBColumn" dataType="Text" html="False" name="catval" fieldSource="catvalue" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GStatProbCatcatval">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="6" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_description" fieldSource="cat" wizardCaption="Ref Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GStatProbCatref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="7" fieldSourceType="DBColumn" dataType="Integer" html="True" name="JanTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatJanTic">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="8" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="9" fieldSourceType="DBColumn" dataType="Integer" html="True" name="FebTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatFebTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="10" fieldSourceType="DBColumn" dataType="Integer" html="True" name="MacTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatMacTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="11" fieldSourceType="DBColumn" dataType="Integer" html="True" name="AprTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatAprTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="12" fieldSourceType="DBColumn" dataType="Integer" html="True" name="MeiTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatMeiTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="13" fieldSourceType="DBColumn" dataType="Integer" html="True" name="JuneTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatJuneTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" fieldSourceType="DBColumn" dataType="Integer" html="True" name="JulTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatJulTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" fieldSourceType="DBColumn" dataType="Integer" html="True" name="Augtic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatAugtic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" fieldSourceType="DBColumn" dataType="Integer" html="True" name="SeptTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatSeptTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Integer" html="True" name="OctTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatOctTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="18" fieldSourceType="DBColumn" dataType="Integer" html="True" name="NovTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatNovTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="19" fieldSourceType="DBColumn" dataType="Integer" html="True" name="DecTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatDecTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="SubCat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatSubCat" fieldSource="subcat">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="22" fieldSourceType="DBColumn" dataType="Text" name="subcatval" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatsubcatval" fieldSource="subcatvalue">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblYear" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatlblYear">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Integer" html="False" name="GTotal" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatGTotal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<Label id="37" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalJan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="39" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalFeb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalFeb">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="41" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMac" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalMac">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="43" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalApr" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalApr">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="45" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMei" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalMei">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="47" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJune" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalJune">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="49" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJuly" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalJuly">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="51" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalAug" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalAug">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="53" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalSept" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalSept">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="55" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalOct" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalOct">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="57" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalNov" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalNov">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="59" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalDec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStatProbCatTotalDec">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="23"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="24"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="25" conditionType="Parameter" useIsNull="False" field="smart_referencecode.ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="probcat"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="26" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
				<JoinTable id="27" tableName="smart_referencecode" alias="smart_referencecode1" posLeft="148" posTop="10" posWidth="117" posHeight="152"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="28" tableLeft="smart_referencecode" tableRight="smart_referencecode1" fieldLeft="smart_referencecode.ref_value" fieldRight="smart_referencecode1.ref_type" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="29" tableName="smart_referencecode" fieldName="smart_referencecode.ref_value" alias="catvalue"/>
				<Field id="30" tableName="smart_referencecode" fieldName="smart_referencecode.ref_description" alias="cat"/>
				<Field id="31" tableName="smart_referencecode1" fieldName="smart_referencecode1.ref_description" alias="subcat"/>
				<Field id="32" tableName="smart_referencecode1" fieldName="smart_referencecode1.ref_value" alias="subcatvalue"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="printrptcat.php" forShow="True" url="printrptcat.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="printrptcat_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="33"/>
			</Actions>
		</Event>
	</Events>
</Page>
