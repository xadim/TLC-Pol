<?php

class CP_ContactFormToEmail extends CP_CFTEMAIL_BaseClass {

    private $menu_parameter = 'cp_contactformtoemail';
    private $prefix = 'cp_contactformtoemail';
    private $plugin_name = 'Contact Form to Email';
    private $plugin_URL = 'http://wordpress.dwbooster.com/forms/contact-form-to-email';
    protected $table_items = "cftemail_forms";
    private $table_messages = "cftemail_messages";
    private $print_counter = 1;
    private $include_user_data_csv = false;

    public $shorttag = 'CONTACT_FORM_TO_EMAIL';

    function _install() {
        global $wpdb;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $results = $wpdb->get_results("SHOW TABLES LIKE '".$wpdb->prefix.$this->table_messages."'");
        if (!count($results))
        {
            $sql = "CREATE TABLE ".$wpdb->prefix.$this->table_messages." (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                formid INT NOT NULL,
                time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
                ipaddr VARCHAR(32) DEFAULT '' NOT NULL,
                notifyto VARCHAR(250) DEFAULT '' NOT NULL,
                data text,
                posted_data text,
                UNIQUE KEY id (id)
            );";
            $wpdb->query($sql);
        }

        $results = $wpdb->get_results("SHOW TABLES LIKE '".$wpdb->prefix.$this->table_items."'");
        if (!count($results))
        {
            $sql = "CREATE TABLE ".$wpdb->prefix.$this->table_items." (
                 id mediumint(9) NOT NULL AUTO_INCREMENT,

                 form_name VARCHAR(250) DEFAULT '' NOT NULL,

                 form_structure text,

                 fp_from_email VARCHAR(250) DEFAULT '' NOT NULL,
                 fp_destination_emails text,
                 fp_subject VARCHAR(250) DEFAULT '' NOT NULL,
                 fp_inc_additional_info VARCHAR(10) DEFAULT '' NOT NULL,
                 fp_return_page VARCHAR(250) DEFAULT '' NOT NULL,
                 fp_message text,
                 fp_emailformat VARCHAR(10) DEFAULT '' NOT NULL,

                 cu_enable_copy_to_user VARCHAR(10) DEFAULT '' NOT NULL,
                 cu_user_email_field VARCHAR(250) DEFAULT '' NOT NULL,
                 cu_subject VARCHAR(250) DEFAULT '' NOT NULL,
                 cu_message text,
                 cu_emailformat VARCHAR(10) DEFAULT '' NOT NULL,
                 fp_emailfrommethod VARCHAR(10) DEFAULT '' NOT NULL,

                 vs_use_validation VARCHAR(10) DEFAULT '' NOT NULL,
                 vs_text_is_required VARCHAR(250) DEFAULT '' NOT NULL,
                 vs_text_is_email VARCHAR(250) DEFAULT '' NOT NULL,
                 vs_text_datemmddyyyy VARCHAR(250) DEFAULT '' NOT NULL,
                 vs_text_dateddmmyyyy VARCHAR(250) DEFAULT '' NOT NULL,
                 vs_text_number VARCHAR(250) DEFAULT '' NOT NULL,
                 vs_text_digits VARCHAR(250) DEFAULT '' NOT NULL,
                 vs_text_max VARCHAR(250) DEFAULT '' NOT NULL,
                 vs_text_min VARCHAR(250) DEFAULT '' NOT NULL,
                 vs_text_submitbtn VARCHAR(250) DEFAULT '' NOT NULL,
                 vs_text_previousbtn VARCHAR(250) DEFAULT '' NOT NULL,
                 vs_text_nextbtn VARCHAR(250) DEFAULT '' NOT NULL,                 

                 rep_enable VARCHAR(10) DEFAULT '' NOT NULL,
                 rep_days VARCHAR(10) DEFAULT '' NOT NULL,
                 rep_hour VARCHAR(10) DEFAULT '' NOT NULL,
                 rep_emails text,
                 rep_subject text,
                 rep_emailformat VARCHAR(10) DEFAULT '' NOT NULL,
                 rep_message text,

                 cv_enable_captcha VARCHAR(20) DEFAULT '' NOT NULL,
                 cv_width VARCHAR(20) DEFAULT '' NOT NULL,
                 cv_height VARCHAR(20) DEFAULT '' NOT NULL,
                 cv_chars VARCHAR(20) DEFAULT '' NOT NULL,
                 cv_font VARCHAR(20) DEFAULT '' NOT NULL,
                 cv_min_font_size VARCHAR(20) DEFAULT '' NOT NULL,
                 cv_max_font_size VARCHAR(20) DEFAULT '' NOT NULL,
                 cv_noise VARCHAR(20) DEFAULT '' NOT NULL,
                 cv_noise_length VARCHAR(20) DEFAULT '' NOT NULL,
                 cv_background VARCHAR(20) DEFAULT '' NOT NULL,
                 cv_border VARCHAR(20) DEFAULT '' NOT NULL,
                 cv_text_enter_valid_captcha VARCHAR(200) DEFAULT '' NOT NULL,

                 UNIQUE KEY id (id)
            );";
            $wpdb->query($sql);
        }

        // insert initial data
        $count = $wpdb->get_var(  "SELECT COUNT(id) FROM ".$wpdb->prefix.$this->table_items  );
        if (!$count)
        {
            define('CP_CFEMAIL_DEFAULT_fp_from_email', get_the_author_meta('user_email', get_current_user_id()) );
            define('CP_CFEMAIL_DEFAULT_fp_destination_emails', CP_CFEMAIL_DEFAULT_fp_from_email);
            $wpdb->insert( $wpdb->prefix.$this->table_items, array( 'id' => 1,
                                      'form_name' => 'Form 1',

                                      'form_structure' => $this->get_option('form_structure', CP_CFEMAIL_DEFAULT_form_structure),

                                      'fp_from_email' => $this->get_option('fp_from_email', CP_CFEMAIL_DEFAULT_fp_from_email),
                                      'fp_destination_emails' => $this->get_option('fp_destination_emails', CP_CFEMAIL_DEFAULT_fp_destination_emails),
                                      'fp_subject' => $this->get_option('fp_subject', CP_CFEMAIL_DEFAULT_fp_subject),
                                      'fp_inc_additional_info' => $this->get_option('fp_inc_additional_info', CP_CFEMAIL_DEFAULT_fp_inc_additional_info),
                                      'fp_return_page' => $this->get_option('fp_return_page', CP_CFEMAIL_DEFAULT_fp_return_page),
                                      'fp_message' => $this->get_option('fp_message', CP_CFEMAIL_DEFAULT_fp_message),
                                      'fp_emailformat' => $this->get_option('fp_emailformat', CP_CFEMAIL_DEFAULT_email_format),

                                      'cu_enable_copy_to_user' => $this->get_option('cu_enable_copy_to_user', CP_CFEMAIL_DEFAULT_cu_enable_copy_to_user),
                                      'cu_user_email_field' => $this->get_option('cu_user_email_field', CP_CFEMAIL_DEFAULT_cu_user_email_field),
                                      'cu_subject' => $this->get_option('cu_subject', CP_CFEMAIL_DEFAULT_cu_subject),
                                      'cu_message' => $this->get_option('cu_message', CP_CFEMAIL_DEFAULT_cu_message),
                                      'cu_emailformat' => $this->get_option('cu_emailformat', CP_CFEMAIL_DEFAULT_email_format),

                                      'vs_use_validation' => $this->get_option('vs_use_validation', CP_CFEMAIL_DEFAULT_vs_use_validation),
                                      'vs_text_is_required' => $this->get_option('vs_text_is_required', CP_CFEMAIL_DEFAULT_vs_text_is_required),
                                      'vs_text_is_email' => $this->get_option('vs_text_is_email', CP_CFEMAIL_DEFAULT_vs_text_is_email),
                                      'vs_text_datemmddyyyy' => $this->get_option('vs_text_datemmddyyyy', CP_CFEMAIL_DEFAULT_vs_text_datemmddyyyy),
                                      'vs_text_dateddmmyyyy' => $this->get_option('vs_text_dateddmmyyyy', CP_CFEMAIL_DEFAULT_vs_text_dateddmmyyyy),
                                      'vs_text_number' => $this->get_option('vs_text_number', CP_CFEMAIL_DEFAULT_vs_text_number),
                                      'vs_text_digits' => $this->get_option('vs_text_digits', CP_CFEMAIL_DEFAULT_vs_text_digits),
                                      'vs_text_max' => $this->get_option('vs_text_max', CP_CFEMAIL_DEFAULT_vs_text_max),
                                      'vs_text_min' => $this->get_option('vs_text_min', CP_CFEMAIL_DEFAULT_vs_text_min),
                                      'vs_text_submitbtn' => $this->get_option('vs_text_submitbtn', 'Submit'),
                                      'vs_text_previousbtn' => $this->get_option('vs_text_previousbtn', 'Previous'),
                                      'vs_text_nextbtn' => $this->get_option('vs_text_nextbtn', 'Next'),                                      

                                      'rep_enable' => $this->get_option('rep_enable', 'no'),
                                      'rep_days' => $this->get_option('rep_days', '1'),
                                      'rep_hour' => $this->get_option('rep_hour', '0'),
                                      'rep_emails' => $this->get_option('rep_emails', ''),
                                      'rep_subject' => $this->get_option('rep_subject', 'Submissions report...'),
                                      'rep_emailformat' => $this->get_option('rep_emailformat', 'text'),
                                      'rep_message' => $this->get_option('rep_message', 'Attached you will find the data from the form submissions.'),

                                      'cv_enable_captcha' => $this->get_option('cv_enable_captcha', CP_CFEMAIL_DEFAULT_cv_enable_captcha),
                                      'cv_width' => $this->get_option('cv_width', CP_CFEMAIL_DEFAULT_cv_width),
                                      'cv_height' => $this->get_option('cv_height', CP_CFEMAIL_DEFAULT_cv_height),
                                      'cv_chars' => $this->get_option('cv_chars', CP_CFEMAIL_DEFAULT_cv_chars),
                                      'cv_font' => $this->get_option('cv_font', CP_CFEMAIL_DEFAULT_cv_font),
                                      'cv_min_font_size' => $this->get_option('cv_min_font_size', CP_CFEMAIL_DEFAULT_cv_min_font_size),
                                      'cv_max_font_size' => $this->get_option('cv_max_font_size', CP_CFEMAIL_DEFAULT_cv_max_font_size),
                                      'cv_noise' => $this->get_option('cv_noise', CP_CFEMAIL_DEFAULT_cv_noise),
                                      'cv_noise_length' => $this->get_option('cv_noise_length', CP_CFEMAIL_DEFAULT_cv_noise_length),
                                      'cv_background' => $this->get_option('cv_background', CP_CFEMAIL_DEFAULT_cv_background),
                                      'cv_border' => $this->get_option('cv_border', CP_CFEMAIL_DEFAULT_cv_border),
                                      'cv_text_enter_valid_captcha' => $this->get_option('cv_text_enter_valid_captcha', CP_CFEMAIL_DEFAULT_cv_text_enter_valid_captcha)
                                     )
                      );
        }
    }


    /* Filter for placing the maps into the contents */
    public function filter_content($atts) {
        global $wpdb;
        extract( shortcode_atts( array(
    		                           'id' => '',
    	                        ), $atts ) );
        if ($id != '')
            $this->item = $id;
        ob_start();
        $this->insert_public_item();
        $buffered_contents = ob_get_contents();
        ob_end_clean();
        return $buffered_contents;
    }


    function insert_public_item() {
        global $wpdb;
        
        $previous_label = $this->get_option('vs_text_previousbtn', 'Previous');
        $previous_label = ($previous_label==''?'Previous':$previous_label);
        $next_label = $this->get_option('vs_text_nextbtn', 'Next');
        $next_label = ($next_label==''?'Next':$next_label);  
        
        if (CP_CFEMAIL_DEFER_SCRIPTS_LOADING)
        {
            wp_deregister_script('query-stringify');
            wp_register_script('query-stringify', plugins_url('/js/jQuery.stringify.js', __FILE__));

            wp_deregister_script($this->prefix.'_validate_script');
            wp_register_script($this->prefix.'_validate_script', plugins_url('/js/jquery.validate.js', __FILE__));

            wp_enqueue_script( $this->prefix.'_builder_script',
               plugins_url('/js/fbuilderf.jquery.js', __FILE__),array("jquery","jquery-ui-core","jquery-ui-datepicker","jquery-ui-widget","jquery-ui-position","jquery-ui-tooltip","query-stringify",$this->prefix."_validate_script"), false, true );

            wp_localize_script($this->prefix.'_builder_script', $this->prefix.'_fbuilder_config'.('_'.$this->print_counter), array('obj' =>
            '{"pub":true,"identifier":"'.('_'.$this->print_counter).'","messages": {
            	                	"required": "'.str_replace(array('"'),array('\\"'),$this->get_option('vs_text_is_required', CP_CFEMAIL_DEFAULT_vs_text_is_required)).'",
            	                	"email": "'.str_replace(array('"'),array('\\"'),$this->get_option('vs_text_is_email', CP_CFEMAIL_DEFAULT_vs_text_is_email)).'",
            	                	"datemmddyyyy": "'.str_replace(array('"'),array('\\"'),$this->get_option('vs_text_datemmddyyyy', CP_CFEMAIL_DEFAULT_vs_text_datemmddyyyy)).'",
            	                	"dateddmmyyyy": "'.str_replace(array('"'),array('\\"'),$this->get_option('vs_text_dateddmmyyyy', CP_CFEMAIL_DEFAULT_vs_text_dateddmmyyyy)).'",
            	                	"number": "'.str_replace(array('"'),array('\\"'),$this->get_option('vs_text_number', CP_CFEMAIL_DEFAULT_vs_text_number)).'",
            	                	"digits": "'.str_replace(array('"'),array('\\"'),$this->get_option('vs_text_digits', CP_CFEMAIL_DEFAULT_vs_text_digits)).'",
            	                	"max": "'.str_replace(array('"'),array('\\"'),$this->get_option('vs_text_max', CP_CFEMAIL_DEFAULT_vs_text_max)).'",
            	                	"min": "'.str_replace(array('"'),array('\\"'),$this->get_option('vs_text_min', CP_CFEMAIL_DEFAULT_vs_text_min)).'",
    	                    	    "previous": "'.str_replace(array('"'),array('\\"'),$previous_label).'",
    	                    	    "next": "'.str_replace(array('"'),array('\\"'),$next_label).'"
            	                }}'
            ));
        }
        else
        {
            wp_enqueue_script( "jquery" );
            wp_enqueue_script( "jquery-ui-core" );
            wp_enqueue_script( "jquery-ui-datepicker" );
        }
        ?>
        <script type="text/javascript">
         function <?php echo $this->prefix; ?>_pform_doValidate<?php echo '_'.$this->print_counter; ?>(form)
         {
            document.<?php echo $this->prefix; ?>_pform<?php echo '_'.$this->print_counter; ?>.cp_ref_page.value = document.location;
            $dexQuery = jQuery.noConflict();<?php if ($this->get_option('cv_enable_captcha', CP_CFEMAIL_DEFAULT_cv_enable_captcha) != 'false') { ?>
            if (document.<?php echo $this->prefix; ?>_pform<?php echo '_'.$this->print_counter; ?>.hdcaptcha_<?php echo $this->prefix; ?>_post.value == '') { setTimeout( "<?php echo $this->prefix; ?>_cerror<?php echo '_'.$this->print_counter; ?>()", 100); return false; }
            var result = $dexQuery.ajax({ type: "GET", url: "<?php echo $this->get_site_url(); ?>?ps=<?php echo '_'.$this->print_counter; ?>&<?php echo $this->prefix; ?>_pform_process=2&inAdmin=1&ps=<?php echo '_'.$this->print_counter; ?>&hdcaptcha_<?php echo $this->prefix; ?>_post="+document.<?php echo $this->prefix; ?>_pform<?php echo '_'.$this->print_counter; ?>.hdcaptcha_<?php echo $this->prefix; ?>_post.value, async: false }).responseText;
            if (result == "captchafailed") {
                $dexQuery("#captchaimg<?php echo '_'.$this->print_counter; ?>").attr('src', $dexQuery("#captchaimg<?php echo '_'.$this->print_counter; ?>").attr('src')+'&'+Date());
                setTimeout( "<?php echo $this->prefix; ?>_cerror<?php echo '_'.$this->print_counter; ?>()", 100);
                return false;
            } else <?php } ?>
                return true;
         }
         function <?php echo $this->prefix; ?>_cerror<?php echo '_'.$this->print_counter; ?>(){$dexQuery = jQuery.noConflict();$dexQuery("#hdcaptcha_error<?php echo '_'.$this->print_counter; ?>").css('top',$dexQuery("#hdcaptcha_<?php echo $this->prefix; ?>_post<?php echo '_'.$this->print_counter; ?>").outerHeight());$dexQuery("#hdcaptcha_error<?php echo '_'.$this->print_counter; ?>").css("display","inline");}
        </script>
        <?php
        
        $button_label = $this->get_option('vs_text_submitbtn', 'Submit');
        $button_label = ($button_label==''?'Submit':$button_label);
    
        if (!defined('CP_AUTH_INCLUDE')) define('CP_AUTH_INCLUDE',true);
        @include dirname( __FILE__ ) . '/cp-public-int.inc.php';
        if (!CP_CFEMAIL_DEFER_SCRIPTS_LOADING)
        {
            // This code won't be used in most cases. This code is for preventing problems in wrong WP themes and conflicts with third party plugins.
            ?>
                 <?php $plugin_url = plugins_url('', __FILE__); ?>
                 <script type='text/javascript' src='<?php echo $plugin_url.'/../../../wp-includes/js/jquery/jquery.js'; ?>'></script>
                 <script type='text/javascript' src='<?php echo $plugin_url.'/../../../wp-includes/js/jquery/ui/jquery.ui.core.min.js'; ?>'></script>
                 <script type='text/javascript' src='<?php echo $plugin_url.'/../../../wp-includes/js/jquery/ui/jquery.ui.datepicker.min.js'; ?>'></script>
                 <script type='text/javascript' src='<?php echo $plugin_url.'/../../../wp-includes/js/jquery/ui/jquery.ui.widget.min.js'; ?>'></script>
                 <script type='text/javascript' src='<?php echo $plugin_url.'/../../../wp-includes/js/jquery/ui/jquery.ui.position.min.js'; ?>'></script>
                 <script type='text/javascript' src='<?php echo $plugin_url.'/../../../wp-includes/js/jquery/ui/jquery.ui.tooltip.min.js'; ?>'></script>
                 <script type='text/javascript' src='<?php echo plugins_url('js/jQuery.stringify.js', __FILE__); ?>'></script>
                 <script type='text/javascript' src='<?php echo plugins_url('js/jquery.validate.js', __FILE__); ?>'></script>
                 <script type='text/javascript'>
                 /* <![CDATA[ */
                 var <?php echo $this->prefix; ?>_fbuilder_config<?php echo '_'.$this->print_counter; ?> = {"obj":"{\"pub\":true,\"identifier\":\"<?php echo '_'.$this->print_counter; ?>\",\"messages\": {\n    \t                \t\"required\": \"<?php echo str_replace(array('"'),array('\\"'),$this->get_option('vs_text_is_required', CP_CFEMAIL_DEFAULT_vs_text_is_required));?>\",\n    \t                \t\"email\": \"<?php echo str_replace(array('"'),array('\\"'),$this->get_option('vs_text_is_email', CP_CFEMAIL_DEFAULT_vs_text_is_email));?>\",\n    \t                \t\"datemmddyyyy\": \"<?php echo str_replace(array('"'),array('\\"'),$this->get_option('vs_text_datemmddyyyy', CP_CFEMAIL_DEFAULT_vs_text_datemmddyyyy));?>\",\n    \t                \t\"dateddmmyyyy\": \"<?php echo str_replace(array('"'),array('\\"'),$this->get_option('vs_text_dateddmmyyyy', CP_CFEMAIL_DEFAULT_vs_text_dateddmmyyyy));?>\",\n    \t                \t\"number\": \"<?php echo str_replace(array('"'),array('\\"'),$this->get_option('vs_text_number', CP_CFEMAIL_DEFAULT_vs_text_number));?>\",\n    \t                \t\"digits\": \"<?php echo str_replace(array('"'),array('\\"'),$this->get_option('vs_text_digits', CP_CFEMAIL_DEFAULT_vs_text_digits));?>\",\n    \t                \t\"max\": \"<?php echo str_replace(array('"'),array('\\"'),$this->get_option('vs_text_max', CP_CFEMAIL_DEFAULT_vs_text_max));?>\",\n    \t                \t\"min\": \"<?php echo str_replace(array('"'),array('\\"'),$this->get_option('vs_text_min', CP_CFEMAIL_DEFAULT_vs_text_min));?>\",\"previous\": \"<?php echo str_replace(array('"'),array('\\"'),$previous_label); ?>\",\"next\": \"<?php echo str_replace(array('"'),array('\\"'),$next_label); ?>\"\n    \t                }}"};
                 /* ]]> */
                 </script>
                 <script type='text/javascript' src='<?php echo plugins_url('js/fbuilderf.jquery.js', __FILE__); ?>'></script>
            <?php
        }
        $this->print_counter++;
    }


    /* Code for the admin area */

    public function plugin_page_links($links) {
        $customAdjustments_link = '<a href="http://wordpress.dwbooster.com/contact-us">'.__('Request custom changes').'</a>';
    	array_unshift($links, $customAdjustments_link);
        $settings_link = '<a href="options-general.php?page='.$this->menu_parameter.'">'.__('Settings').'</a>';
    	array_unshift($links, $settings_link);
    	$help_link = '<a href="'.$this->plugin_URL.'">'.__('Help').'</a>';
    	array_unshift($links, $help_link);
    	return $links;
    }


    public function admin_menu() {
        add_options_page($this->plugin_name.' Options', $this->plugin_name, 'manage_options', $this->menu_parameter, array($this, 'settings_page') );
        add_menu_page( $this->plugin_name.' Options', $this->plugin_name, 'edit_pages', $this->menu_parameter, array($this, 'settings_page') );
        add_submenu_page( $this->menu_parameter, 'Upgrade to Pro Version', 'Upgrade to Pro Version', 'edit_pages', $this->menu_parameter."_upgrade", array($this, 'settings_page') );
    }


    function insert_button() {
        print '<a href="javascript:send_to_editor(\'[CONTACT_FORM_TO_EMAIL]\');" title="'.__('Insert').' '.$this->plugin_name.'"><img hspace="5" src="'.plugins_url('/images/cp_form.gif', __FILE__).'" alt="'.__('Insert').' '.$this->plugin_name.'" /></a>';
    }


    public function settings_page() {
        global $wpdb;
        if ($this->get_param("cal"))
        {
            $this->item = $this->get_param("cal");
            if ($this->get_param("list") == '1')
                @include_once dirname( __FILE__ ) . '/cp-admin-int-message-list.inc.php';
            else if ($this->get_param("report") == '1')
                @include_once dirname( __FILE__ ) . '/cp-admin-int-report.inc.php';
            else
                @include_once dirname( __FILE__ ) . '/cp-admin-int.inc.php';
        }
        else if ($this->get_param("page") == $this->menu_parameter.'_upgrade')
        {
            echo("Redirecting to upgrade page...<script type='text/javascript'>document.location='http://wordpress.dwbooster.com/forms/contact-form-to-email#download';</script>");
            exit;
        }   
        else
            @include_once dirname( __FILE__ ) . '/cp-admin-int-list.inc.php';
    }


    function insert_adminScripts($hook) {
        if ($this->get_param("page") == $this->menu_parameter)
        {
            wp_deregister_script('query-stringify');
            wp_register_script('query-stringify', plugins_url('/js/jQuery.stringify.js', __FILE__));
            wp_enqueue_script( $this->prefix.'_builder_script', plugins_url('/js/fbuilderf.jquery.js', __FILE__),array("jquery","jquery-ui-core","jquery-ui-sortable","jquery-ui-tabs","jquery-ui-droppable","jquery-ui-button","query-stringify","jquery-ui-datepicker") );
            wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
        }
        if( 'post.php' != $hook  && 'post-new.php' != $hook )
            return;
        // space to include some script in the post or page areas if needed
    }

    /* hook for checking posted data for the admin area */

    function data_management() {
        global $wpdb;

        $this->check_reports();

        if ($this->get_param($this->prefix.'_encodingfix') == '1')
        {
            $wpdb->query('alter table '.$wpdb->prefix.$this->table_items.' convert to character set utf8 collate utf8_unicode_ci;');
            $wpdb->query('alter table '.$wpdb->prefix.$this->table_messages.' convert to character set utf8 collate utf8_unicode_ci;');
            echo 'Ok, encoding fixed.';
            exit;
        }

        if ($this->get_param($this->prefix.'_captcha') == 'captcha' )
        {
            @include_once dirname( __FILE__ ) . '/captcha/captcha.php';
            exit;
        }


        if ($this->get_param($this->prefix.'_csv') && is_admin() )
        {
            $this->export_csv();
            return;
        }

        if ( $this->get_param($this->prefix.'_post_options') && is_admin() )
        {
            $this->save_options();
            return;
        }

    	if ( 'POST' != $_SERVER['REQUEST_METHOD'] || ! isset( $_POST[$this->prefix.'_pform_process'] ) )
    	    if ( 'GET' != $_SERVER['REQUEST_METHOD'] || !isset( $_GET['hdcaptcha_'.$this->prefix.'_post'] ) )
    		    return;

        if ($this->get_param($this->prefix.'_id')) $this->item = $this->get_param($this->prefix.'_id');

        @session_start();
        if (isset($_GET["ps"])) $sequence = $_GET["ps"]; else if (isset($_POST["cp_pform_psequence"])) $sequence = $_POST["cp_pform_psequence"];
        if (
               ($this->get_option('cv_enable_captcha', CP_CFEMAIL_DEFAULT_cv_enable_captcha) != 'false') &&
               ( (strtolower($this->get_param('hdcaptcha_'.$this->prefix.'_post')) != strtolower($_SESSION['rand_code'.$sequence])) ||
                 ($_SESSION['rand_code'.$sequence] == '')
               )
           )
        {
            echo 'captchafailed';
            exit;
        }

    	// if this isn't the real post (it was the captcha verification) then echo ok and exit
        if ( 'POST' != $_SERVER['REQUEST_METHOD'] || ! isset( $_POST[$this->prefix.'_pform_process'] ) )
    	{
    	    echo 'ok';
            exit;
    	}

        // get form info
        //---------------------------
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        $form_data = json_decode($this->cleanJSON($this->get_option('form_structure', CP_CFEMAIL_DEFAULT_form_structure)));
        $fields = array();
        foreach ($form_data[0] as $item)
        {
            $fields[$item->name] = $item->title;
            if ($item->ftype == 'fPhone') // join fields for phone fields
            {
                for($i=0; $i<=substr_count($item->dformat," "); $i++)
                {
                    $_POST[$item->name.$sequence] .= ($_POST[$item->name.$sequence."_".$i]!=''?($i==0?'':'-').$_POST[$item->name.$sequence."_".$i]:'');
                    unset($_POST[$item->name.$sequence."_".$i]);
                }
            }
        }


        // grab posted data
        //---------------------------
        $buffer = "";
        foreach ($_POST as $item => $value)
            if (isset($fields[str_replace($sequence,'',$item)]))
            {
                $buffer .= $fields[str_replace($sequence,'',$item)] . ": ". (is_array($value)?(implode(", ",$value)):($value)) . "\n\n";
                $params[str_replace($sequence,'',$item)] = $value;
            }

        foreach ($_FILES as $item => $value)
            if (isset($fields[str_replace($sequence,'',$item)]) && $this->check_upload($_FILES[$item]))
            {
                $buffer .= $fields[str_replace($sequence,'',$item)] . ": ". $value["name"] . "\n\n";
                $params[str_replace($sequence,'',$item)] = $value["name"];
                $movefile = wp_handle_upload( $_FILES[$item], array( 'test_form' => false ) );
                if ( $movefile )
                {
                    $params[str_replace($sequence,'',$item)."_link"] = $movefile["file"];
                    $params[str_replace($sequence,'',$item)."_url"] = $movefile["url"];
                }
                // else {print_r($movefile);exit;}    // un-comment this line if the uploads aren't working
            }
        $buffer_A = $buffer;

        // insert into database
        //---------------------------
        $to = $this->get_option('cu_user_email_field', CP_CFEMAIL_DEFAULT_cu_user_email_field);
        $rows_affected = $wpdb->insert( $wpdb->prefix.$this->table_messages, array( 'formid' => $this->item,
                                                                                    'time' => current_time('mysql'),
                                                                                    'ipaddr' => $_SERVER['REMOTE_ADDR'],
                                                                                    'notifyto' => $_POST[$to.$sequence],
                                                                                    'posted_data' => serialize($params),
                                                                                    'data' =>$buffer_A
                                                                                   ) );
        if (!$rows_affected)
        {
            echo 'Error saving data! Please try again.';
            echo '<br /><br />Error debug information: '.mysql_error();
            exit;
        }

        $myrows = $wpdb->get_results( "SELECT MAX(id) as max_id FROM ".$wpdb->prefix.$this->table_messages );
        $item_number = $myrows[0]->max_id;

        $this->ready_to_go_reservation($item_number, "", $params);

        header("Location: ".$this->get_option('fp_return_page', CP_CFEMAIL_DEFAULT_fp_return_page));
        exit();
    }


    function check_upload($uploadfiles) {
        $filename = $uploadfiles['name'];
        $filetype = wp_check_filetype( basename( $filename ), null );

        if ( in_array ($filetype["ext"],array("php","asp","aspx","cgi","pl","perl","exe")) )
            return false;
        else
            return true;
    }


    function ready_to_go_reservation($itemnumber, $payer_email = "", $params = array())
    {

        global $wpdb;

        $myrows = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix.$this->table_messages." WHERE id=".$itemnumber );

        $mycalendarrows = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.$this->table_items.' WHERE `id`='.$myrows[0]->formid);

        $this->item = $myrows[0]->formid;

        $buffer_A = $myrows[0]->data;
        $buffer = $buffer_A;

        if ('true' == $this->get_option('fp_inc_additional_info', CP_CFEMAIL_DEFAULT_fp_inc_additional_info))
        {
            $buffer .="ADDITIONAL INFORMATION\n"
                  ."*********************************\n"
                  ."IP: ".$myrows[0]->ipaddr."\n"
                  ."Server Time:  ".date("Y-m-d H:i:s")."\n";
        }

        // 1- Send email
        //---------------------------
        $attachments = array();
        if ('html' == $this->get_option('fp_emailformat', CP_CFEMAIL_DEFAULT_email_format))
            $message = str_replace('<%INFO%>',str_replace("\n","<br />",str_replace('<','&lt;',$buffer)),$this->get_option('fp_message', CP_CFEMAIL_DEFAULT_fp_message));
        else
            $message = str_replace('<%INFO%>',$buffer,$this->get_option('fp_message', CP_CFEMAIL_DEFAULT_fp_message));
        $subject = $this->get_option('fp_subject', CP_CFEMAIL_DEFAULT_fp_subject);
        foreach ($params as $item => $value)
        {
            $message = str_replace('<%'.$item.'%>',(is_array($value)?(implode(", ",$value)):($value)),$message);
            $subject = str_replace('<%'.$item.'%>',(is_array($value)?(implode(", ",$value)):($value)),$subject);
            if (strpos($item,"_link"))
                $attachments[] = $value;
        }
        $from = $this->get_option('fp_from_email', @CP_CFEMAIL_DEFAULT_fp_from_email);
        $to = explode(",",$this->get_option('fp_destination_emails', @CP_CFEMAIL_DEFAULT_fp_destination_emails));
        if ('html' == $this->get_option('fp_emailformat', CP_CFEMAIL_DEFAULT_email_format)) $content_type = "Content-Type: text/html; charset=utf-8\n"; else $content_type = "Content-Type: text/plain; charset=utf-8\n";

        $replyto = $myrows[0]->notifyto;
        if ($this->get_option('fp_emailfrommethod', "fixed") == "customer")
            $from_1 = $replyto;
        else
            $from_1 = $from;
/**
        // using multiple choice fields to send emails to selected recipients
        $arr["A"] = $_POST["fieldname1"];
        $arr["B"] = $_POST["fieldname9"];
        foreach ($arr as $arrayitems)
            if (is_array($arrayitems))
            {
                foreach ($arrayitems as $value)
                {
                    $string = substr($value,0,strpos($value,"-"));
                    $string = explode(",",trim($string));
                    foreach ($string as $emailkk)
                        if (strpos($emailkk,"@"))
                            $to[] = trim($emailkk);
                }
            }
        $to = array_unique($to);
*/
        foreach ($to as $item)
            if (trim($item) != '')
            {
                wp_mail(trim($item), $subject, $message,
                    "From: \"$from_1\" <".$from_1.">\r\n".
                    ($replyto!=''?"Reply-To: \"$replyto\" <".$replyto.">\r\n":'').
                    $content_type.
                    "X-Mailer: PHP/" . phpversion(), $attachments);
            }

        // 2- Send copy to user
        //---------------------------
        $to = $this->get_option('cu_user_email_field', CP_CFEMAIL_DEFAULT_cu_user_email_field);
        $_POST[$to] = $myrows[0]->notifyto;
        if ((trim($_POST[$to]) != '' || $payer_email != '') && 'true' == $this->get_option('cu_enable_copy_to_user', CP_CFEMAIL_DEFAULT_cu_enable_copy_to_user))
        {
            if ('html' == $this->get_option('cu_emailformat', CP_CFEMAIL_DEFAULT_email_format))
                $message = str_replace('<%INFO%>',str_replace("\n","<br />",str_replace('<','&lt;',$buffer_A)).'</pre>',$this->get_option('cu_message', CP_CFEMAIL_DEFAULT_cu_message));
            else
                $message = str_replace('<%INFO%>',$buffer_A,$this->get_option('cu_message', CP_CFEMAIL_DEFAULT_cu_message));
            $subject = $this->get_option('cu_subject', CP_CFEMAIL_DEFAULT_cu_subject);
            foreach ($params as $item => $value)
            {
                $message = str_replace('<%'.$item.'%>',(is_array($value)?(implode(", ",$value)):($value)),$message);
                $subject = str_replace('<%'.$item.'%>',(is_array($value)?(implode(", ",$value)):($value)),$subject);
            }
            if ('html' == $this->get_option('cu_emailformat', CP_CFEMAIL_DEFAULT_email_format)) $content_type = "Content-Type: text/html; charset=utf-8\n"; else $content_type = "Content-Type: text/plain; charset=utf-8\n";
            if ($_POST[$to] != '')
                wp_mail(trim($_POST[$to]), $subject, $message,
                        "From: \"$from\" <".$from.">\r\n".
                        $content_type.
                        "X-Mailer: PHP/" . phpversion());
            if ($_POST[$to] != $payer_email && $payer_email != '')
                wp_mail(trim($payer_email), $subject, $message,
                        "From: \"$from\" <".$from.">\r\n".
                        $content_type.
                        "X-Mailer: PHP/" . phpversion());
        }

    }


    function save_options()
    {
        global $wpdb;
        $this->item = $_POST[$this->prefix."_id"];

        foreach ($_POST as $item => $value)
            $_POST[$item] = stripcslashes($value);

        $this->add_field_verify($wpdb->prefix.$this->table_items, "fp_emailfrommethod", "VARCHAR(10)");
        $this->add_field_verify($wpdb->prefix.$this->table_items, "rep_enable", "VARCHAR(10)");
        $this->add_field_verify($wpdb->prefix.$this->table_items, "rep_days", "VARCHAR(10)");
        $this->add_field_verify($wpdb->prefix.$this->table_items, "rep_hour", "VARCHAR(10)");
        $this->add_field_verify($wpdb->prefix.$this->table_items, "rep_emails", "text");
        $this->add_field_verify($wpdb->prefix.$this->table_items, "rep_subject", "text");
        $this->add_field_verify($wpdb->prefix.$this->table_items, "rep_emailformat", "VARCHAR(10)");
        $this->add_field_verify($wpdb->prefix.$this->table_items, "rep_message", "text");
        $this->add_field_verify($wpdb->prefix.$this->table_items,'vs_text_submitbtn'," varchar(250) NOT NULL default ''");
        $this->add_field_verify($wpdb->prefix.$this->table_items,'vs_text_previousbtn'," varchar(250) NOT NULL default ''");
        $this->add_field_verify($wpdb->prefix.$this->table_items,'vs_text_nextbtn'," varchar(250) NOT NULL default ''");         

        $data = array(
                      'form_structure' => $_POST['form_structure'],

                      'fp_from_email' => $_POST['fp_from_email'],
                      'fp_destination_emails' => $_POST['fp_destination_emails'],
                      'fp_subject' => $_POST['fp_subject'],
                      'fp_inc_additional_info' => $_POST['fp_inc_additional_info'],
                      'fp_return_page' => $_POST['fp_return_page'],
                      'fp_message' => $_POST['fp_message'],
                      'fp_emailformat' => $_POST['fp_emailformat'],

                      'cu_enable_copy_to_user' => $_POST['cu_enable_copy_to_user'],
                      'cu_user_email_field' => $_POST['cu_user_email_field'],
                      'cu_subject' => $_POST['cu_subject'],
                      'cu_message' => $_POST['cu_message'],
                      'cu_emailformat' => $_POST['cu_emailformat'],
                      'fp_emailfrommethod' => $_POST['fp_emailfrommethod'],

                      'vs_use_validation' => $_POST['vs_use_validation'],
                      'vs_text_is_required' => $_POST['vs_text_is_required'],
                      'vs_text_is_email' => $_POST['vs_text_is_email'],
                      'vs_text_datemmddyyyy' => $_POST['vs_text_datemmddyyyy'],
                      'vs_text_dateddmmyyyy' => $_POST['vs_text_dateddmmyyyy'],
                      'vs_text_number' => $_POST['vs_text_number'],
                      'vs_text_digits' => $_POST['vs_text_digits'],
                      'vs_text_max' => $_POST['vs_text_max'],
                      'vs_text_min' => $_POST['vs_text_min'],
                      'vs_text_submitbtn' => $_POST['vs_text_submitbtn'],
                      'vs_text_previousbtn' => $_POST['vs_text_previousbtn'],
                      'vs_text_nextbtn' => $_POST['vs_text_nextbtn'],

                      'rep_enable' => $_POST['rep_enable'],
                      'rep_days' => $_POST['rep_days'],
                      'rep_hour' => $_POST['rep_hour'],
                      'rep_emails' => $_POST['rep_emails'],
                      'rep_subject' => $_POST['rep_subject'],
                      'rep_emailformat' => $_POST['rep_emailformat'],
                      'rep_message' => $_POST['rep_message'],

                      'cv_enable_captcha' => $_POST['cv_enable_captcha'],
                      'cv_width' => $_POST['cv_width'],
                      'cv_height' => $_POST['cv_height'],
                      'cv_chars' => $_POST['cv_chars'],
                      'cv_font' => $_POST['cv_font'],
                      'cv_min_font_size' => $_POST['cv_min_font_size'],
                      'cv_max_font_size' => $_POST['cv_max_font_size'],
                      'cv_noise' => $_POST['cv_noise'],
                      'cv_noise_length' => $_POST['cv_noise_length'],
                      'cv_background' => $_POST['cv_background'],
                      'cv_border' => $_POST['cv_border'],
                      'cv_text_enter_valid_captcha' => $_POST['cv_text_enter_valid_captcha']
    	);
        $wpdb->update ( $wpdb->prefix.$this->table_items, $data, array( 'id' => $this->item ));
    }


    function get_form_field_label ($fieldid, $form)
    {
            foreach($form as $item)
                if ($item->name == $fieldid)
                {
                    if (isset($item->shortlabel) && $item->shortlabel != '')
                        return $item->shortlabel;
                    else
                        return $item->title;
                }
        return $fieldid;
    }


    function generateSafeFileName($filename) {
        $filename = strtolower($filename);
        $filename = str_replace("#","_",$filename);
        $filename = str_replace(" ","_",$filename);
        $filename = str_replace("'","",$filename);
        $filename = str_replace('"',"",$filename);
        $filename = str_replace("__","_",$filename);
        $filename = str_replace("&","and",$filename);
        $filename = str_replace("/","_",$filename);
        $filename = str_replace("\\","_",$filename);
        $filename = str_replace("?","",$filename);
        return $filename;
    }

    function export_csv ()
    {
        if (!is_admin())
            return;
        global $wpdb;

        $this->item = intval($this->get_param("cal"));

        if ($this->item)
        {
            $form = json_decode($this->cleanJSON($this->get_option('form_structure', CP_CFEMAIL_DEFAULT_form_structure)));
            $form = $form[0];
        }
        else
            $form = array();

        $cond = '';
        if ($this->get_param("search")) $cond .= " AND (data like '%".esc_sql($this->get_param("search"))."%' OR posted_data LIKE '%".esc_sql($this->get_param("search"))."%')";
        if ($this->get_param("dfrom")) $cond .= " AND (`time` >= '".esc_sql($this->get_param("dfrom"))."')";
        if ($this->get_param("dto")) $cond .= " AND (`time` <= '".esc_sql($this->get_param("dto"))." 23:59:59')";
        if ($this->item != 0) $cond .= " AND formid=".$this->item;

        $events = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix.$this->table_messages." WHERE 1=1 ".$cond." ORDER BY `time` DESC" );

        if ($this->include_user_data_csv)
            $fields = array("Form ID", "Time", "IP Address", "email");
        else
            $fields = array("Form", "email");
        $values = array();
        foreach ($events as $item)
        {
            if ($this->include_user_data_csv)
                $value = array($item->formid, $item->time, $item->ipaddr, $item->notifyto);
            else
                $value = array($this->get_option('form_name',''), $item->notifyto);
            if ($item->posted_data)
                $data = unserialize($item->posted_data);
            else
                $data = array();

            $end = count($fields);
            for ($i=0; $i<$end; $i++)
                if (isset($data[$fields[$i]]) ){
                    $value[$i] = $data[$fields[$i]];
                    unset($data[$fields[$i]]);
                }

            if (is_array($data)) foreach ($data as $k => $d)
            {
               $fields[] = $k;
               $value[] = $d;
            }
            $values[] = $value;
        }

        $filename = $this->generateSafeFileName(strtolower($this->get_option('form_name','export'))).'_'.date("m_d_y");

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=".$filename.".csv");

        $end = count($fields);
        for ($i=0; $i<$end; $i++)
            echo '"'.str_replace('"','""', $this->get_form_field_label($fields[$i],$form)).'",';
        echo "\n";
        foreach ($values as $item)
        {
            for ($i=0; $i<$end; $i++)
            {
                if (!isset($item[$i]))
                    $item[$i] = '';
                if (is_array($item[$i]))
                    $item[$i] = implode($item[$i],',');
                echo '"'.str_replace('"','""', $item[$i]).'",';
            }
            echo "\n";
        }

        exit;
    }

    public function setId($id)
    {
        $this->item = $id;
    }



    private function get_records_csv($formid, $form_name = "")
    {
        global $wpdb;

        $last_sent_id = get_option('cp_cfte_last_sent_id_'.$formid, '0');
        $events = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix.$this->table_messages." WHERE formid=".$formid." AND id>".$last_sent_id." ORDER BY id ASC");

        if ($wpdb->num_rows <= 0) // if no rows, return empty
            return '';

        if ($this->item)
        {
            $form = json_decode($this->cleanJSON($this->get_option('form_structure', CP_CFEMAIL_DEFAULT_form_structure)));
            $form = $form[0];
        }
        else
            $form = array();

        $buffer = '';
        if ($this->include_user_data_csv)
            $fields = array("Submission ID","Form ID", "Time", "IP Address", "email");
        else
            $fields = array("Submission ID", "Form", "email");
        $values = array();
        foreach ($events as $item)
        {
            if ($this->include_user_data_csv)
                $value = array($item->id, $item->formid, $item->time, $item->ipaddr, $item->notifyto);
            else
                $value = array($item->id, $form_name, $item->notifyto);
            $last_sent_id = $item->id;
            if ($item->posted_data)
                $data = unserialize($item->posted_data);
            else
                $data = array();

            $end = count($fields);
            for ($i=0; $i<$end; $i++)
                if (isset($data[$fields[$i]]) ){
                    $value[$i] = $data[$fields[$i]];
                    unset($data[$fields[$i]]);
                }

            if (is_array($data)) foreach ($data as $k => $d)
            {
               $fields[] = $k;
               $value[] = $d;
            }
            $values[] = $value;
        }
        update_option('cp_cfte_last_sent_id_'.$formid, $last_sent_id);

        $end = count($fields);
        for ($i=0; $i<$end; $i++)
            $buffer .= '"'.str_replace('"','""', $this->get_form_field_label($fields[$i],$form)).'",';
        $buffer .= "\n";
        foreach ($values as $item)
        {
            for ($i=0; $i<$end; $i++)
            {
                if (!isset($item[$i]))
                    $item[$i] = '';
                if (is_array($item[$i]))
                    $item[$i] = implode($item[$i],',');
                $buffer .= '"'.str_replace('"','""', $item[$i]).'",';
            }
            $buffer .= "\n";
        }
        return $buffer;

    }

    private function check_reports() {
        global $wpdb;

        $last_verified = get_option('cp_cfte_last_verified','');
        if ( $last_verified == '' || $last_verified < date("Y-m-d H:i:s", strtotime("-1 minutes")) )  // verification to don't check too fast to avoid overloading the site
        {
            update_option('cp_cfte_last_verified',date("Y-m-d H:i:s"));

            // global reports for all forms
            if (get_option('cp_cfte_rep_enable', 'no') == 'yes' && get_option('cp_cfte_rep_days', '') != '' && get_option('cp_cfte_rep_emails', '') != '' )
            {
                $formid = 0;
                $verify_after = date("Y-m-d H:i:s", strtotime("-".get_option('cp_cfte_rep_days', '')." days"));
                $last_sent = get_option('cp_cfte_last_sent'.$formid, '');                
                if ($last_sent == '' || $last_sent < $verify_after)  // check if this form needs to check for a new report
                {
                    update_option('cp_cfte_last_sent'.$formid, date("Y-m-d ".(get_option('cp_cfte_rep_hour', '')<'10'?'0':'').get_option('cp_cfte_rep_hour', '').":00:00"));
                    $text = '';
                    $forms = $wpdb->get_results("SELECT id,fp_from_email,form_name,rep_days,rep_hour,rep_emails,rep_subject,rep_emailformat,rep_message,rep_enable FROM ".$wpdb->prefix.$this->table_items." WHERE rep_emails<>'' AND rep_enable='yes'");
                    foreach ($forms as $form)  // for each form with the reports enabled
                    {
                        $attachments = array();
                        $csv = $this->get_records_csv($form->id, $form->form_name);
                        if ($csv != '')
                        {
                            $text = "- ".substr_count($csv,",\n\"").' submissions from '.$form->form_name."\n";
                            $filename = $this->generateSafeFileName(strtolower($form->form_name)).'_'.date("m_d_y");
                            $filename = WP_CONTENT_DIR . '/uploads/'.$filename .'.csv';
                            $handle = fopen($filename, 'w');
                            fwrite($handle,$csv);
                            fclose($handle);
                            $attachments[] = $filename;
                        }
                    }
                    if ('html' == get_option('cp_cfte_rep_emailformat','')) $content_type = "Content-Type: text/html; charset=utf-8\n"; else $content_type = "Content-Type: text/plain; charset=utf-8\n";
                    if (count($attachments))
                        wp_mail( str_replace(" ","",str_replace(";",",",get_option('cp_cfte_rep_emails',''))), get_option('cp_cfte_rep_subject',''), get_option('cp_cfte_rep_message','')."\n".$text,
                                    "From: \"".get_option('cp_cfte_fp_from_email','')."\" <".get_option('cp_cfte_fp_from_email','').">\r\n".
                                    $content_type.
                                    "X-Mailer: PHP/" . phpversion(),
                                    @$attachments);
                }
            }

            // reports for specific forms
            $forms = $wpdb->get_results("SELECT id,form_name,fp_from_email,rep_days,rep_hour,rep_emails,rep_subject,rep_emailformat,rep_message,rep_enable FROM ".$wpdb->prefix.$this->table_items." WHERE rep_emails<>'' AND rep_enable='yes'");
            foreach ($forms as $form)  // for each form with the reports enabled
            {
                $formid = $form->id;
                $verify_after = date("Y-m-d H:i:s", strtotime("-".$form->rep_days." days"));
                $last_sent = get_option('cp_cfte_last_sent'.$formid, '');
                if ($last_sent == '' || $last_sent < $verify_after)  // check if this form needs to check for a new report
                {
                    update_option('cp_cfte_last_sent'.$formid, date("Y-m-d ".($form->rep_hour<'10'?'0':'').$form->rep_hour.":00:00"));
                    $csv = $this->get_records_csv($formid, $form->form_name);
                    if ($csv != '')
                    {
                        $filename = $this->generateSafeFileName(strtolower($form->form_name)).'_'.date("m_d_y");
                        $filename = WP_CONTENT_DIR . '/uploads/'.$filename .'.csv';
                        $handle = fopen($filename, 'w');
                        fwrite($handle,$csv);
                        fclose($handle);
                        $attachments = array( $filename );
                        if ('html' == $form->rep_emailformat) $content_type = "Content-Type: text/html; charset=utf-8\n"; else $content_type = "Content-Type: text/plain; charset=utf-8\n";
                        wp_mail( str_replace(" ","",str_replace(";",",",$form->rep_emails)), $form->rep_subject, $form->rep_message,
                                "From: \"".$form->fp_from_email."\" <".$form->fp_from_email.">\r\n".
                                $content_type.
                                "X-Mailer: PHP/" . phpversion(),
                                $attachments);
                    }
                }
            } // end foreach
        } // end if
    }  // end check_reports function


} // end class

// WIDGET CODE BELOW

class CP_ContactFormToEmail_Widget extends WP_Widget
{
  function CP_ContactFormToEmail_Widget()
  {
    $widget_ops = array('classname' => 'CP_ContactFormToEmail_Widget', 'description' => 'Displays a Contact Form' );
    $this->WP_Widget('CP_ContactFormToEmail_Widget', 'Contact Form to Email', $widget_ops);
  }

  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'itemid' => ''  ) );
    $title = $instance['title'];
    $itemid = $instance['itemid'];
    ?><p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
    <label for="<?php echo $this->get_field_id('itemid'); ?>">Form ID: <input class="widefat" id="<?php echo $this->get_field_id('itemid'); ?>" name="<?php echo $this->get_field_name('itemid'); ?>" type="text" value="<?php echo esc_attr($itemid); ?>" /></label>
    </p><?php
  }

  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['itemid'] = $new_instance['itemid'];
    return $instance;
  }

  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $itemid = $instance['itemid'];

    if (!empty($title))
      echo $before_title . $title . $after_title;;

    // WIDGET CODE GOES HERE
    $multiview = new CP_ContactFormToEmail;

    if ($itemid != '')
        $multiview->setId($itemid);

    $multiview->insert_public_item();

    echo $after_widget;
  }

} // end widget class

?>