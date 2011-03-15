<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Admin" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<IncludePage id="18" name="header" PathID="header" page="adminheader.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="21" name="footer" PathID="footer" page="../footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Link id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRef1" PathID="linkRef1" hrefSource="AdmRefMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="30" sourceType="Expression" format="yyyy-mm-dd" name="s_code" source="probcat"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Link id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRef2" PathID="linkRef2" hrefSource="AdmRefMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="32" sourceType="Expression" format="yyyy-mm-dd" name="s_code" source="state"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image1" PathID="Image1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkUsr1" PathID="linkUsr1" hrefSource="AdmUsrMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="39" sourceType="Expression" format="yyyy-mm-dd" name="new" source="1"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Link id="42" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkUsr2" PathID="linkUsr2" hrefSource="AdmUsrMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Link id="46" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkUsr3" PathID="linkUsr3" hrefSource="AdmUsrMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="47" sourceType="Expression" format="yyyy-mm-dd" name="action" source="cp"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="50" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image4" PathID="Image4">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Image id="52" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image5" PathID="Image5">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Image id="54" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image6" PathID="Image6">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="55" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRef4" PathID="linkRef4" hrefSource="AdmRefMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="56" sourceType="Expression" format="yyyy-mm-dd" name="type" source="tcktstatus"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="59" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image7" PathID="Image7">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Image id="60" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image8" PathID="Image8">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="61" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRef5" PathID="linkRef5" hrefSource="AdmRefMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="62" sourceType="Expression" format="yyyy-mm-dd" name="type" source="actmethod"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="63" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image9" PathID="Image9">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Image id="64" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image10" PathID="Image10">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="65" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRef6" PathID="linkRef6" hrefSource="AdmRefMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="66" sourceType="Expression" format="yyyy-mm-dd" name="type" source="state"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="67" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image11" PathID="Image11">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="71" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRef7" PathID="linkRef7" hrefSource="AdmRefMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="72" sourceType="Expression" format="yyyy-mm-dd" name="type" source="tcktseverity"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="73" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image12" PathID="Image12">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="74" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRef8" PathID="linkRef8" hrefSource="AdmRefMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="75" sourceType="Expression" format="yyyy-mm-dd" name="type" source="taskstatus"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="76" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image13" PathID="Image13">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="77" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRef9" PathID="linkRef9" hrefSource="AdmRefMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="78" sourceType="Expression" format="yyyy-mm-dd" name="type" source="evnttype"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="79" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image14" PathID="Image14">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="81" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkTicket1" PathID="linkTicket1" hrefSource="AdmTicMngmt.ccp" wizardUseTemplateBlock="False" removeParameters="d_tckt;del;det">
			<Components/>
			<Events/>
			<LinkParameters>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="85" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image15" PathID="Image15">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="87" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkTicket3" PathID="linkTicket3" hrefSource="AdmTicMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="146" sourceType="Expression" name="del" source="1"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<IncludePage id="88" name="rightbar" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="rightbar" page="rightbar.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Image id="89" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image16" PathID="Image16">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="90" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRef10" PathID="linkRef10" hrefSource="AdmRefMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="91" sourceType="Expression" format="yyyy-mm-dd" name="type" source="esc"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="92" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image17" PathID="Image17">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="94" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkPm1" PathID="linkPm1" hrefSource="AdmTicketMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="95" sourceType="Expression" format="yyyy-mm-dd" name="new" source="1"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="98" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image18" PathID="Image18">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="100" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkPm2" PathID="linkPm2" hrefSource="AdmTicMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="101" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image19" PathID="Image19">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="103" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRfNGenerator1" PathID="linkRfNGenerator1" hrefSource="AdmTicMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="147" sourceType="Expression" name="refgen" source="1"/>
<LinkParameter id="150" sourceType="Expression" name="type" source="tckt"/>
</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="107" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image20" PathID="Image20">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="109" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRfNGenerator2" PathID="linkRfNGenerator2" hrefSource="AdmTicMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="148" sourceType="Expression" name="refgen" source="1"/>
<LinkParameter id="149" sourceType="Expression" name="type" source="pm"/>
</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="110" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image21" PathID="Image21">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="112" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkEq" PathID="linkEq" hrefSource="AdmEqMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="113" sourceType="Expression" format="yyyy-mm-dd" name="type" source="eq"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="116" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image22" PathID="Image22">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="118" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkToppan" PathID="linkToppan" hrefSource="AdmEqMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="119" sourceType="Expression" name="s_code" source="toppan"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="120" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image23" PathID="Image23">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="122" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkTask1" PathID="linkTask1" hrefSource="AdmTaskMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="123" sourceType="Expression" format="yyyy-mm-dd" name="type" source="task"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="126" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image24" PathID="Image24">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="128" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkTask2" PathID="linkTask2" hrefSource="AdmTaskMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="129" sourceType="Expression" name="del" source="type"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="130" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image25" PathID="Image25">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="132" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkLog1" PathID="linkLog1" hrefSource="AdmLogMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="133" sourceType="Expression" format="yyyy-mm-dd" name="type" source="log"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="136" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image26" PathID="Image26">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="138" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkLog2" PathID="linkLog2" hrefSource="AdmLogMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="139" sourceType="Expression" name="type" source="trend"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Link id="140" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkEqDel" PathID="linkEqDel" hrefSource="AdmEqMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="141" sourceType="Expression" name="type" source="deleq"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
		<Image id="142" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Image27" PathID="Image27">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Image>
		<Link id="144" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkTicket2" PathID="linkTicket2" hrefSource="AdmTicMngmt.ccp" wizardUseTemplateBlock="False">
			<Components/>
			<Events/>
			<LinkParameters>
				<LinkParameter id="145" sourceType="Expression" format="yyyy-mm-dd" name="det" source="1"/>
			</LinkParameters>
			<Attributes/>
			<Features/>
		</Link>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="index.php" forShow="True" url="index.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
