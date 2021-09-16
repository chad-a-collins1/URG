/*!
 * jQuery JavaScript Custom library
 *
 * Date: Thu Nov 30 2012   
 */

$(document).ready(function() {

	if ((typeof DoUserExit) != null && (typeof DoUserExit) != "undefined" )
	{
		DoUserExit("OnBeforeReady",null);
	}

	// Converted from lookuplink.htc 12/2/2012 by RRB
	// ShowLookupDlg function is in /..js/Behaviors.js
	//------------------------------------------------
	$("body").on('click',".lnkLookup,.slnkLookup,.lnkDead,.lnkLookup_JQSelector",LookupLink);
	$("body").on('click', "BUTTON.LookUpButton", LookupLink);
	
	function LookupLink(e) {
		var evt;

		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
		ShowLookupDlg($(this).attr("TargetInput"),
			      $(this).attr("LookupTable"),
			      $(this).attr("LookupHeight"),
			      $(this).attr("LookupWidth"),
			      $(this).attr("ParentTable"),
			      $(this).attr("FilterBy"),
			      evt
			      );
	}

	// Converted from DialogView.htc 12/9/2012 by RRB
	// ShowLookupDlgView function is in /..js/Behaviors.js
	//----------------------------------------------------
	$("body").on('click',".lnkView,.ButtonlnkView",DialogView);

	function DialogView(e) {
		var evt;

		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
alert("DialogView.htc conversion not tested yet");
		ShowLookupDlgView($(this).attr("TargetInput"),
				  $(this).attr("LookupTable"),
				  $(this).attr("LookupHeight"),
				  $(this).attr("LookupWidth"),
				  evt
				  );
	}
	

	// Converted from DialogLargeView.htc 12/14/2012 by RRB
	// ShowLookupDlgLargeView function is in /..js/Behaviors.js
	//---------------------------------------------------------
	$("body").on('click',".ButtonlargelnkView",DialogLargeView);
	
	function DialogLargeView(e) {
		var evt;

		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
alert("DialogLargeView.htc conversion not tested yet");
		ShowLookupDlgLargeView($(this).attr("TargetInput"),
				       $(this).attr("LookupTable"),
				       $(this).attr("LookupHeight"),
				       $(this).attr("LookupWidth"),
				       evt
				       );
	}
	

	// Converted from Dynlookuplink.htc 12/14/2012 by RRB
	// ShowDynLookupDlg function is in /..js/Behaviors.js
	//---------------------------------------------------
	$("body").on('click',".lnkLookupDyn",DynLookupLink);
	$("body").on('click',"BUTTON.LookUpButton",DynLookupLink);
	
	function DynLookupLink(e) {
		var evt;

		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
alert("Dynlookuplink.htc conversion not tested yet");
		ShowDynLookupDlg($(this).attr("TargetInput"),
			      	 $(this).attr("LookupSQL"),
			      	 $(this).attr("LookupHeight"),
			      	 $(this).attr("LookupWidth"),
			      	 $(this).attr("ParentTable"),
				 evt
			      	);
	}
	

	// Converted from Commentlink.htc 12/14/2012 by RRB
	// ShowCommentLookupDlg function is in /..js/Behaviors.js
	//-------------------------------------------------------
	$("body").on('click',".lnkComment",commentLookupLink);
	
	function commentLookupLink(e) {
		var evt;

		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
		ShowCommentLookupDlg($(this).attr("TargetInput"),
			      	     $(this).attr("ParentTable"),
			      	     $(this).attr("FilterBy"),
				     evt
			      	    );
	}
	
	// Set cursor position when cursor is onblur from report comment textarea [LIMS-REQ-716]
	// setTxtCursor functions are in /..js/Behaviors.js
	//-----------------------------------------------------------------------
	$("body").on('blur', "textarea", function(event) { setTxtCursor($(this).attr("id"),event); });
	
	// Converted from maxlength.htc 12/9/2012 by RRB
	// doKeypress, doBeforePaste, doPaste functions are in /..js/Behaviors.js
	//-----------------------------------------------------------------------
	$("body").on('keypress', "TEXTAREA", function(event) { doKeypress($(this).attr("maxLength"), $(this).attr("ID"),event); });
	$("body").on('beforepaste', "TEXTAREA", function(event) { doBeforePaste($(this).attr("maxLength"),event); });
	$("body").on('paste', "TEXTAREA", function(event) {
     					var self = this;
					var maxLength = $(this).attr("maxLength");
					var txtID = $(this).attr("ID");
					//Allow enough time for the paste to populate the text area
          				event.returnValue = setTimeout(function(e) {
							var evt;

							if(typeof event != "undefined"){
								evt = event;
							}else{
								evt = e;
							}
							doPaste(maxLength, txtID, $(self).val(),evt);
          							   }, 0);
						});
	

	// Converted from LoadIframe.htc 12/15/2012 by RRB
	// ShowLoadIframe function is in /..js/Behaviors.js
	//-------------------------------------------------------
	$("body").on('click',".LoadIframe_JQSelector", LoadIframe);
	
	function LoadIframe(e) {
		var evt;

		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
alert("LoadIframe.htc conversion not tested yet");
		ShowLoadIframe($(this).attr("LoadURL"),
			       $(this).attr("ID"),
			       evt
			      );
	}


	// Converted from paramaudit.htc 12/16/2012 by RRB
	// PerformAudit function is in /..js/Behaviors.js  
	//------------------------------------------------------- "TD.AuditCell,TH.AuditCell,TD.AuditTrail,TH.AuditTrail"
	$("body").on('click',"TD,TH", paramaudit);
	
	function paramaudit(e) {
		var evt;
		//alert("paramaudit here");
		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
	//alert($(this).attr("class"));
	// add if only look for TD and TH, also add params to PerformAudit DS 10/21/13
	if($(this).attr("class") == "auditcell" || $(this).attr("class") == "audittrail"){
		//alert("paramaudit.htc conversion not tested yet");
		//alert(  $(this).attr("TESTID"));
		PerformAudit($(this).attr("LocationID"),
				$(this).attr("SAMPLEID"),
			     $(this).attr("TESTID"),
			     $(this).attr("MASTERPARAMETERID"),
				 $(this).attr("RUNID"),
			     evt
			     );
		}
	}	


	// Converted from DynExportToExcel.htc 12/17/2012 by RRB
	// ShowDynExportToExcel function is in /..js/Behaviors.js
	//-------------------------------------------------------
	$("body").on('click',"BUTTON.DynExportToExcelButton",DynExportToExcel);
	
	function DynExportToExcel(e) {
		var evt;

		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
alert("DynExportToExcel.htc conversion not tested yet");
		ShowDynExportToExcel($(this).attr("Show"),
				     $(this).attr("Print"),
				     $(this).attr("TableName"),
				     $(this).attr("SQL"),
				     $(this).attr("Template"),
				     $(this).attr("ExeOnServer"),
				     $(this).attr("PDFFileName"),
				     evt
				     );
	}


	// Converted from rptlookuplink.htc 12/18/2012 by RRB
	// ShowRptLookupDlg function is in /..js/Behaviors.js
	//---------------------------------------------------
	$("body").on('click',".lnkLookupRPT",RptLookupLink);

	function RptLookupLink(e) {
		var evt;
		
		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
		ShowRptLookupDlg($(this).attr("TargetInput"),
			         $(this).attr("LookupTable"),
			         $(this).attr("LookupHeight"),
			         $(this).attr("LookupWidth"),
			         $(this).attr("ParentTable"),
			         $(this).attr("FilterBy"),
				 evt
			         );
		return false;
	}
	

	// Converted from QueJob.htc 12/20/2012 by RRB
	// DoQueJob function is in /..js/Behaviors.js
	//-------------------------------------------------------
	$("body").on('click',"BUTTON.QueJob",QueJob);
	
	function QueJob(e) {
		var evt;

		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
alert("QueJob.htc conversion not tested yet");
		DoQueJob(evt);
	}


	// Converted from audit.htc 12/22/2012 by RRB
	// GoToGlobalAudit function is in /..js/Behaviors.js
	//---------------------------------------------------
	$("body").on('click',"BUTTON.GlobalAuditButton",
		function(e) {
			Audit(e, this);
			e.preventDefault();
		}
	);

	function Audit(e, btn) {
		var evt;

		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}

		GoToGlobalAudit($(btn).attr("PrimaryKey"),
				$(btn).attr("PrimaryKey2"),
				$(btn).attr("TableName"),
				evt
		        );
	}
	

	// Converted from DocAction.htc 12/28/2012 by RRB
	// DoDocAction function is in /..js/Behaviors.js
	//---------------------------------------------------
	$("body").on('click',"BUTTON.DocAction",DocAction);

	function DocAction(e) {
		var evt;

		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
alert("DocAction.htc conversion not tested yet");
		DoDocAction($(this).attr("Doc"),
			    $(this).attr("RefInfoGroup"),
			    evt
			    );
	}
	
	// Converted from FileUpload.htc 03.19.2013 by RRB
	// ShowFileUploadDlg function is in /..js/Behaviors.js
	//----------------------------------------------------
	$("body").on("onfileexists", "IMG[FileName]", function (e, oEvt) {return true;});
	$("body").on("onfilechanged", "IMG[FileName]", function (e, oEvt) {return true;});
	$("body").on("onfileupload", "IMG[FileName]", function (e, oEvt) {return true;});
	$("body").on('click',"IMG", FileUpload);
	function FileUpload(e) {
		var evt;
		//alert("fileupload custom.js");
		if(typeof event != "undefined"){
			evt = event;
		}else{
			evt = e;
		}
	
		if($(this).attr("FileName") != undefined){
			ShowFileUploadDlg($(this).attr("FileName"),
				      	  $(this).attr("FilePath"),
				      	  $(this).attr("TargetInput"),
				      	  $(this).attr("TargetSpan"),
					  evt
				      	  );
		}
		
		//added by JD 11/23/2013 to support signature entries from pad
		if($(this).attr("Signature") != undefined){
			ShowSigPadTopazDlg($(this).attr("FilePath"),
				$(this).attr("TargetInput"),
				$(this).attr("TargetSpan"),
				evt
				);
		}
	}
	
	$('body').on('click', 'a[href^="#"]', function (e) {
        e.preventDefault();

        var target = this.hash;
        var $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': ($target.offset().top-60)
        }, 500, 'swing');
    });

    if ((typeof DoUserExit) != null && (typeof DoUserExit) != "undefined" )
    {
        DoUserExit("OnAfterReady",null);
    }
});