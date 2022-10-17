<?php

class FileUploadController extends AppController {
	public function index() {
		$this->set('title', __('File Upload Answer'));
        if ($this->request->data['FileUpload'] ) {
            $uploadFile = $this->request->data['FileUpload']["file"];
            $mime = $uploadFile['type'];

            if ($mime === 'application/vnd.ms-excel')
            {
                $content = file_get_contents($uploadFile['tmp_name']);
                $lines = explode("\r",$content);
                for($i = 1; $i < sizeof($lines); $i++)
                {
                    list($name,$email) = explode(',',$lines[$i]);
                    $valid = 1;
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $valid = 0;
                    }
                    $this->FileUpload->create();
                    $this->FileUpload->save(array('email' => $email, 'name' => $name,'valid' => $valid));
                }
            }
        }

		$file_uploads = $this->FileUpload->find('all');
		$this->set(compact('file_uploads'));
	}

}