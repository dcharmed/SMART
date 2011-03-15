<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="9" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" dataSource="smart_referencecode, smart_referencecode smart_referencecode1" activeCollection="TableParameters" name="GStatProbCat" pageSizeLimit="100" wizardCaption="List of Smart Referencecode " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" wizardUsePageScroller="True">
			<Components>
				<Label id="16" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="reportscatGStatProbCatlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Integer" html="True" name="TotalTic" wizardCaption="Ref Rank" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="reportscatGStatProbCatTotalTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="catval" fieldSource="catvalue" wizardCaption="Ref Value" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportscatGStatProbCatcatval">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="ref_description" fieldSource="cat" wizardCaption="Ref Description" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="reportscatGStatProbCatref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Integer" html="True" name="JanTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatJanTic">
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
				<Label id="21" fieldSourceType="DBColumn" dataType="Integer" html="True" name="FebTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatFebTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Integer" html="True" name="MacTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatMacTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Integer" html="True" name="AprTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatAprTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Integer" html="True" name="MeiTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatMeiTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Integer" html="True" name="JuneTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatJuneTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Integer" html="True" name="JulTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatJulTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Integer" html="True" name="Augtic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatAugtic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Integer" html="True" name="SeptTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatSeptTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Integer" html="True" name="OctTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatOctTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Integer" html="True" name="NovTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatNovTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="31" fieldSourceType="DBColumn" dataType="Integer" html="True" name="DecTic" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatDecTic">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="34" fieldSourceType="DBColumn" dataType="Integer" html="False" name="GTotal" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatGTotal">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Text" html="False" name="SubCat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatSubCat" fieldSource="subcat">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="40" fieldSourceType="DBColumn" dataType="Text" name="subcatval" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatsubcatval" fieldSource="subcatvalue">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblYear" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatlblYear">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="49" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJan" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalJan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="50" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalFeb" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalFeb">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="51" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMac" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalMac">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="52" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalApr" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalApr">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="53" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalMei" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalMei">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="54" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJune" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalJune">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="55" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalJuly" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalJuly">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="56" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalAug" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalAug">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="57" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalSept" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalSept">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="58" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalOct" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalOct">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="59" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalNov" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalNov">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="60" fieldSourceType="DBColumn" dataType="Integer" html="False" name="TotalDec" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatGStatProbCatTotalDec">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
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
			</Events>
			<TableParameters>
				<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="smart_referencecode.ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="probcat"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="10" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
				<JoinTable id="35" tableName="smart_referencecode" alias="smart_referencecode1" posLeft="148" posTop="10" posWidth="117" posHeight="152"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="37" tableLeft="smart_referencecode" tableRight="smart_referencecode1" fieldLeft="smart_referencecode.ref_value" fieldRight="smart_referencecode1.ref_type" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="12" tableName="smart_referencecode" fieldName="smart_referencecode.ref_value" alias="catvalue"/>
				<Field id="13" tableName="smart_referencecode" fieldName="smart_referencecode.ref_description" alias="cat"/>
				<Field id="38" tableName="smart_referencecode1" fieldName="smart_referencecode1.ref_description" alias="subcat"/>
				<Field id="41" tableName="smart_referencecode1" fieldName="smart_referencecode1.ref_value" alias="subcatvalue"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<ImageLink id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="reportscatImageLink1" hrefSource="printrptcat.ccp">
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
		<CodeFile id="Events" language="PHPTemplates" name="reportscat_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="reportscat.php" forShow="True" url="reportscat.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
