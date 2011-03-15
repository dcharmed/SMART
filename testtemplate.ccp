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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="SMART" dataSource="smart_customer" name="smart_customer" pageSizeLimit="100" wizardCaption="List of Smart Customer " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records">
<Components>
<Link id="7" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="smart_customer_Insert" hrefSource="testtemplate.ccp" removeParameters="id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="smart_customersmart_customer_Insert">
<Components/>
<Events/>
<LinkParameters/>
<Attributes/>
<Features/>
</Link>
<Sorter id="8" visible="True" name="Sorter_id" column="id" wizardCaption="Id" wizardSortingType="SimpleDir" wizardControl="id" wizardAddNbsp="False" PathID="smart_customerSorter_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="9" visible="True" name="Sorter_ticket_id" column="ticket_id" wizardCaption="Ticket Id" wizardSortingType="SimpleDir" wizardControl="ticket_id" wizardAddNbsp="False" PathID="smart_customerSorter_ticket_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="10" visible="True" name="Sorter_resolution_id" column="resolution_id" wizardCaption="Resolution Id" wizardSortingType="SimpleDir" wizardControl="resolution_id" wizardAddNbsp="False" PathID="smart_customerSorter_resolution_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="11" visible="True" name="Sorter_cust_fullname" column="cust_fullname" wizardCaption="Cust Fullname" wizardSortingType="SimpleDir" wizardControl="cust_fullname" wizardAddNbsp="False" PathID="smart_customerSorter_cust_fullname">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Sorter id="12" visible="True" name="Sorter_cust_phone" column="cust_phone" wizardCaption="Cust Phone" wizardSortingType="SimpleDir" wizardControl="cust_phone" wizardAddNbsp="False" PathID="smart_customerSorter_cust_phone">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Sorter>
<Link id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="testtemplate.ccp" wizardThemeItem="GridA" PathID="smart_customerid">
<Components/>
<Events/>
<LinkParameters>
<LinkParameter id="14" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
</LinkParameters>
<Attributes/>
<Features/>
</Link>
<Label id="16" fieldSourceType="DBColumn" dataType="Integer" html="False" name="ticket_id" fieldSource="ticket_id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_customerticket_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="18" fieldSourceType="DBColumn" dataType="Integer" html="False" name="resolution_id" fieldSource="resolution_id" wizardCaption="Resolution Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_customerresolution_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" name="cust_fullname" fieldSource="cust_fullname" wizardCaption="Cust Fullname" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_customercust_fullname">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="cust_phone" fieldSource="cust_phone" wizardCaption="Cust Phone" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_customercust_phone">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Navigator id="23" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="True" wizardImagesScheme="{ccs_style}">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Navigator>
</Components>
<Events/>
<TableParameters/>
<JoinTables/>
<JoinLinks/>
<Fields>
<Field id="6" tableName="smart_customer" fieldName="id"/>
<Field id="15" tableName="smart_customer" fieldName="ticket_id"/>
<Field id="17" tableName="smart_customer" fieldName="resolution_id"/>
<Field id="19" tableName="smart_customer" fieldName="cust_fullname"/>
<Field id="21" tableName="smart_customer" fieldName="cust_phone"/>
</Fields>
<SPParameters/>
<SQLParameters/>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
<Record id="24" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_customer1" dataSource="smart_customer" errorSummator="Error" wizardCaption="Add/Edit Smart Customer " wizardFormMethod="post" PathID="smart_customer1">
<Components>
<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" PathID="smart_customer1Button_Insert">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" PathID="smart_customer1Button_Update">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<Button id="27" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" PathID="smart_customer1Button_Delete">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Button>
<TextBox id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ticket_id" fieldSource="ticket_id" required="True" caption="Ticket Id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_customer1ticket_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="resolution_id" fieldSource="resolution_id" required="True" caption="Resolution Id" wizardCaption="Resolution Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_customer1resolution_id">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="cust_fullname" fieldSource="cust_fullname" required="True" caption="Cust Fullname" wizardCaption="Cust Fullname" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_customer1cust_fullname">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="32" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="cust_phone" fieldSource="cust_phone" required="True" caption="Cust Phone" wizardCaption="Cust Phone" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_customer1cust_phone">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
</Components>
<Events/>
<TableParameters>
<TableParameter id="28" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="testtemplate.php" forShow="True" url="testtemplate.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
