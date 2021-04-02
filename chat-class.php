<?php
	
	class chat()
	{
		public function Uploadpicture()
		{
			// this function get the picture file and save to database
		}
		protected function Uploadpdf()
		{
			//this function get the pdf file and save to database
		}

		protected function Uploadvideo()
		{
			
		}

		protected function Uploadaudio()
		{
			
		}

		public function get_data()
		{

		}

		public function call_func($method)
		{
			call_user_func($method);
		}

		public function unset_session($session)
		{
			
		}

		public function init()
		{
			
		}

		public function retrieve_pic()
		{

		}

		public function retrieve_pdf()
		{
			
		}

		  public function getUser()
		    {
		        return User::findByID($this->user_id);
		    }

		public function retrieve_video()
		{
			
		}

		public function retrieve_audio()
		{
			 $sql = 'SELECT * FROM wp_uusers WHERE email = :email';

		        $db = static::getDB();
		        $stmt = $db->prepare($sql);
		        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

		        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

		        $stmt->execute();

		        return $stmt->fetch();
		}

		public function retrieve_text()
		{
			
		}
		public function load_page()
		{

		}
		public delete_files()
		{
				
		}

		/**
     * Delete this model
     *
     * @return void
     */
    public function delete()
    {
        $sql = 'DELETE FROM remembered_logins
                WHERE token_hash = :token_hash';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':token_hash', $this->token_hash, PDO::PARAM_STR);

        $stmt->execute();
    }


	}

?>