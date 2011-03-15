<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
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
		<Record id="5" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="OptionReport" wizardCaption="Search Smart Reportsopt " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="reports.ccp" PathID="OptionReport" pasteActions="pasteActions">
			<Components>
				<ListBox id="7" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="opt" wizardCaption="Opt Type" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="OptionReportopt" connection="SMART" dataSource="smart_reportsopt" activeCollection="TableParameters" boundColumn="opt_value" textColumn="opt_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="10" conditionType="Parameter" useIsNull="False" field="opt_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="type"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="9" tableName="smart_reportsopt" posLeft="10" posTop="10" posWidth="100" posHeight="120"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="8" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="type" wizardCaption="Opt Description" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="OptionReporttype" connection="SMART" dataSource="smart_reportsopt" boundColumn="opt_value" textColumn="opt_description" features="(assigned)">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="11" tableName="smart_reportsopt" posLeft="10" posTop="10" posWidth="100" posHeight="120"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features>
						<PTDependentListBox id="13" enabled="True" name="PTDependentListBox1" servicePage="services/reports_smart_reportsopt_type_PTDependentListBox1.ccp" masterListbox="opt" category="Prototype">
							<Components/>
							<Events/>
							<Features/>
						</PTDependentListBox>
					</Features>
				</ListBox>
				<Button id="6" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="OptionReportButton_DoSearch">
					<Components/>
					<Events/>
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
		<Record id="15" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="CriteriaRpt" wizardCaption="Search Smart Ticket " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="reports.ccp" PathID="CriteriaRpt" pasteActions="pasteActions">
			<Components>
				<Button id="16" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="CriteriaRptButton_DoSearch">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="41"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="17" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s" wizardCaption="Tckt State" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="CriteriaRpts" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="30" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="state"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="29" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="19" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="sv" wizardCaption="Tckt Severity" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="CriteriaRptsv" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="32" conditionType="Parameter" useIsNull="False" field="ref_value" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="severity"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="31" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="21" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="cat" wizardCaption="Tckt Category" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="CriteriaRptcat" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="36" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="probcat"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="35" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="ad" wizardCaption="Tckt Adukomn" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="CriteriaRptad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="26" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="rn" wizardCaption="Tckt Refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" PathID="CriteriaRptrn">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="18" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="b" wizardCaption="Tckt Site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="CriteriaRptb" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" features="(assigned)">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features>
						<PTDependentListBox id="38" enabled="True" name="PTDependentListBox1" servicePage="services/reports_smart_ticket_b_PTDependentListBox1.ccp" masterListbox="s" category="Prototype">
							<Components/>
							<Events/>
							<Features/>
						</PTDependentListBox>
					</Features>
				</ListBox>
				<ListBox id="20" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="esc" wizardCaption="Tckt Escalate" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="CriteriaRptesc" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="34" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="esc"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="33" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="22" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="scat" wizardCaption="Tckt Subcategory" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="CriteriaRptscat" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" features="(assigned)">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features>
						<PTDependentListBox id="40" enabled="True" name="PTDependentListBox2" servicePage="services/reports_smart_ticket_scat_PTDependentListBox1.ccp" masterListbox="cat" category="Prototype">
							<Components/>
							<Events/>
							<Features/>
						</PTDependentListBox>
					</Features>
				</ListBox>
				<Hidden id="45" fieldSourceType="DBColumn" dataType="Text" name="set" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="CriteriaRptset" defaultValue="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="75" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="month" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="CriteriaRptmonth" connection="SMART" dataSource="1;Jan;2;Feb;3;March;4;April;5;Mei;6;June;7;July;8;August;9;September;10;October;11;November;12;December" _valueOfList="12" _nameOfList="December" required="True">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="76" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="year" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="CriteriaRptyear" required="True">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="77"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
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
		<Panel id="43" visible="True" name="Panrptticketrn" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panrptticketrn">
			<Components>
				<IncludePage id="44" name="rptticketrn" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panrptticketrnrptticketrn" page="rptticketrn.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="54" visible="True" name="Panstatpm" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panstatpm">
			<Components>
				<IncludePage id="55" name="reportspm" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panstatpmreportspm" page="reportspm.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Record id="57" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="CriteriaStat2" wizardCaption="Search Smart Preventive " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="reports.ccp" PathID="CriteriaStat2" pasteActions="pasteActions">
			<Components>
				<Button id="62" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="CriteriaStat2Button_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="63" fieldSourceType="DBColumn" dataType="Text" name="set" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="CriteriaStat2set" defaultValue="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="78" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="year" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="CriteriaStat2year" connection="SMART">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="79"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="81" visible="Dynamic" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="month" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="CriteriaStat2month" connection="SMART" _valueOfList="12" _nameOfList="December" dataSource="1;Jan;2;Feb;3;March;4;April;5;Mei;6;June;7;July;8;August;9;September;10;October;11;November;12;December">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Label id="82" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNote" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="CriteriaStat2lblNote">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="83"/>
					</Actions>
				</Event>
			</Events>
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
		<Panel id="66" visible="True" name="Panstatcat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panstatcat">
			<Components>
				<IncludePage id="67" name="reportscat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panstatcatreportscat" page="reportscat.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="68" visible="True" name="Panresnote" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panresnote">
			<Components>
				<IncludePage id="80" name="reportsresnote" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panresnotereportsresnote" page="reportsresnote.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="70" visible="True" name="Panbranch" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panbranch">
			<Components>
				<IncludePage id="71" name="reportsbranch" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panbranchreportsbranch" page="reportsbranch.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="73" visible="True" name="PanTicket" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanTicket">
			<Components>
				<IncludePage id="74" name="reportsticket" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanTicketreportsticket" page="reportsticket.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="84" visible="True" name="Panbranchcat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panbranchcat">
			<Components>
				<IncludePage id="85" name="reportsbranchcat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panbranchcatreportsbranchcat" page="reportsbranchcat.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="86" visible="True" name="pantcktlogstat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="pantcktlogstat">
			<Components>
				<IncludePage id="87" name="reportslogstat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="pantcktlogstatreportslogstat" page="reportslogstat.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="88" visible="True" name="pansla" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="pansla">
			<Components>
				<IncludePage id="89" name="reportsla" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="panslareportsla" page="reportsla.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="90" visible="True" name="pangraf" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="pangraf">
			<Components>
				<IncludePage id="91" name="reportsgraph" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="pangrafreportsgraph" page="reportsgraph.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="92" visible="True" name="panrsltnnote" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="panrsltnnote">
			<Components>
				<IncludePage id="93" name="reportsrsltnnote" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="panrsltnnotereportsrsltnnote" page="reportsrsltnnote.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="94" visible="True" name="panrtnlist" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="panrtnlist">
<Components>
<IncludePage id="95" name="reportrtn" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="panrtnlistreportrtn" page="reportrtn.ccp">
<Components/>
<Events/>
<Features/>
</IncludePage>
</Components>
<Events/>
<Attributes/>
<Features/>
</Panel>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="reports.php" forShow="True" url="reports.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="reports_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="42"/>
			</Actions>
		</Event>
	</Events>
</Page>
