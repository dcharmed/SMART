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
		<EditableGrid id="5" urlType="Relative" secured="False" emptyRows="3" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_calendar" name="smart_calendar" pageSizeLimit="100" wizardCaption="List of Smart Calendar " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="smart_calendar" deleteControl="CheckBox_Delete">
<Components>
<Label id="7" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_calendarid">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="cal_userid" fieldSource="cal_userid" required="True" caption="Cal Userid" wizardCaption="Cal Userid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_calendarcal_userid">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="cal_type" fieldSource="cal_type" required="True" caption="Cal Type" wizardCaption="Cal Type" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_calendarcal_type">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<TextArea id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="cal_description" fieldSource="cal_description" required="True" caption="Cal Description" wizardCaption="Cal Description" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="smart_calendarcal_description">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextArea>
<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="cal_datefrom" fieldSource="cal_datefrom" required="False" caption="Cal Datefrom" wizardCaption="Cal Datefrom" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_calendarcal_datefrom">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="12" name="DatePicker_cal_datefrom" control="cal_datefrom" wizardSatellite="True" wizardControl="cal_datefrom" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_calendarDatePicker_cal_datefrom">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<TextBox id="13" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="cal_dateto" fieldSource="cal_dateto" required="False" caption="Cal Dateto" wizardCaption="Cal Dateto" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_calendarcal_dateto">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="14" name="DatePicker_cal_dateto" control="cal_dateto" wizardSatellite="True" wizardControl="cal_dateto" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_calendarDatePicker_cal_dateto">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<TextBox id="15" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_calendardatemodified">
<Components/>
<Events/>
<Attributes/>
<Features/>
</TextBox>
<DatePicker id="16" name="DatePicker_datemodified" control="datemodified" wizardSatellite="True" wizardControl="datemodified" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_calendarDatePicker_datemodified">
<Components/>
<Events/>
<Attributes/>
<Features/>
</DatePicker>
<Panel id="17" visible="True" name="CheckBox_Delete_Panel">
<Components>
<CheckBox id="18" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Delete" wizardAddNbsp="True" PathID="smart_calendarCheckBox_Delete_PanelCheckBox_Delete">
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
<Navigator id="19" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Navigator>
<Button id="20" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" PathID="smart_calendarButton_Submit">
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
<PKFields>
<PKField id="6" tableName="smart_calendar" fieldName="id" dataType="Integer"/>
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
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="testCal.php" forShow="True" url="testCal.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
