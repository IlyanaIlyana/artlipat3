// Пример js42
import * as lib from './artlip_lib.js';


// Выполнить скрипт после загрузки документа

$(document).ready(function()
{
	console.log("добрались до js");
	lib.RegistrationOpened();
	lib.SearchRefNumber();
	lib.ShowWhats();	
	lib.TheSameDate();
	lib.DateCalculation();
	lib.ChangeRegistrationLanguage();
});
