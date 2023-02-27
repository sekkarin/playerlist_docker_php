<?php


class PlayerController {
    public function pageRedirect($url)
		{
			header('Location:'.$url);
		}	
    public function indexView() {
        
        $this->pageRedirect('../views/index.View.php');
    }
}

?>