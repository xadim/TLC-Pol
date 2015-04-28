<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<?php 

                    $home= "http://tlcpolitical.com/";
                    $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
                    if ($monUrl==$home)
                    {
                        //$footerClass = "footercontainer";
                        $footerClass = "footerPageIn";
                    }
                    else
                    {
                        $footerClass = "footerPageIn";
                    }
?>

		<div class="<?php echo $footerClass; ?>">
			<div class="row child">
				<div class="col-md-12">
 					<a class="twitter" href="https://twitter.com/LukensPolitico" target="_blank"><img src="http://designsabove.com/tlcpolitical/wp-content/themes/twentythirteen/images/twitter.png"></a>
 					<a class="linkedin" href="http://www.linkedin.com/company/1221888" target="_blank"><img src="http://designsabove.com/tlcpolitical/wp-content/themes/twentythirteen/images/linkedin.png"></a>
 					<a class="google" href="https://www.google.com/partners/#h" target="_blank"><img src="http://designsabove.com/tlcpolitical/wp-content/themes/twentythirteen/images/google.png"></a>
 					<a class="dma" href="http://thedma.org/" target="_blank"><img src="http://designsabove.com/tlcpolitical/wp-content/themes/twentythirteen/images/dma.png"></a>
 				</div>
 				<div class="col-md-12 center menu"><?php //get_sidebar( 'main' ); ?>
							<?php wp_nav_menu( array('menu_class' => 'nav-menu' ) ); ?>	
 				</div>
 				<div class="col-md-12 footerFronttxt">© 2014 THE LUKENS COMPANY ALL RIGHTS RESERVED.</div>
    	    </div>
      		
      	</div>

	<?php wp_footer(); ?>
    <script>
    (function() {

        // Create input element for testing
        var inputs = document.createElement('input');
        
        // Create the supports object
        var supports = {};
        
        supports.autofocus   = 'autofocus' in inputs;
        supports.required    = 'required' in inputs;
        supports.placeholder = 'placeholder' in inputs;
    
        // Fallback for autofocus attribute
        if(!supports.autofocus) {
            
        }
        
        // Fallback for required attribute
        if(!supports.required) {
            
        }
    
        // Fallback for placeholder attribute
        if(!supports.placeholder) {
            
        }
        
        // Change text inside send button on submit
        var send = document.getElementById('contact-submit');
        if(send) {
            var dataText = send.getAttribute('data-text');
            send.onclick = function() {
                send.innerHTML = dataText;
            }
        }
    
    })();
    </script>
    
    
    <script type="text/javascript" src="<?php bloginfo("template_url"); ?>/js/front.js"></script>
</body>
</html>