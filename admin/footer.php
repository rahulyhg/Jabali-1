<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Admin Footer
* @author Mauko Maunde < hi@mauko.co.ke >
* @since 0.17.04
* @link https://docs.jabalicms.org/dashboard/
**/
if ( !isset($_SESSION) ) { session_start(); } ?>
</main>
<footer class="mdl-footer <?php primaryColor(); ?>">
	<div style="float:left;padding-left:20px;"><?php showOption( 'adfooter' ); ?></div>
	<span style="float:right;padding-right:20px;"><?php theAttribution(); ?></span>
</footer>
<script type="text/javascript">
	$('#alert_close').click(function(){
    $( "#alert_box" ).fadeOut( "slow", function() {
    });
  });

$(document).ready(function(){
  $('.carousel').carousel();
});
        
</script>
<script type="text/javascript">
  function dragStartH(ev) {
    console.log( "dragStart");

    ev.dataTransfer.setData("text/plain", ev.target.id );
  }

  function dragOverH(ev) {
    ev.preventDefault();
    ev.dataTransfer.dropEffect = "move";
  }

  function dropH(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
  }

  // $(function() {
  //   $('.sortable').sortable({
  //       axis: 'y',
  //       opacity: 0.7,
  //       handle: 'span',
  //       update: function(event, ui) {
  //           var list_sortable = $(this).sortable('toArray').toString();
  //       // change order in the database using Ajax
  //           $.ajax({
  //               url: 'index.php',
  //               type: 'POST',
  //               data: {list_order:list_sortable},
  //               success: function(data) {
  //                   //finished
  //               }
  //           });
  //       }
  //   }); // fin sortable
  // });
</script>
<script>
  // Hook up ACE editor to all textareas with data-editor attribute
  // Mode and theme are loaded fron text area attributes
$(function() {
  $('textarea[data-editor]').each(function() {
    var textarea = $(this);
    var mode = textarea.data('editor');
    var theme = textarea.data('theme');
    var editDiv = $('<div>', {
      position: 'absolute',
      width: textarea.width(),
      height: textarea.height(),
      'class': textarea.attr('class')
    }).insertBefore(textarea);
    textarea.css('display', 'none');
    var editor = ace.edit(editDiv[0]);
    editor.renderer.setShowGutter(textarea.data('gutter'));
    editor.getSession().setValue(textarea.val());
    editor.getSession().setMode("ace/mode/" + mode);
    editor.setTheme("ace/theme/" + theme );

    // copy back to textarea on form submit...
    textarea.closest('form').submit(function() {
      textarea.val(editor.getSession().getValue());
    })
  });
});
</script>
<script src="<?php echo _SCRIPTS ?>d3.js"></script>
<script src="<?php echo _SCRIPTS ?>getmdl-select.min.js"></script>
<script src="<?php echo _SCRIPTS ?>material.js"></script>
<script src="<?php echo _SCRIPTS ?>materialize.js"></script>
<script src="<?php echo _SCRIPTS ?>nv.d3.js"></script>
<script src="<?php echo _SCRIPTS ?>sort-table.js"></script>
<script src="<?php echo _SCRIPTS ?>widgets/line-chart/line-chart-nvd3.js"></script>
<script src="<?php echo _SCRIPTS ?>widgets/pie-chart/pie-chart-nvd3.js"></script>
<script src="<?php echo _SCRIPTS ?>widgets/table/table.js"></script>
<script src="<?php echo _SCRIPTS ?>widgets/todo/todo.js"></script>
</div>
</body>
</html>