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
		<Record id="23" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RActivityDetails" dataSource="smart_calendar" errorSummator="Error" wizardCaption="Add/Edit Smart Calendar " wizardFormMethod="post" PathID="RActivityDetails" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Button id="24" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RActivityDetailsButton_Insert" removeParameters="new">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="25" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RActivityDetailsButton_Update" removeParameters="cid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="26" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonDeleteOn" PathID="RActivityDetailsButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="27" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="28" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RActivityDetailsButton_Cancel" removeParameters="new;cid">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="68"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="cal_userid" fieldSource="cal_userid" required="True" caption="Cal Userid" wizardCaption="Cal Userid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RActivityDetailscal_userid" sourceType="Table" connection="SMART" dataSource="smart_user" boundColumn="id" textColumn="usr_username" activeCollection="TableParameters">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
<TableParameter id="69" conditionType="Parameter" useIsNull="False" field="usr_flag" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="0"/>
</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="40" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields>
						<Field id="41" tableName="smart_user" fieldName="id"/>
						<Field id="42" tableName="smart_user" fieldName="usr_fullname"/>
						<Field id="70" tableName="smart_user" fieldName="usr_username"/>
</Fields>
				</ListBox>
				<RadioButton id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="cal_type" fieldSource="cal_type" required="True" caption="Cal Type" wizardCaption="Cal Type" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RActivityDetailscal_type" sourceType="Table" html="True" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="39" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="evnttype"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="38" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</RadioButton>
				<TextArea id="32" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="cal_description" fieldSource="cal_description" required="True" caption="Cal Description" wizardCaption="Cal Description" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="RActivityDetailscal_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="cal_datefrom" fieldSource="cal_datefrom" required="False" caption="Cal Datefrom" wizardCaption="Cal Datefrom" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RActivityDetailscal_datefrom">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="34" name="DatePicker_cal_datefrom" control="cal_datefrom" wizardSatellite="True" wizardControl="cal_datefrom" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="RActivityDetailsDatePicker_cal_datefrom">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="cal_dateto" fieldSource="cal_dateto" required="False" caption="Cal Dateto" wizardCaption="Cal Dateto" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RActivityDetailscal_dateto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="36" name="DatePicker_cal_dateto" control="cal_dateto" wizardSatellite="True" wizardControl="cal_dateto" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="RActivityDetailsDatePicker_cal_dateto">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Hidden id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RActivityDetailsdatemodified">
<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="43"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="67"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="29" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="cid"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="46" tableName="smart_calendar" posLeft="10" posTop="10" posWidth="119" posHeight="168"/>
			</JoinTables>
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
		<Calendar id="47" months="Quarter" secured="False" showOtherMonthsDays="False" monthsInRow="4" sourceType="Table" connection="SMART" dataSource="smart_calendar" name="smart_calendar" dateField="cal_datefrom" type="Quarter" wizardWeekSeparator="True" wizardProportionalColumns="True" emptyWeeks="True">
			<Components>
				<CalendarNavigator id="48" yearsRange="10" name="Navigator" wizardType="0" wizardCalendarType="Quarter" wizardPrevYear="True" wizardPrevYearText="&lt;&lt;" wizardPrevYearHint="Prev Year" wizardNextYear="True" wizardNextYearText="&gt;&gt;" wizardNextYearHint="Next Year" wizardPrev="True" wizardPrevText="&lt;" wizardPrevHint="Prev Quarter" wizardNext="True" wizardNextText="&gt;" wizardNextHint="Next Quarter" wizardPrevMonthHint="Prev Month" wizardNextMonthHint="Next Month" wizardImages="False" wizardCurrentYear="ListBox" wizardCurrentMonth="None" wizardCurrentQuarter="ListBox" wizardCurrentMonthFormat="Short" wizardOrder="MQY" wizardButton="Submit" wizardImageButton="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CalendarNavigator>
				<Label id="59" fieldSourceType="CalendarSpecialValue" dataType="Date" html="False" name="DayOfWeek" fieldSource="CurrentProcessingDate" format="ddd" PathID="smart_calendarDayOfWeek">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="60" fieldSourceType="CalendarSpecialValue" dataType="Date" html="False" name="MonthDate" fieldSource="CurrentProcessingDate" format="mmmm, yyyy" PathID="smart_calendarMonthDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="61" fieldSourceType="CalendarSpecialValue" dataType="Date" html="False" fieldSource="CurrentProcessingDate" format="d" name="DayNumber" PathID="smart_calendarDayNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="62" fieldSourceType="DBColumn" dataType="Text" html="False" name="EventDescription" fieldSource="cal_description" PathID="smart_calendarEventDescription" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="calactivity.ccp" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="63" sourceType="DataField" name="cid" source="id"/>
					</LinkParameters>
				</Link>
				<ImageLink id="65" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_calendarImageLink1" hrefSource="calactivity.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="66" sourceType="Expression" name="new" source="1"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<Attributes/>
			<SecurityGroups/>
			<CalendarStyles>
				<CalendarStyle id="49" name="WeekdayName" value="class=&quot;CalendarWeekdayName&quot;"/>
				<CalendarStyle id="50" name="WeekendName" value="class=&quot;CalendarWeekendName&quot;"/>
				<CalendarStyle id="51" name="Day" value="class=&quot;CalendarDay&quot;"/>
				<CalendarStyle id="52" name="Weekend" value="class=&quot;CalendarWeekend&quot;"/>
				<CalendarStyle id="53" name="Today" value="class=&quot;CalendarToday&quot;"/>
				<CalendarStyle id="54" name="WeekendToday" value="class=&quot;CalendarWeekendToday&quot;"/>
				<CalendarStyle id="55" name="OtherMonthDay" value="class=&quot;CalendarOtherMonthDay&quot;"/>
				<CalendarStyle id="56" name="OtherMonthToday" value="class=&quot;CalendarOtherMonthToday&quot;"/>
				<CalendarStyle id="57" name="OtherMonthWeekend" value="class=&quot;CalendarOtherMonthWeekend&quot;"/>
				<CalendarStyle id="58" name="OtherMonthWeekendToday" value="class=&quot;CalendarOtherMonthWeekendToday&quot;"/>
			</CalendarStyles>
			<Features/>
		</Calendar>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="calactivity.php" forShow="True" url="calactivity.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="calactivity_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="64"/>
			</Actions>
		</Event>
	</Events>
</Page>
