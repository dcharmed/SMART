//JS DatePicker @0-E2AD047E

var DateMasks = new Array(26);
    DateMasks["d"] = 0;
    DateMasks["dd"] = 2;
    DateMasks["m"] = 0;
    DateMasks["mm"] = 2;
    DateMasks["mmm"] = 3;
    DateMasks["mmmm"] = 0;
    DateMasks["M"] = 0;
    DateMasks["MM"] = 2;
    DateMasks["MMM"] = 3;
    DateMasks["MMMM"] = 0;
    DateMasks["yy"] = 2;
    DateMasks["yyyy"] = 4;
    DateMasks["h"] = 0;
    DateMasks["hh"] = 2;
    DateMasks["H"] = 0;
    DateMasks["HH"] = 2;
    DateMasks["n"] = 0;
    DateMasks["nn"] = 2;
    DateMasks["s"] = 0;
    DateMasks["ss"] = 2;
    DateMasks["tt"] = String(getLocaleInfo("AMDesignator")).length;
    DateMasks["am/pm"] = 2;
    DateMasks["AM/PM"] = 2;
    DateMasks["A/P"] = 1;
    DateMasks["a/p"] = 1;
    DateMasks["w"] = 0;
    DateMasks["q"] = 0;
    DateMasks["S"] = 0;

function geckoGetRv()
{
  if (navigator.product != 'Gecko')
  {
    return -1;
  }
  var rvValue = 0;
  var ua      = navigator.userAgent.toLowerCase();
  var rvStart = ua.indexOf('rv:');
  var rvEnd   = ua.indexOf(')', rvStart);
  var rv      = ua.substring(rvStart+3, rvEnd);
  var rvParts = rv.split('.');
  var exp     = 1;

  for (var i = 0; i < rvParts.length; i++)
  {
    var val = parseInt(rvParts[i]);
    rvValue += val / exp;
    exp *= 100;
  }

  return rvValue;
}


function getDayOfYear(year, month, day)
{
  var firstDay = new Date(year, 0, 1);
  var date = new Date(year, month, day);
  return (date-firstDay)/(1000*60*60*24);
}

function get12Hour(hoursNumber)
{
  if (hoursNumber == 0)
    hoursNumber = 12;
  else if (hoursNumber > 12)
    hoursNumber = hoursNumber - 12;
  return hoursNumber;
}

function addZero(value, resultLength)
{
  var countZero = resultLength - String(value).length;
  var result = String(value);
  for (var i=0; i<countZero; i++)
    result = "0" + result;
  return result;
}

function getAMPM(HoursNumber, AnteMeridiem, PostMeridiem)
{
  if (HoursNumber >= 0 && HoursNumber < 12)
    return AnteMeridiem;
  else
    return PostMeridiem;
}

function formatDate(dateToFormat, parsedFormat)
{
  var resultArray = new Array(parsedFormat.length);
  for (var i=0; i<parsedFormat.length; i++)
  {
    switch (parsedFormat[i]) 
    {
      case "d": 
        resultArray[i] = dateToFormat.getDate(); 
        break;
      case "w":
        resultArray[i] = dateToFormat.getDay()+1;
        break;
      case "m": case "M": 
        resultArray[i] = dateToFormat.getMonth()+1;
        break;
      case "q": 
        resultArray[i] = Math.floor((dateToFormat.getMonth()+4)/4);
        break;
      case "y": 
        resultArray[i] = getDayOfYear(dateToFormat.getFullYear(), dateToFormat.getMonth(), dateToFormat.getDate());
        break;
      case "h": 
        resultArray[i] = "0";//get12Hour(dateToFormat.getHours());
        break;
      case "H": 
        resultArray[i] = "0";//dateToFormat.getHours();
        break;
      case "n": 
        resultArray[i] = "00";//dateToFormat.getMinutes();
        break;
      case "s": 
        resultArray[i] = "00";//dateToFormat.getSeconds();
        break;
      case "dd": 
        resultArray[i] = addZero(dateToFormat.getDate(), 2);
        break;
      case "ww": 
        resultArray[i] = Math.floor(getDayOfYear(dateToFormat.getFullYear(), dateToFormat.getMonth(), dateToFormat.getDate())/7)+1;
        break;
      case "mm": case "MM": 
        resultArray[i] = addZero(dateToFormat.getMonth()+1, 2);
        break;
      case "yy": 
        resultArray[i] = String(dateToFormat.getFullYear()).substr(2);
        break;
      case "hh": 
        resultArray[i] = "00";//addZero(get12Hour(dateToFormat.getHours()), 2);
        break;
      case "HH": 
        resultArray[i] = "00";//addZero(dateToFormat.getHours(), 2);
        break;
      case "nn": 
        resultArray[i] = "00";//addZero(dateToFormat.getMinutes(), 2);
        break;
      case "ss": 
        resultArray[i] = "00";//addZero(dateToFormat.getSeconds(), 2);
        break;
      case "S": 
        resultArray[i] = "000";//"000";
        break;
      case "ddd": 
        resultArray[i] = listShortWeekdays[dateToFormat.getDay()];
        break;
      case "mmm": case "MMM": 
        resultArray[i] = listShortMonths[dateToFormat.getMonth()];
        break;
      case "A/P": 
        resultArray[i] = "A";//getAMPM(dateToFormat.getHours(), "A", "P");
        break;
      case "a/p": 
        resultArray[i] = "a";//getAMPM(dateToFormat.getHours(), "a", "p");
        break;
      case "dddd": 
        resultArray[i] = listWeekdays[dateToFormat.getDay()];
        break;
      case "mmmm": case "MMMM": 
        resultArray[i] = listMonths[dateToFormat.getMonth()];
        break;
      case "yyyy": 
        resultArray[i] = dateToFormat.getFullYear();
        break;
      case "tt": 
        resultArray[i] = getLocaleInfo("AMDesignator");//getAMPM(dateToFormat.getHours(), getLocaleInfo("AMDesignator"), getLocaleInfo("PMDesignator"));
        break;
      case "AM/PM": 
        resultArray[i] = "AM";//getAMPM(dateToFormat.getHours(), "AM", "PM");
        break;
      case "am/pm": 
        resultArray[i] = "am";//getAMPM(dateToFormat.getHours(), "am", "pm");
        break;
      case ":": 
        resultArray[i] = ":";
        break;
      case "LongDate": 
        resultArray[i] = formatDate(dateToFormat, parseDateFormat(getLocaleInfo("longDate")));
        break;
      case "LongTime": 
        resultArray[i] = formatDate(dateToFormat, parseDateFormat(getLocaleInfo("longTime")));
        break;
      case "ShortDate": 
        resultArray[i] = formatDate(dateToFormat, parseDateFormat(getLocaleInfo("shortDate")));
        break;
      case "ShortTime": 
        resultArray[i] = formatDate(dateToFormat, parseDateFormat(getLocaleInfo("shortTime")));
        break;
      case "GeneralDate": 
        resultArray[i] = formatDate(dateToFormat, parseDateFormat(getLocaleInfo("shortDate")+" "+getLocaleInfo("longTime")));
        break;
      default:
        if (String(parsedFormat[i]).charAt(0)=="\\")
        resultArray[i] = String(parsedFormat[i]).substr(0);
      else
        resultArray[i] = parsedFormat[i];
    }
  }
  return resultArray.join("");
}

function parseDate(dateToParse, parsedMask)
{
  var resultDate, resultDateArray = new Array(8);
  var MaskPart, MaskLength, TokenLength;
  var IsError;
  var DatePosition, MaskPosition;
  var Delimiter, BeginDelimiter;
  var MonthNumber, MonthName;
  var DatePart;

  var IS_DATE_POS, YEAR_POS, MONTH_POS, DAY_POS, IS_TIME_POS, HOUR_POS, MINUTE_POS, SECOND_POS;

  IS_DATE_POS = 0;  YEAR_POS = 1;  MONTH_POS = 2;  DAY_POS = 3;
  IS_TIME_POS = 4;  HOUR_POS = 5;  MINUTE_POS = 6;  SECOND_POS = 7;

  if (!parsedMask)
  {
    resultDate = null;
  }
  else if (parsedMask[0] == "GeneralDate" && String(dateToParse)!="")
    resultDate = parseDate(dateToParse, parseDateFormat(getLocaleInfo("shortDate")+" "+getLocaleInfo("longTime")));
  else if (parsedMask[0] == "LongDate" && String(dateToParse)!="")
    resultDate = parseDate(dateToParse, parseDateFormat(getLocaleInfo("longDate")));
  else if (parsedMask[0] == "ShortDate" && String(dateToParse)!="")
    resultDate = parseDate(dateToParse, parseDateFormat(getLocaleInfo("shortDate")));
  else if (parsedMask[0] == "LongTime" && String(dateToParse)!="")
    resultDate = parseDate(dateToParse, parseDateFormat(getLocaleInfo("longTime")));
  else if (parsedMask[0] == "ShortTime" && String(dateToParse)!="")
    resultDate = parseDate(dateToParse, parseDateFormat(getLocaleInfo("shortTime")));
  else if (String(dateToParse) == "") resultDate = null;
  else
  {
    DatePosition = 0;
    MaskPosition = 0;
    MaskLength = parsedMask.length;
    IsError = false;

    // Default date
    resultDateArray[IS_DATE_POS] = false;
    resultDateArray[IS_TIME_POS] = false;
    resultDateArray[YEAR_POS] = 0;  resultDateArray[MONTH_POS] = 12;  resultDateArray[DAY_POS] = 1;
    resultDateArray[HOUR_POS] = 0;  resultDateArray[MINUTE_POS] = 0;  resultDateArray[SECOND_POS] = 0;

    while ((MaskPosition < MaskLength) && !IsError)
    {
      MaskPart = parsedMask[MaskPosition];
      if (DateMasks[MaskPart] != null)
      {
        TokenLength = DateMasks[MaskPart];
        if (TokenLength > 0)
        {
          DatePart = String(dateToParse).substr(DatePosition, TokenLength);
          DatePosition = DatePosition + TokenLength;
        }else
        {
          if (MaskPosition < MaskLength)
          {
            Delimiter = parsedMask[MaskPosition + 1];
            BeginDelimiter = dateToParse.indexOf(Delimiter, DatePosition);
            if (BeginDelimiter == -1)
            {
              //alert("ParseDate function: The number doesn't match the mask.");
              return null;
            }else 
            {
              DatePart = String(dateToParse).substr(DatePosition, BeginDelimiter - DatePosition);
              DatePosition = BeginDelimiter;
            }
          }else DatePart = String(dateToParse).substr(DatePosition);
        }
        switch (MaskPart)
        {
          case "d": case "dd":
            resultDateArray[DAY_POS] = Math.floor(DatePart);
            resultDateArray[IS_DATE_POS] = true;
            break;
          case "m": case "mm": case "M": case "MM":
            resultDateArray[MONTH_POS] = Math.floor(DatePart);
            resultDateArray[IS_DATE_POS] = true;
            break;
          case "mmm": case "mmmm": case "MMM": case "MMMM":
            MonthNumber = 0;
            MonthName = String(DatePart).toUpperCase();
            if (MaskPart == "mmm") 
              MonthNamesArray = listShortMonths;
            else
              MonthNamesArray = listMonths;
            while (MonthNumber < 11 && String(MonthNamesArray[MonthNumber]).toUpperCase() != MonthName)
            {
              MonthNumber = MonthNumber + 1;
            }
            if (MonthNumber == 11) 
            {
              if (String(MonthNamesArray[11]).toUpperCase() != MonthName) 
              {
                //alert("ParseDate function: The number doesn't match the mask.");
                return null;
              }
            }
            resultDateArray[MONTH_POS] = MonthNumber + 1;
            resultDateArray[IS_DATE_POS] = true;
            break;
          case "yy": 
                  var last2Digits = Math.floor(DatePart);
            var centuryDigits = (last2Digits>=50)?1900:2000;
            resultDateArray[YEAR_POS] = centuryDigits + last2Digits;
            resultDateArray[IS_DATE_POS] = true;
            break;
          case "yyyy":
            resultDateArray[YEAR_POS] = Math.floor(DatePart);
            resultDateArray[IS_DATE_POS] = true;
            break;
          case "h": case "hh":
            if (Math.floor(DatePart) == 12) 
              resultDateArray[HOUR_POS] = 0;
            else 
              resultDateArray[HOUR_POS] = Math.floor(DatePart);
            resultDateArray[IS_TIME_POS] = true;
            break;
          case "H": case "HH":
            resultDateArray[HOUR_POS] = Math.floor(DatePart);
            resultDateArray[IS_TIME_POS] = true;
            break;
          case "n": case "nn":
            resultDateArray[MINUTE_POS] = Math.floor(DatePart);
            resultDateArray[IS_TIME_POS] = true;
            break;
          case "s": case "ss":
            resultDateArray[SECOND_POS] = Math.floor(DatePart);
            resultDateArray[IS_TIME_POS] = true;
            break;
          case "tt": case "am/pm": case "a/p": case "AM/PM": case "A/P":
            DatePart = DatePart==getLocaleInfo("AMDesignator")?"a":"p";
            if (String(DatePart).toLowerCase().charAt(0) == "p") 
              resultDateArray[HOUR_POS] = resultDateArray[HOUR_POS] + 12;
            else if (String(DatePart).toLowerCase().charAt(0) == "a") 
              resultDateArray[HOUR_POS] = resultDateArray[HOUR_POS];
            resultDateArray[IS_TIME_POS] = true;
            break;
          case "w": case "q": case "S":
            //Do Nothing
            break;
        }
      }else DatePosition = DatePosition + parsedMask[MaskPosition].length;
      MaskPosition = MaskPosition + 1
    }
    if (resultDateArray[IS_DATE_POS] && resultDateArray[IS_TIME_POS]) 
    {
      resultDate = new Date(resultDateArray[YEAR_POS], resultDateArray[MONTH_POS] - 1, resultDateArray[DAY_POS], resultDateArray[HOUR_POS], resultDateArray[MINUTE_POS], resultDateArray[SECOND_POS]);
    }else if (resultDateArray[IS_DATE_POS])
    {
      resultDate = new Date(resultDateArray[YEAR_POS], resultDateArray[MONTH_POS] - 1, resultDateArray[DAY_POS]);
    }else if (resultDateArray[IS_DATE_POS])
    {
      resultDate = new Date(0, 0, 0, resultDateArray[HOUR_POS], resultDateArray[MINUTE_POS], resultDateArray[SECOND_POS]);
    }
  }
  return resultDate;
}

function checkDateRange(date)
{
  var minDate = new Date(1753, 0, 1);
  var maxDate = new Date(9999, 11, 31);
  if (date < minDate) return minDate;
  if (date > maxDate) return maxDate;
  return date;
}

// Date formatting functions end ---------------------------------------------------

var DatePickerObject = new Object();
var datepickerControl = null;
var datepickerDocumentTop = null;
var datepickerDocumentBottom = null;
var datepickerSource = "";
var blankCellWeekend = "";
var blankCell = "";
var DatePickerBegin = "";
var DatePickerEnd = "";

var disableEvents = false;
var disableUnload = false;

var datePickerOpened = false;

// Determine browser brand
var isNav = false;
var isIE  = false;

// Assume it's either Netscape or MSIE
if (navigator.appName == "Netscape") 
{
  isNav = true;
}
else 
{
  isIE = true;
}

// Get currently selected language
selectedLanguage = navigator.language;

// DatePicker functions begin here ---------------------------------------------------

// Set the initial value of the global date field
function setDateField(dateField) 
{
  // Assign the incoming field object to a global variable
  datepickerControl = eval(dateField);

  // Set DatePickerObject.selectedDate to the date in the incoming field or default to today's date
  setInitialDate(datepickerControl.value);

  datepickerDocumentTop    = buildTop();
  datepickerDocumentBottom = buildBottom();
}

// Set the initial DatePicker date to today or to the existing value in dateField
function setInitialDate(inDate) 
{
  // Create a new date object 
  var date = parseDate(inDate, parseDateFormat(DatePickerObject.format));

  if (date) date = checkDateRange(date);

  // If the incoming date is invalid, use the current date
  if (isNaN(date) || !date) 
  {
    // Simply create a new date object which defaults to the current date
    date = new Date();
  }
  
  DatePickerObject.selectedDate = new Date(date.getFullYear(), date.getMonth(), date.getDate());
  // KEEP TRACK OF THE CURRENT DAY VALUE
  DatePickerObject.selectedDay  = date.getDate();

  // Set day value to 1... to avoid javascript date calculation anomalies
  // (if the month changes to feb and the day is 30, the month would change to march
  //  and the day would change to 2.  setting the day to 1 will prevent that)
  date.setDate(1);

  DatePickerObject.currentMonth = date.getMonth();
  DatePickerObject.currentYear = date.getFullYear();
}

// Popup a window with the DatePicker in it
function showDatePicker(object_name, form_name, form_control) 
{
  disableEvents = false;

  DatePickerObject = eval(object_name);
  if (typeof(DatePickerObject)!="object" || !DatePickerObject) return;
  DatePickerObject.control          = String("document."+form_name+"."+form_control);
  DatePickerObject.themePath        = DatePickerObject.style;
  DatePickerObject.basePath         = getBasePath();
  DatePickerObject.selectedDate     = new Date();
  DatePickerObject.selectedDay      = 1;
  DatePickerObject.currentMonth     = DatePickerObject.selectedDate.getMonth();
  DatePickerObject.currentYear      = DatePickerObject.selectedDate.getFullYear();

  if (DatePickerObject.themePath.lastIndexOf("/")!=-1)
    DatePickerObject.themePath = DatePickerObject.themePath.substr(0,DatePickerObject.themePath.lastIndexOf("/")+1);
  else if (DatePickerObject.themePath.lastIndexOf("\\")!=-1)
    DatePickerObject.themePath = DatePickerObject.themePath.substr(0,DatePickerObject.themePath.lastIndexOf("\\")+1);

  // Pre-build portions of the DatePicker when this js library loads into the browser !!!!!!
  buildDatePickerParts();

  // Set initial value of the date field and create top and bottom part
  setDateField(DatePickerObject.control);

  // Use the javascript-generated documents (datepickerDocumentTop, datepickerDocumentBottom) 
  datepickerSource = datepickerDocumentBottom;

  // Display the DatePicker in a new popup window
  try{
    top.newWinDatePickerObject.focus();
    try{ if(eval(DatePickerObject.control+".value")) writeDatePicker(); } catch(e) {}
  }catch(e){
    top.newWinDatePickerObject = null;
  }
  if (!datePickerOpened || typeof(top.newWinDatePickerObject) != "object" || (typeof(top.newWinDatePickerObject) == "object" && top.newWinDatePickerObject == null))
  {
    var datepickerURL = DatePickerObject.relativePathPart?DatePickerObject.relativePathPart+"DatePicker.html":"DatePicker.html";
    var w_left = Math.ceil(screen.width/2-120);
    var w_top = Math.ceil(screen.height/2-110);
    top.newWinDatePickerObject = window.open(datepickerURL+"?random="+Math.random(), "DatePickerWindow", "dependent=yes,left="+w_left+",top="+w_top+",width=300,height=270,screenX=200,screenY=300,titlebar=yes, center: yes, help: no, resizable: yes, status: no");
    datePickerOpened = true;
  }
}

// Retrieves a path for the <base> tag to get paths correctly
function getBasePath()
{
    var l = String(location.href);
    var q = l.indexOf("?"); l = l.substr(0, (q != -1 ? q : l.length));
    var index1 = l.lastIndexOf("\\");
    var index2 = l.lastIndexOf("/");
    var index = index1>index2?index1:index2;

    return  l.substr(0, index + 1) + DatePickerObject.relativePathPart;
}

// Create the top DatePicker part
function buildTop() 
{
  // Create the top part of the DatePicker
  var imgPrevYear = DatePickerObject.themePath+"PrevYear.gif";
  var imgPrevMonth = DatePickerObject.themePath+"PrevMonth.gif";
  var imgNextMonth = DatePickerObject.themePath+"NextMonth.gif";
  var imgNextYear = DatePickerObject.themePath+"NextYear.gif";
  if (DatePickerObject.themeVersion=="3.0")
  {
    imgPrevYear = DatePickerObject.themePath+"Images/Back.gif";
    imgPrevMonth = DatePickerObject.themePath+"Images/Prev.gif";
    imgNextMonth = DatePickerObject.themePath+"Images/Next.gif";
    imgNextYear = DatePickerObject.themePath+"Images/Forward.gif";
  }
  var datepickerDocument = (DatePickerObject.themeVersion=="3.0"?"":"<TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0 CLASS=CalendarControls>");
  if (DatePickerObject.themeVersion!="3.0") datepickerDocument += "<TR><TD>";
  datepickerDocument += 
      "<A " +
      "HREF=\"javascript:parent.opener.setPreviousYear()\"><IMG SRC=\""+imgPrevYear+"\" BORDER=\"0\"></A><A " +
      "HREF=\"javascript:parent.opener.setPreviousMonth()\"><IMG SRC=\""+imgPrevMonth+"\" BORDER=\"0\"></A>";
  if (DatePickerObject.themeVersion!="3.0") datepickerDocument += "</TD><TD ALIGN=\"center\" WIDTH=\"100%\">";
  else datepickerDocument += "&nbsp;&nbsp;&nbsp;&nbsp;";
  datepickerDocument += 
      "<LABEL ID=\"labelMonth\">"+listMonths[DatePickerObject.currentMonth]+"</LABEL>&nbsp;<LABEL ID=\"labelYear\">"+DatePickerObject.currentYear+"</LABEL>";
  if (DatePickerObject.themeVersion!="3.0") datepickerDocument += "</TD><TD>";
  else datepickerDocument += "&nbsp;&nbsp;&nbsp;&nbsp;";
  datepickerDocument += 
      "<A " +
      "HREF=\"javascript:parent.opener.setNextMonth()\"><IMG SRC=\""+imgNextMonth+"\" BORDER=\"0\"></A><A " +
      "HREF=\"javascript:parent.opener.setNextYear()\"><IMG SRC=\""+imgNextYear+"\" BORDER=\"0\"></A>";
  if (DatePickerObject.themeVersion!="3.0") datepickerDocument += "</TD></TR></TABLE>";
  //prompt("",datepickerDocument)
  return datepickerDocument;
}

// Create the bottom DatePicker part 
function buildBottom() 
{
  // Start DatePicker document
  var datepickerDocument = (isNav?"<HTML>" + "<HEAD>" +
	  "<base href=\"" + DatePickerObject.basePath + "\">" + 
      // Stylesheet defines appearance of DatePicker
      "<LINK REL=\"stylesheet\" TYPE=\"text/css\" HREF=\""+DatePickerObject.style+"\">" +
      "<TITLE> Date Picker </TITLE>" +
      "</HEAD>" +
      "<BODY ONUNLOAD='parent.opener.UnLoad();'>":"") + DatePickerBegin.replace(/{datepickerDocumentTop}/, datepickerDocumentTop);

  // Get month, and year from global DatePicker date
  var month   = DatePickerObject.currentMonth;
  var year    = DatePickerObject.currentYear;
  var date = new Date();


  // Get globally-tracked day value (prevents javascript date anomalies)
  var selectedDay = DatePickerObject.selectedDay;

  var i   = 0;

  // Determine the number of days in the current month
  var days = getDaysInMonth();

  // If global day value is > than days in month, highlight last day in month
  if (selectedDay > days) 
    selectedDay = days;

  // Determine what day of the week the DatePicker starts on
  var firstOfMonth = new Date (year, month, 1);

  // Get the day of the week the first day of the month falls on
  var startingPos  = firstOfMonth.getDay() - firstWeekDayIndex;
  if (startingPos<0) startingPos += 7;
  days += startingPos;

  // Keep track of the columns, start a new row after every 7 columns
  var columnCount = 0;

  // Make beginning non-date cells blank
  for (i = 0; i < startingPos; i++) 
  {
    if ((columnCount + firstWeekDayIndex) % 7 == 0 || (columnCount + firstWeekDayIndex) % 7 == 6)
      datepickerDocument += blankCellWeekend
    else
      datepickerDocument += blankCell;
    columnCount++;
  }

  // Set values for days of the month
  var currentDay = 0;
  var dayType    = "weekday";
  var dayBackground = "";

  // Date cells contain a number
  for (i = startingPos; i < days; i++) 
  {
    var paddingChar = "&nbsp;";
    dayBackground = "";

    var padding = "";
    // Adjust spacing so that all links have relatively equal widths
    if (i-startingPos+1 < 10) 
      padding = "&nbsp;&nbsp;";
    else 
      padding = "&nbsp;";

    // Get the day currently being written
    currentDay = i-startingPos+1;

    // Set the type of day, the selected day generally appears as a different color
    var currentDate = DatePickerObject.selectedDate;

    if (currentDay == selectedDay && month==currentDate.getMonth() && year==currentDate.getFullYear())
    {
      dayType = "CalendarSelectedDay";
      dayBackground = "CalendarSelectedDay";
    }
    else if (currentDay == date.getDate() && month==date.getMonth() && year==date.getFullYear())
    {
      dayType = "CalendarToday";
      dayBackground = "CalendarToday";
    }
    else 
    {
      dayType = "CalendarDay";
    }


    // Add the day to the DatePicker string depending on workday or not. 
    if ((columnCount + firstWeekDayIndex) % 7 == 0 || (columnCount + firstWeekDayIndex) % 7 == 6)
    {
      datepickerDocument += "<TD align=center class=\""+(dayBackground?dayBackground:"CalendarWeekend")+"\">" +
		padding + 
                "<a href=\"javascript:parent.opener.returnDate(" + 
                currentDay + ")\">" + currentDay + "</a>" + 
		paddingChar + "</TD>";
    }
    else 
    {
      datepickerDocument += "<TD align=center class=\""+(dayBackground?dayBackground:"CalendarDay")+"\">" +
		padding + 
                "<a href=\"javascript:parent.opener.returnDate(" + 
                currentDay + ")\">" + currentDay + "</a>" +
		paddingChar + "</TD>";
    }
    columnCount++;

    // Start a new row when necessary
    if (columnCount % 7 == 0) 
      datepickerDocument += "</TR><TR>";
  }

  // Make remaining non-date cells blank
  for (i=days; i<(startingPos<0?42+startingPos:42); i++)
  {
    if ((columnCount + firstWeekDayIndex) % 7 == 0 || (columnCount + firstWeekDayIndex) % 7 == 6)
      datepickerDocument += blankCellWeekend;
    else
      datepickerDocument += blankCell;
    columnCount++;

    // Start a new row when necessary
    if (columnCount % 7 == 0) 
    {
      datepickerDocument += "</TR>";
      if (i<(startingPos<0?41+startingPos:41)) datepickerDocument += "<TR>";
    }
  }

  // Finish the new DatePicker page
  datepickerDocument += DatePickerEnd + (isNav?"</BODY>" + "</HTML>":"");

  // Return the completed DatePicker page
  return datepickerDocument;
}

// Write the monthly DatePicker to the bottom DatePicker part
function writeDatePicker()
{
  // Set top.newWinDatePickerObject when DatePicker window is refreshed
  if (!datePickerOpened || typeof(top.newWinDatePickerObject) != "object" || (typeof(top.newWinDatePickerObject) == "object" && top.newWinDatePickerObject == null))
  {
    var datepickerURL = DatePickerObject.relativePathPart?DatePickerObject.relativePathPart+"DatePicker.html":"DatePicker.html";
    var w_left = Math.ceil(screen.width/2-120);
    var w_top = Math.ceil(screen.height/2-110);
    top.newWinDatePickerObject = window.open(datepickerURL+"?random="+Math.random(), "DatePickerWindow", "dependent=yes,left="+w_left+",top="+w_top+",width=300,height=270,screenX=200,screenY=300,titlebar=yes, center: yes, help: no, resizable: yes, status: no");
  }

  // Create the new DatePicker for the selected month & year
  datepickerDocumentTop    = buildTop();
  datepickerDocumentBottom = buildBottom();

  // Write the new DatePicker to the bottom part
  disableUnload = true;
  top.newWinDatePickerObject.document.open();
  top.newWinDatePickerObject.document.write(datepickerDocumentBottom);
  top.newWinDatePickerObject.document.close();
  disableUnload = false;
}

// Set the DatePicker to today's date and display the new DatePicker
function setToday()
{
  // Set global date to today's date
  var date = new Date();

  // Set day month and year to today's date
  DatePickerObject.currentMonth = date.getMonth();
  DatePickerObject.currentYear = date.getFullYear();
  returnDate(date.getDate());
}

// Set the global date to the previous year and redraw the DatePicker
function setPreviousYear()
{
  var year = DatePickerObject.currentYear - 1;
  var date = new Date();
  date.setFullYear(year);
  date = checkDateRange(date);
  year = date.getFullYear();
  DatePickerObject.currentYear = year;
  writeDatePicker();
}

// Set the global date to the previous month and redraw the DatePicker
function setPreviousMonth()
{
  var year  = DatePickerObject.currentYear;
  var month = DatePickerObject.currentMonth;

  // If month is january, set month to december and decrement the year
  if (month == 0)
  {
    month = 11;
    if (year > 1000)
    {
      year--;
      var date = new Date();
      date.setFullYear(year);
      date = checkDateRange(date);
      year = date.getFullYear();
      DatePickerObject.currentYear = year;
    }
  }else 
  {
    month--;
  }
  DatePickerObject.currentMonth = month;
  writeDatePicker();
}

// Set the global date to the next month and redraw the DatePicker
function setNextMonth()
{
  var year = DatePickerObject.currentYear;
  var month = DatePickerObject.currentMonth;

  // If month is december, set month to january and increment the year
  if (month == 11)
  {
    month = 0;
    year++;
    var date = new Date();
    date.setFullYear(year);
    date = checkDateRange(date);
    year = date.getFullYear();
    DatePickerObject.currentYear = year;
  } else
  {
    month++;
  }
  DatePickerObject.currentMonth = month;
  writeDatePicker();
}

// Set the global date to the next year and redraw the DatePicker
function setNextYear()
{
  var year  = DatePickerObject.currentYear + 1;
  var date = new Date();
  date.setFullYear(year);
  date = checkDateRange(date);
  year = date.getFullYear();
  DatePickerObject.currentYear = year;
	writeDatePicker();
}

// Get number of days in month
function getDaysInMonth()
{
  var days;
  var month = DatePickerObject.currentMonth+1;
  var year  = DatePickerObject.currentYear;

  // Return 31 days
  if (month==1 || month==3 || month==5 || month==7 || month==8 || month==10 || month==12)
  {
    days=31;
  }
  // Return 30 days
  else if (month==4 || month==6 || month==9 || month==11) 
  {
    days=30;
  }
  // Return 29 days
  else if (month==2)  
  {
    if (isLeapYear(year))
    {
      days=29;
    }
    // Return 28 days
    else 
    {
      days=28;
    }
  }
  return (days);
}

// Check to see if year is a leap year
function isLeapYear (Year)
{
  if (((Year % 4)==0) && ((Year % 100)!=0) || ((Year % 400)==0))
    return true;
  else 
    return false;
}

// Set days of the week depending on language
function createWeekdayList()
{
  firstWeekDayIndex = 0;
  newWeekdayArray = new Array(7);
  newWeekdayList = new Array(7);

  for (var i=0; i<listShortWeekdays.length; i++)
    if (listShortWeekdays[i]==firstWeekDay) firstWeekDayIndex = i;

  for (var i=firstWeekDayIndex; i<listShortWeekdays.length; i++)
  {
      newWeekdayArray[i-firstWeekDayIndex] = listShortWeekdays[i];
      newWeekdayList[i-firstWeekDayIndex] = listWeekdays[i];
  }

  for (var i=0; i<firstWeekDayIndex; i++)
  {
      newWeekdayArray[7-firstWeekDayIndex+i] = listShortWeekdays[i];
      newWeekdayList[7-firstWeekDayIndex+i] = listWeekdays[i];
  }

  // Start html to hold weekday names in table format
  var weekdays = "<TR>";

  // Loop through weekday array
  var columnCount = 0;
  for (var i = 0; i < listShortWeekdays.length; i++)
  {
    weekdays += "<TD class=\"CalendarWeekdayName\" align=\"center\">" + newWeekdayArray[i] + "</TD>";
    columnCount++;
  }

  weekdays += "</TR>";

  // Return table row of weekday abbreviations to display above the DatePicker
  return weekdays;
}

// Pre-build portions of the DatePicker (for performance reasons)
function buildDatePickerParts()
{
  // Generate weekday headers for the DatePicker
  weekdays = createWeekdayList();

  // Build the blank cell rows
  blankCell = "<TD align=center class=\"CalendarDay\">&nbsp;&nbsp;&nbsp;</TD>";
  blankCellWeekend = "<TD align=center class=\"CalendarWeekend\">&nbsp;&nbsp;&nbsp;</TD>";

  // Build the top portion of the DatePicker page using css to control some display elements
  DatePickerBegin =
      (isNav?"":"<HTML>" +
      "<HEAD>" +
	  "<base href=\"" + DatePickerObject.basePath + "\">" + 	  
      // Stylesheet defines appearance of DatePicker
      "<LINK REL=\"stylesheet\" TYPE=\"text/css\" HREF=\""+DatePickerObject.style+"\">" +
      "<TITLE> Date Picker </TITLE>" +
      "</HEAD>" +
      "<BODY ONUNLOAD='parent.opener.UnLoad();'>") + "<CENTER>";

  // Navigator needs a table container to display the table outlines properly
  if (DatePickerObject.themeVersion=="3.0")
    DatePickerBegin += "<TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0><TR><TD>";
  else
    DatePickerBegin += "<TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0><TR><TD>{datepickerDocumentTop}</TD></TR><TR><TD ALIGN=CENTER VALIGN=TOP>";

  // Build weekday headings
  if (DatePickerObject.themeVersion=="3.0")
  {
    DatePickerBegin += "<TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0 CLASS=\"Grid\"><TR CLASS=Footer><TD COLSPAN=7>{datepickerDocumentTop}</TD></TR>";
    DatePickerBegin += weekdays + "<TR>";
  }else
    DatePickerBegin += "<TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0 CLASS=\"Calendar\">" + weekdays + "<TR>";

  // Build the bottom portion of the DatePicker page
  DatePickerEnd = "";

  if (DatePickerObject.themeVersion=="3.0")
  {
    var translation_language = "en";
    var imgToday = DatePickerObject.themePath+"Images/"+translation_language+"/ButtonToday.gif";
    DatePickerEnd += "<tr class=Footer><form id=calTable name=calTable><td colspan=7><input type=image src="+imgToday+" name=today onClick=\"parent.opener.setToday()\"></td></form></tr>";
  }

  // Navigator needs a table container to display the borders properly
  DatePickerEnd += "</TABLE>";

  // End the table and html document
  if (DatePickerObject.themeVersion!="3.0")
    DatePickerEnd +=
      "</TABLE>" +
      (isNav?"<FORM NAME='calTable' onSubmit='return false;'>":"") + 
      "<TABLE CELLPADDING=0 CELLSPACING=0 BORDER='0'>" + 
      (isNav?"":"<FORM NAME='calTable' onSubmit='return false;'>") +
      "<TD>" +
      "<INPUT TYPE='button' CLASS='CalendarButton' NAME='today' VALUE='Today' onClick=\"parent.opener.setToday()\">" + 
      "</TD>" + 
      (isNav?"":"</FORM>")+
      "</TABLE>" +
      (isNav?"</FORM>":"")+
      "</CENTER>" +
      "</HTML>";
}

// Set field value to the date selected and close the DatePicker window
function returnDate(inDay)
{
  disableEvents = true;
  // inDay = the day the user clicked on
  var date = new Date(DatePickerObject.currentYear, DatePickerObject.currentMonth, 1);
  date.setDate(inDay);

  if (date) date = checkDateRange(date);

  // Set the date returned to the user
  var dateFormat = DatePickerObject.format;

  var outDate = formatDate(date, parseDateFormat(dateFormat));

  // Set the value of the field that was passed to the DatePicker
  datepickerControl.value = String(outDate).replace(/\s*$/, "");

  // Give focus back to the date field
  if (datepickerControl.type!="hidden") datepickerControl.focus();

  // Close the DatePicker window
  top.newWinDatePickerObject.close()
  top.newWinDatePickerObject = null;
}

function UnLoad()
{
  if (disableUnload) return;
  disableEvents = true;
  datePickerOpened = false;
}

//End JS DatePicker

