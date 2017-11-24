<?php 
/**
* Searching
* TO-DO: Move to individual files
* @return Requested data from parent
* @link https://tutorialrepublic.com/php-tutorial/php-mysql-ajax-livesearch.php
**/
session_start();
require_once( '../init.php' );
require_once( '../load.php' );
require_once( 'header.php' ); ?>
<div class="mdl-grid">

	<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
	<div class="mdl-cell mdl-cell--12-col mdl-grid <?php primaryColor(); ?>">
        <div class="mdl-cell mdl-cell--10-col input-field inline">
          <i class="material-icons prefix">perm_identity</i>
          <input type="text" id="term" name="search" placeholder="Type And Click The Search Button">
          <label for="number">Term To Search</label>
        </div>
          <div class="mdl-cell mdl-cell--10-col white results" id="results"></div>
      </div>
</div>
<?php

if ( isset( $_REQUEST['search'] ) ) {
	//$table = strtoupper( $_REQUEST['table'] );
	$results = $GLOBALS['POSTS'] -> search( $_REQUEST['search'] );
	if ( $results['status'] !== "fail" ) {
		foreach ( $results as $result ) {
			echo( $result );
		}
	}
}
require_once( 'footer.php' );