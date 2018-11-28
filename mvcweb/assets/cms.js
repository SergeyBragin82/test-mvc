
$(document).ready(function () {
	// activate all editable fields

	$(".cms_editable").each(function(e) {
		var field = $(this);
		// set mouseover
		field.mouseover(function(e) {
			field.addClass("cms_editable_over");
		});
		
		// set mouseout
		field.mouseout(function(e) {
			field.removeClass("cms_editable_over");
		});

		field.click(function(e) {
			media = $(this).attr("data-media")
			switch(media) {
				case "string":
					activateStringEditor($(this))
				break;
				case "image":
					activateImageEditor($(this))
				break;
				case "carousel":
					activateCarouselEditor($(this))
				break;
			}
		});
	});

	$(".cms_approvable").each(function(e) {
		var field = $(this);
		field.click(function(e) {
			media = $(this).attr("data-media")
			switch(media) {
				case "string":
					activateStringApprove($(this))
				break;
				case "image":
					activateImageApprove($(this))
				break;
				case "carousel":
					activateCarouselApprove($(this))
				break;
			}
		});
	});

	$('#cms_string_editor').on('shown.bs.modal', function () {
	  $(this).find('.cms_new_string').trigger('focus')
	})

	$('#cms_response').on('hidden.bs.modal', function () {
	  window.location.href = window.location.href.split('?')[0];
	})
});


// STRINGS

function activateStringEditor(element) {
	activateEditor(element, "update", "string");
}

function activateStringApprove(element) {
	activateEditor(element, "approve", "string");
}

// IMAGES
function activateImageEditor(element) {
	activateEditor(element, "update", "image", {src: element.attr("src"), alt: element.attr("alt")});
}

function activateImageApprove(element) {
	activateEditor(element, "approve", "image", {src: element.attr("src"), alt: element.attr("alt")});
}

function activateEditor(element, ui, media, data) {
	var div;
	var submitText = "SUBMIT";
	var updateText = "";
	var currentText = "";
	var requestId = "";
	var currentImg = ""; 

	if (ui=="update") {
		
		if(media=="string") {
			div = "#cms_string_editor";
			currentText = updateText = element.html();			
		} else if (media=="image") {
			div = "#cms_image_editor";
			currentText = updateText = element.attr("alt");
			currentImg = element.attr("src");
		}

	} else if (ui=="approve") {
		submitText = "APPROVE";
		requestId = cms_request.id;
		if(media=="string") {
			div = "#cms_string_approve";
			currentText = updateText = cms_request.content_update;
		} else if (media=="image") {
			div = "#cms_image_approve";
			currentText = updateText = element.attr("alt");
			currentImg = cms_request.media_path;
		}

	}

	editor = $(div);

	// reset UI
	editor.find(".cms_comment").val("");
	editor.find(".cms_submit").html(submitText);
	editor.find(".cms_reject").css({display: "inline"});
	editor.find(".cms_comment_div").css({display: "none"});
	editor.find(".cms_current_string").html(currentText);
	editor.find(".cms_new_string").val(updateText);
	editor.find(".cms_image").attr("src", currentImg);


	/*
								action: "cms",
							content_id: element.attr("data-id"),
							new_content: editor.find(".cms_new_string").val(),
							existing_content: currentText,
							cms_action: ui,
							comment: element.find(".cms_comment").val(),
							pid: cms_page_id,
							link: window.location.href.split('?')[0],
							request_id: requestId, 
							data: data,
							media: media,
							file: $(".new_file")[0].files[0]
							*/

	// bind click events
	// The following code block sets up the UI to be either approved or rejected
	editor.find(".cms_submit").unbind("click");
	editor.find(".cms_submit").click(function(e) {
		$(this).attr("disabled", "disabled");

		var formData = new FormData();
		formData.append("action", "cms");
		formData.append("content_id", element.attr("data-id"));
		formData.append("new_content", editor.find(".cms_new_string").val());
		formData.append("existing_content", currentText);
		formData.append("cms_action", ui);
		formData.append("comment", element.find(".cms_comment").val());
		formData.append("pid", cms_page_id);
		formData.append("link", window.location.href.split('?')[0]);
		formData.append("request_id", requestId);
		formData.append("media", media);
		formData.append("file", document.getElementById("new_file").files[0]);

		  $.ajax({ 
		    xhrFields: {
		      withCredentials: true
		    },
		    type: "POST",
		    url: '/wp-admin/admin-post.php',
		    contentType: false,
		    processData: false,
		    data: formData,
		    success: function(result) {
		    	editor.modal("hide");

		    	var confirmMsg;

		    	if(ui=="approve") {
		    		confirmMsg = "Your CMS entry has been approved. The requester has been emailed and the change will take place upon the next publishing of the site.";	
		    	} else if (ui="update") {
		    		confirmMsg = "Your CMS entry has been submitted. The approvers have been emailed.";	
		    	}
		    	
		    	cmsConfirm(confirmMsg);
		    },
		  });
	});

	// The following code block adjusts the UI for rejecting the content update.
	editor.find(".cms_reject").unbind("click");
	editor.find(".cms_reject").click(function(e) {
		var comment = editor.find(".cms_comment_div");
		if(comment.css("display")=="none") {
			comment.css({display: "block"});
			comment.trigger('focus');
			editor.find(".cms_reject").css({display: "none"});
			editor.find(".cms_submit").html("SUBMIT REJECTION");
			editor.find(".cms_submit").unbind("click");
			editor.find(".cms_submit").click(function(e) {
				$(this).attr("disabled", "disabled");
				cms_api = api('/wp-admin/admin-post.php', "POST", {
									action: "cms",
									content_id: element.attr("data-id"),
									new_content: editor.find(".cms_new_string").val(),
									existing_content: element.html(),
									cms_action: "reject",
									comment: element.find(".cms_comment").val(),
									pid: cms_page_id,
									link: window.location.href.split('?')[0],
									request_id: requestId, 
									data: data
				}, function (result) {
					editor.modal("hide");
					cmsConfirm("You have rejected this CMS entry. The requester has been emailed.");
				});
			});
		} 
	});
	
	editor.modal("show");
}

function cmsConfirm(msg) {
	confirm = $("#cms_response");
	confirm.find(".cms_response_body").html(msg);
	confirm.modal("show");

}

// util functions

function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if (decodeURIComponent(pair[0]) == variable) {
            return decodeURIComponent(pair[1]);
        }
    }
}

function editMode() {
	window.location.href = window.location.href + "?mode=edit";
}