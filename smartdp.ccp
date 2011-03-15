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
		<Record id="5" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RCriteria" dataSource="smart_damagedpassport" errorSummator="Error" wizardCaption="Add/Edit Smart Damagedpassport " wizardFormMethod="post" PathID="RCriteria" pasteActions="pasteActions">
			<Components>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="prod" fieldSource="dp_production" required="True" caption="Dp Production" wizardCaption="Dp Production" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RCriteriaprod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="10" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="mth" fieldSource="dp_date" required="False" caption="Dp Date" wizardCaption="Dp Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RCriteriamth" connection="SMART" _valueOfList="3" _nameOfList="March" dataSource="1;Jan;2;Feb;3;March">
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
				<ListBox id="12" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="year" fieldSource="dp_date" required="False" caption="Dp Date" wizardCaption="Dp Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RCriteriayear">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="33"/>
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
				<ListBox id="9" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="site" fieldSource="dp_site" required="False" caption="Dp Site" wizardCaption="Dp Site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RCriteriasite" connection="SMART" dataSource="smart_site" boundColumn="site_code" textColumn="site_code">
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
<Button id="6" urlType="Relative" enableValidation="True" isDefault="False" name="BtnGenerate" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RCriteriaBtnGenerate" operation="Search">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="11" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="7" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
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
		<Record id="13" sourceType="Table" urlType="Relative" secured="False" allowInsert="0" allowUpdate="0" allowDelete="0" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="VCriteria" dataSource="smart_damagedpassport" errorSummator="Error" wizardCaption="View Smart Damagedpassport " wizardFormMethod="post" PathID="VCriteria">
			<Components>
				<Label id="15" fieldSourceType="DBColumn" dataType="Integer" html="False" name="v_prod" fieldSource="dp_production" required="True" caption="Dp Production" wizardCaption="Dp Production" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="VCriteriav_prod">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="v_site" fieldSource="dp_site" required="True" caption="Dp Site" wizardCaption="Dp Site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="VCriteriav_site">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="True" name="v_date" fieldSource="dp_date" required="True" caption="Dp Date" wizardCaption="Dp Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="VCriteriav_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="72" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblUser" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="VCriterialblUser">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="73" fieldSourceType="DBColumn" dataType="Date" html="False" name="lblDate" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="VCriterialblDate" defaultValue="CurrentDateTime">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="32"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
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
		<EditableGrid id="18" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" sourceType="SQL" defaultPageSize="30" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="GDamPassport" pageSizeLimit="100" wizardCaption="List of Smart Damagedpassport " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="GDamPassport" pasteActions="pasteActions" activeCollection="UConditions" parameterTypeListName="ParameterTypeList" dataSource="SELECT * 
FROM smart_damagedpassport
WHERE dp_site = '{site}'
AND MONTH(dp_date) = '{month}'
AND YEAR(dp_date) = '{year}' " customInsertType="Table" customInsert="smart_damagedpassport" customUpdateType="Table" customUpdate="smart_damagedpassport" activeTableType="customUpdate">
<Components>
<Label id="20" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GDamPassportlblNumber">
<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="22" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="dp_reportedby" fieldSource="dp_reportedby" required="True" caption="Reported By" wizardCaption="Dp Reportedby" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="GDamPassportdp_reportedby" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="usr_username" textColumn="usr_fullname">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="35" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="34" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="26" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="dp_category" fieldSource="dp_category" caption="Category" wizardCaption="Dp Category" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="GDamPassportdp_category" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
<TableParameter id="66" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="dpcat"/>
</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
<JoinTable id="65" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="27" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="dp_subcategory" fieldSource="dp_subcategory" caption="Sub Category" wizardCaption="Dp Subcategory" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="GDamPassportdp_subcategory" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" features="(assigned)">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
<JoinTable id="67" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features>
<PTDependentListBox id="69" enabled="True" name="PTDependentListBox1" servicePage="services/smartdp_GDamPassport_dp_subcategory_PTDependentListBox1.ccp" masterListbox="dp_category" category="Prototype">
<Components/>
<Events/>
<Features/>
</PTDependentListBox>
</Features>
				</ListBox>
				<TextBox id="28" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="dp_quantity" fieldSource="dp_quantity" required="True" caption="Quantity" wizardCaption="Dp Quantity" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GDamPassportdp_quantity">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Navigator id="29" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="30" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="GDamPassportButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="21" fieldSourceType="DBColumn" dataType="Integer" name="dp_production" fieldSource="dp_production" caption="Dp Production" wizardCaption="Dp Production" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GDamPassportdp_production">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="24" fieldSourceType="DBColumn" dataType="Text" name="dp_site" fieldSource="dp_site" caption="Dp Site" wizardCaption="Dp Site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GDamPassportdp_site">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="25" fieldSourceType="DBColumn" dataType="Text" name="dp_date" fieldSource="dp_date" caption="Dp Date" wizardCaption="Dp Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GDamPassportdp_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="74" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="GDamPassportButton_Cancel">
					<Components/>
					<Events>
<Event name="OnClick" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="75"/>
</Actions>
</Event>
</Events>
					<Attributes/>
					<Features/>
				</Button>
</Components>
			<Events>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="36"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="70"/>
</Actions>
</Event>
<Event name="BeforeShowRow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="71"/>
</Actions>
</Event>
</Events>
			<TableParameters>
				<TableParameter id="39" conditionType="Parameter" useIsNull="False" field="dp_site" dataType="Text" searchConditionType="Equal" parameterType="Session" logicOperator="And" parameterSource="site"/>
				<TableParameter id="46" conditionType="Parameter" useIsNull="False" field="dp_date" dataType="Date" searchConditionType="Equal" parameterType="Session" logicOperator="And" parameterSource="month"/>
				<TableParameter id="47" conditionType="Parameter" useIsNull="False" field="dp_date" dataType="Date" searchConditionType="Equal" parameterType="Session" logicOperator="And" parameterSource="year"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="42" parameterType="Session" variable="site" dataType="Text" parameterSource="site" designDefaultValue="TPIN"/>
				<SQLParameter id="48" parameterType="Session" variable="month" dataType="Text" parameterSource="month"/>
				<SQLParameter id="49" parameterType="Session" variable="year" dataType="Text" parameterSource="year"/>
			</SQLParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
<CustomParameter id="50" field="dp_reportedby" dataType="Text" parameterType="Control" parameterSource="dp_reportedby"/>
<CustomParameter id="51" field="dp_category" dataType="Text" parameterType="Control" parameterSource="dp_category"/>
<CustomParameter id="52" field="dp_subcategory" dataType="Text" parameterType="Control" parameterSource="dp_subcategory"/>
<CustomParameter id="53" field="dp_quantity" dataType="Integer" parameterType="Control" parameterSource="dp_quantity"/>
<CustomParameter id="54" field="dp_production" dataType="Integer" parameterType="Control" parameterSource="dp_production"/>
<CustomParameter id="55" field="dp_site" dataType="Text" parameterType="Control" parameterSource="dp_site"/>
<CustomParameter id="56" field="dp_date" dataType="Text" parameterType="Control" parameterSource="dp_date"/>
</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
<TableParameter id="64" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" searchConditionType="Equal" parameterType="DataSourceColumn" logicOperator="And" parameterSource="id"/>
</UConditions>
			<UFormElements>
<CustomParameter id="57" field="dp_reportedby" dataType="Text" parameterType="Control" parameterSource="dp_reportedby"/>
<CustomParameter id="58" field="dp_category" dataType="Text" parameterType="Control" parameterSource="dp_category"/>
<CustomParameter id="59" field="dp_subcategory" dataType="Text" parameterType="Control" parameterSource="dp_subcategory"/>
<CustomParameter id="60" field="dp_quantity" dataType="Integer" parameterType="Control" parameterSource="dp_quantity"/>
<CustomParameter id="61" field="dp_production" dataType="Integer" parameterType="Control" parameterSource="dp_production"/>
<CustomParameter id="62" field="dp_site" dataType="Text" parameterType="Control" parameterSource="dp_site"/>
<CustomParameter id="63" field="dp_date" dataType="Text" parameterType="Control" parameterSource="dp_date"/>
</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="smartdp.php" forShow="True" url="smartdp.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="smartdp_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="31"/>
			</Actions>
		</Event>
	</Events>
</Page>
