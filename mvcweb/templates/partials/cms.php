<?php
    function cms_h1($id, $class="", $attrs=[]) { return cms('h1', $id, $class, $attrs); }
    function cms_h2($id, $class="", $attrs=[]) { return cms('h2', $id, $class, $attrs); }
    function cms_h3($id, $class="", $attrs=[]) { return cms('h3', $id, $class, $attrs); }
    function cms_h4($id, $class="", $attrs=[]) { return cms('h4', $id, $class, $attrs); }
    function cms_div($id, $class="", $attrs=[]) { return cms('div', $id, $class, $attrs); }
    function cms_span($id, $class="", $attrs=[]) { return cms('span', $id, $class, $attrs); }
    function cms_p($id, $class="", $attrs=[]) { return cms('p', $id, $class, $attrs); }
    
    function cms($tag, $id, $class, $attrs) {

    	$content = $GLOBALS["context"]->xpath("//string[@id='" . $id ."']")[0];

      // XPATH support (advanced users only)
      if (substr($content, 0, 5)==="xpath:") {
        $content = $GLOBALS["context"]->xpath(str_replace("xpath:", "", $content))[0];
      }

    	if($_GET["mode"]=="edit") {
            $class .= " cms_editable";
    	} else if ($_GET["mode"]=="approve" && $id==$_GET["content_id"]) {
            $class .= " cms_approvable";
      }

      $attr_str = " ";

      foreach($attrs as $key => $value) {
        $attr_str = $key . "='" . $value . "'";
      }

      $attr_str .= " ";

      return "<" . $tag . $attr_str . " class='" . $class . "' data-media='string' data-id='" . $id . "'>" . $content . "</" . $tag . ">";
    }

    function cms_img($id, $class) {
      $content = $GLOBALS["context"]->xpath("//string[@id='" . $id ."']")[0];
      if($_GET["mode"]=="edit") {
            $class .= " cms_editable";
      } else if ($_GET["mode"]=="approve" && $id==$_GET["content_id"]) {
            $class .= " cms_approvable";
      } 

      $path = $content->xpath("@url")[0];
      if(substr($path, 0, 4)!="http") {
        $path = $GLOBALS['img_path'] .  $path;
      }

      return "<img src='" . $path . "' data-media='image' data-id='" . $id . "' alt='" . $content . "' class='" . $class . "'/>";
    }

    function cms_img_lazy($id, $class) {
      $content = $GLOBALS["context"]->xpath("//string[@id='" . $id ."']")[0];
      if($_GET["mode"]=="edit") {
            $class .= " cms_editable";
      } else if ($_GET["mode"]=="approve" && $id==$_GET["content_id"]) {
            $class .= " cms_approvable";
      } 

      $path = $content->xpath("@url")[0];
      if(substr($path, 0, 4)!="http") {
        $path = $GLOBALS['img_path'] .  $path;
      }

      return "<img data-lazy='" . $path . "' data-media='image' data-id='" . $id . "' data-alt='" . $content . "' class='" . $class . "'/>";
    }

  if ( in_array( 'author', (array) $user->roles ) ) {
      $can_edit = true;
  }

  if (is_super_admin() || in_array( 'editor', (array) $user->roles ) || is_super_admin() ) {
    $can_edit = true;
    $can_approve = true;
  }

  if($can_edit||$can_approve) {
?>
<script type="text/javascript">
    var cms_page_id = "<?php echo get_the_ID(); ?>";
    <?php if ($_GET["request_id"]) {
        $request = get_option("MVC_CMS_REQUEST_" . $_GET["request_id"]);
        ?>var cms_request = <?php echo $request; ?>;<?php
    }?>
</script>
<div id="cms_toolbar">
  <a href="javascript:editMode();">Edit</a><br/>
</div>

<div id="cms_string_editor" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit String Text</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <!-- also make available shortcuts in xpath like current resort name -->
        <span><b>Current Text: </b></span><br/><span class="cms_current_string"></span><br/>
        <span><b>New Text:</b></span><br/>
        <textarea rows="4" class="w-100 cms_new_string"></textarea>
        <a class="marriott-btn cms_submit">SUBMIT</a> <a class="btn" aria-label="Close" data-dismiss="modal">CANCEL</a>
    </div>
  </div>
</div>
</div>
<div id="cms_string_approve" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Approve String Text Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <!-- also make available shortcuts in xpath like current resort name -->
        <span><b>Current Text: </b></span><br/><span class="cms_current_string"></span><br/>
        <span><b>New Text:</b> (make edits as necessary)</span><br/>
        <textarea rows="4" class="w-100 cms_new_string"></textarea>
        <div class="cms_comment_div" style="display:none">
            <span><b>Rejection Comment:</b></span><br/>
            <textarea rows="4" class="w-100 cms_comment"></textarea>
        </div>
        <a class="marriott-btn cms_submit">APPROVE</a> <a class="marriott-btn cms_reject">REJECT</a> <a class="btn" aria-label="Close" data-dismiss="modal">CANCEL</a>
    </div>
  </div>
</div>
</div>

<!-- IMAGES UI -->
<div id="cms_image_editor" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <img class="cms_image img-fluid" height="300" src=""/>
        </div>
        <!-- also make available shortcuts in xpath like current resort name -->
        <span><b>New Image File: </b></span><br/>
        <input type="file" name="new_file" class="w-100 new_file" id="new_file"/><br/><br/>
        <span><b>Current Alt Text: </b></span><br/><span class="cms_current_string"></span><br/><br/>
        <span><b>New Alt Text:</b></span><br/>
        <textarea rows="4" class="w-100 cms_new_string"></textarea>
        <a class="marriott-btn cms_submit">SUBMIT</a> <a class="btn" aria-label="Close" data-dismiss="modal">CANCEL</a>
    </div>
  </div>
</div>
</div>

<div id="cms_image_approve" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Approve Image Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <img class="cms_image img-fluid" height="300" src=""/>
        </div>
            <!-- also make available shortcuts in xpath like current resort name -->
        <span><b>Current Alt Text: </b></span><br/><span class="cms_current_string"></span><br/>
        <span><b>New Alt Text:</b> (make edits as necessary)</span><br/>
        <textarea rows="4" class="w-100 cms_new_string"></textarea>
        <div class="cms_comment_div" style="display:none">
            <span><b>Rejection Comment:</b></span><br/>
            <textarea rows="4" class="w-100 cms_comment"></textarea>
        </div>
        <a class="marriott-btn cms_submit">APPROVE</a> <a class="marriott-btn cms_reject">REJECT</a> <a class="btn" aria-label="Close" data-dismiss="modal">CANCEL</a>
    </div>
  </div>
</div>
</div>

<div id="cms_response" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">CMS Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="cms_response_body"></span>        
    </div>
  </div>
</div>
</div>
<?php 
  }
?>