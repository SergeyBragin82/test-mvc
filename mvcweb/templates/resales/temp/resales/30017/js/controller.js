var isKey = false;

function initForm(){
	$(".inventorySearch .info-field-box .searchFields.destinationField").find("input.dijitInputInner").val("Destination");
	
	var queryStringList = com.mvci.client.util.FormsUtils.getParamsArray();
	if (queryStringList["TYPE"] && queryStringList["TYPE"] != 'undefined'){	
		if (queryStringList["TYPE"] == "buy"){
			dijit.byId("interestSelect").setDisplayedValue("I am interested in buying a week(s)");
		}else{
			dijit.byId("interestSelect").setDisplayedValue("I am interested in selling my week(s)");
		}
	}
	
	//dijit.byId("form.input.title").setDisplayedValue("Please choose one");
	//dijit.byId("form.input.stateprov").setDisplayedValue("Destination");
	//dijit.byId("form.input.country").setDisplayedValue("Please choose one");													
		
	// fields
	interestField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.interest","I am interested in");
	titleField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.title","Prefix");
	firstNameField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.firstname", "First Name");
	lastNameField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.lastname","Last Name");
	addressField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.address1","Address Line 1");
	cityField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.city","City");
	stateprovField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.selectState","State/Province");
	zipField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.zipcode","Zip Code");
	countryField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.country","Country/Region");
	phoneField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.phone1","Phone");
	emailField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.email","Email");
	emailOptinField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.optincheck","Email Opt-in");
	phoneOptinField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.optincheck","Phone Opt-in");
	mailOptinField = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.optincheck","Mail Opt-in");
	
	firstNameField2 = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.firstname2", "First Name");
	lastNameField2 = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.lastname2","Last Name");
	zipField2 = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.zipcode2","Zip Code");
	emailField2 = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.email2","Email");
	phoneField2 = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.phone12","Phone Number");
	emailOptinField2 = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.optincheck2","Email Opt-in");
	phoneOptinField2 = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.optincheck2","Phone Opt-in");
	mailOptinField2 = new com.mvci.client.marketingformsv2.ui.web.Field("form.input.optincheck2","Mail Opt-in");
    		
	// validation
	var interestFieldNotBlankValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	interestFieldNotBlankValidator.setError("Please indicate whether you are interested in buying or selling a week(s)");
	interestField.addFieldValidator(interestFieldNotBlankValidator);
	var titleNotBlankValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	titleNotBlankValidator.setError("Please select a Title");
	titleField.addFieldValidator(titleNotBlankValidator);
	var firstNameNotBlankValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	firstNameNotBlankValidator.setError("Please enter a First Name");
	firstNameField.addFieldValidator(firstNameNotBlankValidator);	
	var lastNameNotBlankValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	lastNameNotBlankValidator.setError("Please enter a Last Name");
	lastNameField.addFieldValidator(lastNameNotBlankValidator);	
	var addressNotBlankValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	addressNotBlankValidator.setError("Please enter an Address");
	addressField.addFieldValidator(addressNotBlankValidator);
	var cityNotBlandValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	cityNotBlandValidator.setError("Please enter a City");	
	cityField.addFieldValidator(cityNotBlandValidator);
	var zipNotBlankValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	zipNotBlankValidator.setError("Please enter a Zip Code");
	zipField.addFieldValidator(zipNotBlankValidator);
	var usZipValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.USZipCodeValidator("form.input.country");
	usZipValidator.setError("Please enter a valid 5 digit US Zip Code");
	zipField.addFieldValidator(usZipValidator);
	var phoneNotBlankValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	phoneNotBlankValidator.setError("Please enter a Phone Number");
	phoneField.addFieldValidator(phoneNotBlankValidator);	
	var usPhoneValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.USPhoneValidator("form.input.phone1","form.input.country");
	usPhoneValidator.setError("Please enter a valid 10 digit US Phone Number");
	phoneField.addFieldValidator(usPhoneValidator);
	var countryStateValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.CountryStateCombinationValidator("form.input.selectState");
	countryStateValidator.setError("Please select a valid combination of state/province and country/region.");
	countryField.addFieldValidator(countryStateValidator);
	var countryNotBlankValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	countryNotBlankValidator.setError("Please select a Country/Region");
	countryField.addFieldValidator(countryNotBlankValidator);
	var stateNotBlankValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	stateNotBlankValidator.setError("Please select a State");
	stateprovField.addFieldValidator(stateNotBlankValidator);
	var notblankEmailValidator = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	notblankEmailValidator.setError("Please enter an Email Address");
	emailField.addFieldValidator(notblankEmailValidator);
	var ev = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.EmailValidator();
	ev.setError("Please enter a valid Email Address");
	emailField.addFieldValidator(ev);	
	
	var firstNameNotBlankValidator2 = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	firstNameNotBlankValidator2.setError("Please enter a First Name");
	firstNameField2.addFieldValidator(firstNameNotBlankValidator2);	
	var lastNameNotBlankValidator2 = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	lastNameNotBlankValidator2.setError("Please enter a Last Name");
	lastNameField2.addFieldValidator(lastNameNotBlankValidator2);	
	var zipNotBlankValidator2 = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	zipNotBlankValidator2.setError("Please enter a Zip Code");
	zipField2.addFieldValidator(zipNotBlankValidator2);
	var phoneNotBlankValidator2 = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	phoneNotBlankValidator2.setError("Please enter a Phone Number");
	phoneField2.addFieldValidator(phoneNotBlankValidator2);	
	var notblankEmailValidator2 = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.NotBlankValidator();
	notblankEmailValidator2.setError("Please enter an Email Address");
	emailField2.addFieldValidator(notblankEmailValidator2);
	var ev2 = new com.mvci.client.marketingformsv2.ui.web.fieldValidator.EmailValidator();
	ev2.setError("Please enter a valid Email Address");
	emailField.addFieldValidator(ev2);	
			
	// form
	var formRequest = new com.mvci.client.marketingformsv2.ui.web.form.Request();
	mvcForm = new com.mvci.client.marketingformsv2.ui.web.form.MVCForm("PPC Resales Form", "DB59*1-4QZBKL", formRequest);

	document.body.style.display='';
	
	if (queryStringList["KEY"] && queryStringList["KEY"] != 'undefined'){
		dojo.byId("form.input.productId").value = queryStringList["KEY"];
		isKey = true;	
	}
}

function createRequest(f){
	mvcForm.request.fieldArray = [];
	mvcForm.request.addField(interestField);
	mvcForm.request.addField(titleField);
	mvcForm.request.addField(firstNameField);	
	mvcForm.request.addField(lastNameField);
	mvcForm.request.addField(addressField);
	mvcForm.request.addField(cityField);
	mvcForm.request.addField(stateprovField);
	mvcForm.request.addField(zipField);
	mvcForm.request.addField(countryField);
	mvcForm.request.addField(phoneField);
	mvcForm.request.addField(emailField);
	mvcForm.request.addField(emailOptinField);
	mvcForm.request.addField(phoneOptinField);
	mvcForm.request.addField(mailOptinField);

	mvcForm.formTitle = "PPC Resales Form"
	mvcForm.thankYouPageUri = "test/thank-you.shtml";
	
	if 	(dijit.byId('interestSelect').attr('value')=="buy"){
		if ( isKey == false ){dojo.byId("resortWrapper").style.display = "";}
		dojo.byId("form.input.interest").value = "buying a week(s)";
		mvcForm.request.type = "WebCRM";
		mvcForm.request.workQueueId = "136";
		mvcForm.request.messageTypeId = "254";
		mvcForm.request.formId = "DB59*1-2JJBRP";
	}else if (dijit.byId('interestSelect').attr('value')=="sell"){
		dojo.byId("resortWrapper").style.display = "none";
		dojo.byId("form.input.interest").value = "selling my week(s)";
		mvcForm.request.type = "EmailQueue";
		mvcForm.request.emailList[0] = "mvcforms.method.8882.emailq.email";
		mvcForm.request.formId = "DB59*1-3HVY65";
	}else{
		dojo.byId("resortWrapper").style.display = "none";
		dojo.byId("form.input.interest").value = "";
	}
			
	if (window.location.href.indexOf("index.shtml") > -1){
		mvcForm.request.originLOC = "DR59*1-AVQCPH";	
	}else if (window.location.href.indexOf("index-2.shtml") > -1){
		mvcForm.request.originLOC = "DR59*1-AVQCPK";	
	}
	if (mvcForm.request.originLOC == "IM59*1-2G4AE5"){ mvcForm.request.originLOC = "DB59*1-43X1HZ" }
		
	mvcForm.submit();
}

function addThankyouCookie(){
			
}
function scrollToGrid(){

    $('html, body').animate({
        scrollTop: $("#grid_display").offset().top
    }, 2000);

}