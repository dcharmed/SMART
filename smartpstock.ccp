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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" dataSource="smart_partsstock" name="GStock" pageSizeLimit="100" wizardCaption="List of Smart Partsstock " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" orderBy="pstock_date">
			<Components>
				<Label id="12" fieldSourceType="DBColumn" dataType="Date" html="False" name="pstock_date" fieldSource="pstock_date" wizardCaption="Pstock Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GStockpstock_date" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="False" name="pstock_preqformno" fieldSource="pstock_preqformno" wizardCaption="Pstock Preqformno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GStockpstock_preqformno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="pstock_in" fieldSource="pstock_number" wizardCaption="Pstock Number" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GStockpstock_in">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" fieldSourceType="DBColumn" dataType="Integer" html="False" name="pstock_out" fieldSource="pstock_checking" wizardCaption="Pstock Checking" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GStockpstock_out">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" fieldSourceType="DBColumn" dataType="Integer" html="False" name="pstock_balance" fieldSource="pstock_balance" wizardCaption="Pstock Balance" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GStockpstock_balance">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="17" fieldSourceType="DBColumn" dataType="Memo" html="False" name="pstock_remarks" fieldSource="pstock_remarks" wizardCaption="Pstock Remarks" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GStockpstock_remarks">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="18" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblPart" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStocklblPart">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" name="stock_item" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStockstock_item">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="21" fieldSourceType="DBColumn" dataType="Text" html="False" name="stock_code" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStockstock_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="stock_number" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStockstock_number">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStocklblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="45" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="BtnUpdStock" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GStockBtnUpdStock" hrefSource="smartpstock.ccp">
<Components/>
<Events/>
<LinkParameters/>
<Attributes/>
<Features/>
</ImageLink>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="24"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="25"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="10" conditionType="Parameter" useIsNull="False" field="pstock_itemcode" parameterSource="s_pstock_itemcode" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="pstock_itemname" parameterSource="s_pstock_itemname" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<JoinTables>
<JoinTable id="52" tableName="smart_partsstock" posLeft="10" posTop="10" posWidth="144" posHeight="180"/>
</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="6" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="SStock" wizardCaption="Search Smart Partsstock " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="smartpstock.ccp" PathID="SStock">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="SStockButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="qryc" wizardCaption="Pstock Itemcode" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="SStockqryc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="qryn" wizardCaption="Pstock Itemname" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" PathID="SStockqryn">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
		<Record id="31" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="RStock" connection="SMART" dataSource="smart_partsstock" PathID="RStock">
			<Components>
				<Button id="32" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" PathID="RStockButton_Insert">
					<Components/>
					<Events>
<Event name="OnClick" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="46"/>
</Actions>
</Event>
</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="33" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" PathID="RStockButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="pstock_itemname" caption="Item Name" fieldSource="pstock_itemname" required="True" PathID="RStockpstock_itemname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="36" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="pstock_itemcode" caption="Item Code" fieldSource="pstock_itemcode" required="True" PathID="RStockpstock_itemcode" features="(assigned)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features>
<PTAutoFill id="49" enabled="True" valueField="value" sourceType="Table" name="PTAutoFill1" servicePage="services/smartpstock_RStock_pstock_itemcode_PTAutoFill1.ccp" searchField="id" connection="SMART" featureNameChanged="No" dataSource="smart_partsstock" category="Prototype">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Controls>
<Control id="50" name="pstock_itemname" source="pstock_itemname" propertyValue="value" sourceId="35"/>
<Control id="51" name="pstock_number" source="pstock_number" propertyValue="value" sourceId="37"/>
</Controls>
<ControlPoints/>
<Features/>
</PTAutoFill>
</Features>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="pstock_number" caption="Stock Number" fieldSource="pstock_number" required="True" PathID="RStockpstock_number">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="pstock_date" caption="Date" fieldSource="pstock_date" required="True" PathID="RStockpstock_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="39" name="DatePicker_pstock_date" style="Styles/{CCS_Style}/Style.css" control="pstock_date" PathID="RStockDatePicker_pstock_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="pstock_preqformno" caption="Form No." fieldSource="pstock_preqformno" required="True" PathID="RStockpstock_preqformno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<RadioButton id="41" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Integer" html="True" returnValueType="Number" name="pstock_checking" caption="Stock Checking" fieldSource="pstock_checking" required="True" PathID="RStockpstock_checking" connection="SMART" _valueOfList="1" _nameOfList="In" dataSource="1;In;2;Out;3;Stock Updates">
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
				</RadioButton>
				<TextBox id="42" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="pstock_balance" caption="Balance" fieldSource="pstock_balance" required="True" PathID="RStockpstock_balance">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="pstock_remarks" caption="Remarks" fieldSource="pstock_remarks" required="False" PathID="RStockpstock_remarks">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="44" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="pstock_qty" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RStockpstock_qty" fieldSource="pstock_qty" required="True" caption="Quantity Stock">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
<Event name="BeforeShow" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="47"/>
</Actions>
</Event>
</Events>
			<TableParameters>
				<TableParameter id="34" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" searchConditionType="Equal" parameterType="URL" parameterSource="id" logicOperator="And" orderNumber="1"/>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="smartpstock.php" forShow="True" url="smartpstock.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="smartpstock_events.php" forShow="False" comment="//" codePage="windows-1252"/>
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
