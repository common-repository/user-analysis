<?php
if( !class_exists( 'wcua_email' ) ){

	class Wcua_email{
		/**
		 * Emails array
		 */
		protected $emails;
		/**
		 * email subject or title
		 */
		protected $title;
		/**
		 * email template to be send
		 */
		protected $template;
		/**
		 * Final template to be sent as email
		 */
		protected $outputTemplate;

		public function __construct($emails, $title, $template ){

			$this->emails = $emails;
			$this->title = $title;
			$this->template = $template;
			$this->prepareTemplate();
			return $this->send();

		}
		/**
		 * preparing template ,
		 */
		private function prepareTemplate(){
			$template = $this->getTemplate();
			$this->outputTemplate = $this->get_email_template("email-header").$template.$this->get_email_template("email-footer");
		}

		/**
		 * Get template
		 */
		private function getTemplate(){
			return $this->template;
		}

		/**
		 * Send email
		 */
		private function send(){
			$headers[] = 'Content-Type: text/html; charset=UTF-8';
			return wp_mail( $this->emails, $this->title, $this->outputTemplate,$headers );
		}
		
		/**
		 * Get email template from template 
		 */
		private function get_email_template( $file ){
			ob_start();
			$file = WCUA_TEMPLATE_PATH."/email/".$file.".php";
			if( file_exists( $file )){
				include $file;
			}
			return ob_get_clean();
		}

	}

}
?>