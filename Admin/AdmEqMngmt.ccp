<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Admin" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<IncludePage id="2" name="header" PathID="header" page="adminheader.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="4" name="footer" PathID="footer" page="../footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<EditableGrid id="5" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="20" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_equipment" name="GEquipment" pageSizeLimit="100" wizardCaption="List of Smart Equipment " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="GEquipment" deleteControl="CheckBox_Delete" pasteActions="pasteActions">
			<Components>
				<Label id="7" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GEquipmentlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="eqpmt_code" fieldSource="eqpmt_code" required="True" caption="Eqpmt Code" wizardCaption="Eqpmt Code" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GEquipmenteqpmt_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="eqpmt_status" fieldSource="eqpmt_status" required="False" caption="Eqpmt Status" wizardCaption="Eqpmt Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GEquipmenteqpmt_status" sourceType="ListOfValues" connection="SMART" _valueOfList="1" _nameOfList="Active" dataSource="1;Active;2;Not Active">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="eqpmt_name" fieldSource="eqpmt_name" required="True" caption="Eqpmt Name" wizardCaption="Eqpmt Name" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GEquipmenteqpmt_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="eqpmt_datelifetime" fieldSource="eqpmt_datelifetime" required="False" caption="Eqpmt Datelifetime" wizardCaption="Eqpmt Datelifetime" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GEquipmenteqpmt_datelifetime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="12" name="DatePicker_eqpmt_datelifetime" control="eqpmt_datelifetime" wizardSatellite="True" wizardControl="eqpmt_datelifetime" wizardDatePickerType="Image" wizardPicture="../Styles/{CCS_Style}/Images/DatePicker.gif" style="../Styles/{CCS_Style}/Style.css" PathID="GEquipmentDatePicker_eqpmt_datelifetime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Panel id="15" visible="True" name="CheckBox_Delete_Panel">
					<Components>
						<CheckBox id="16" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Delete" wizardAddNbsp="True" PathID="GEquipmentCheckBox_Delete_PanelCheckBox_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</CheckBox>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<Button id="17" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="GEquipmentButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GEquipmentdatemodified">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ImageLink id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GEquipmentImageLink1" hrefSource="AdmEqMngmt.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="19" sourceType="Expression" format="yyyy-mm-dd" name="s_code" source="toppan"/>
						<LinkParameter id="20" sourceType="DataField" format="yyyy-mm-dd" name="type" source="eqpmt_code"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events>
				<Event name="BeforeBuildUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="21" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="22" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="23" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="24" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="6" tableName="smart_equipment" fieldName="id" dataType="Integer"/>
			</PKFields>
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
		</EditableGrid>
		<EditableGrid id="25" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="20" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_eqtoppan" name="GToppan" pageSizeLimit="100" wizardCaption="List of Smart Eqtoppan " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="GToppan" deleteControl="CheckBox_Delete" activeCollection="TableParameters">
			<Components>
				<Label id="33" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GToppanid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="34" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="eqtop_eqcode" fieldSource="eqtop_eqcode" required="True" caption="Eqtop Eqcode" wizardCaption="Eqtop Eqcode" wizardSize="15" wizardMaxLength="15" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GToppaneqtop_eqcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="35" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="eqtop_branch" fieldSource="eqtop_branch" required="True" caption="Eqtop Branch" wizardCaption="Eqtop Branch" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GToppaneqtop_branch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="36" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="eqtop_toppan" fieldSource="eqtop_toppan" required="True" caption="Eqtop Toppan" wizardCaption="Eqtop Toppan" wizardSize="4" wizardMaxLength="4" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GToppaneqtop_toppan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="eqtop_serialnumber" fieldSource="eqtop_serialnumber" required="True" caption="Eqtop Serialnumber" wizardCaption="Eqtop Serialnumber" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GToppaneqtop_serialnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Panel id="38" visible="True" name="CheckBox_Delete_Panel">
					<Components>
						<CheckBox id="39" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Delete" wizardAddNbsp="True" PathID="GToppanCheckBox_Delete_PanelCheckBox_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</CheckBox>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<Navigator id="40" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="41" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="GToppanButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="42" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="GToppanCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="31" conditionType="Parameter" useIsNull="False" field="eqtop_branch" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1" parameterSource="s_branch"/>
				<TableParameter id="32" conditionType="Parameter" useIsNull="False" field="eqtop_eqcode" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2" parameterSource="type"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="47" tableName="smart_eqtoppan" posLeft="10" posTop="10" posWidth="130" posHeight="136"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="30" tableName="smart_eqtoppan" fieldName="id" dataType="Integer"/>
			</PKFields>
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
		</EditableGrid>
		<Record id="26" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="SToppan" wizardCaption="Search Smart Eqtoppan " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="AdmEqMngmt.ccp" PathID="SToppan" pasteActions="pasteActions">
			<Components>
				<ListBox id="29" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="type" wizardCaption="Eqtop Eqcode" wizardSize="15" wizardMaxLength="15" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="SToppantype" connection="SMART" dataSource="smart_equipment" boundColumn="eqpmt_code" textColumn="eqpmt_name">
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
				<ListBox id="28" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s_branch" wizardCaption="Eqtop Branch" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="SToppans_branch" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" features="(assigned)">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="46" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features>
						<PTDependentListBox id="50" enabled="True" name="PTDependentListBox1" servicePage="../services/Admin_AdmEqMngmt_SToppan_s_branch_PTDependentListBox1.ccp" masterListbox="s_state" category="Prototype">
							<Components/>
							<Events/>
							<Features/>
						</PTDependentListBox>
					</Features>
				</ListBox>
				<ListBox id="43" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s_state" wizardCaption="Eqtop Branch" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="SToppans_state" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="45" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="state"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="44" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Button id="27" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="SToppanButton_DoSearch">
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
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="AdmEqMngmt.php" forShow="True" url="AdmEqMngmt.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="AdmEqMngmt_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="48"/>
			</Actions>
		</Event>
	</Events>
</Page>
