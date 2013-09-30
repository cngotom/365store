<?php
/*
  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  jqUploader serverside example: (author : pixeline, http://www.pixeline.be)

  when javascript is available, a variable is automatically created that you can use to dispatch all the possible actions

  This file examplifies this usage: javascript available, or non available.

  1/ a form is submitted
  1.a javascript is off, so jquploader could not be used, therefore the file needs to be uploaded the old way
  1.b javascript is on, so the file, by now is already uploaded and its filename is available in the $_POST array sent by the form

  2/ a form is not submitted, and jqUploader is on
  jqUploader flash file is calling home! process the upload.



  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

 */
error_reporting(E_ALL);

 function write_log($str){
	$handle = fopen("flash_upload.txt", "a");
	fwrite($handle,$str."\r\n");
	fclose($handle);
 }
 

$extend = pathinfo($_FILES['Filedata']['name']); 


$fileName = "20120410_015106_092096.jpg";

$uploadDir = dirname(__FILE__) . "\\files\\" . $fileName;
$uploadFile = $uploadDir;

write_log($fileName);
write_log($uploadFile);

if ($_POST['submit'] != '') {
	write_log("post");
    // 1. submitting the html form
    if (!isset($_GET['jqUploader'])) {
        // 1.a javascript off, we need to upload the file
        if (move_uploaded_file($_FILES[0]['tmp_name'], $uploadFile)) {
            // delete the file
            @unlink($uploadFile);
            $html_body = '<h1>File successfully uploaded!</h1><pre>';
            $html_body .= print_r($_FILES, true);
            $html_body .= '</pre>';
        } else {
            $html_body = '<h1>File upload error!</h1>';

            switch ($_FILES[0]['error']) {
                case 1:
                    $html_body .= 'The file is bigger than this PHP installation allows';
                    break;
                case 2:
                    $html_body .= 'The file is bigger than this form allows';
                    break;
                case 3:
                    $html_body .= 'Only part of the file was uploaded';
                    break;
                case 4:
                    $html_body .= 'No file was uploaded';
                    break;
                default:
                    $html_body .= 'unknown errror';
            }
            $html_body .= 'File data received: <pre>';
            $html_body .= print_r($_FILES, true);
            $html_body .= '</pre>';
        }
        $html_body = '<h1>Full form</h1><pre>';
        $html_body .= print_r($_POST, true);
        $html_body .= '</pre>';
    } else {
        // 1.b javascript on, so the file has been uploaded and its filename is in the POST array
        $html_body = '<h1>Form posted!</h1><p>Error:<pre>';
        $html_body .= print_r($_POST, false);
        $html_body .= '</pre>';
    }
    myHtml($html_body);
} else {
	write_log("!post");
    if ($_GET['jqUploader'] == 1) {
        $myFile = "log.txt";
		write_log(" log.txt");
        $fh = fopen($myFile, 'w');
        $stringData = print_r($_FILES, true);
		write_log($stringData);
        fwrite($fh, $stringData);
        fclose($fh);
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // 2. performing jqUploader flash upload
        if ($_FILES['Filedata']['name']) {
			write_log(" move pic");
			write_log(is_file($_FILES['Filedata']['tmp_name']));
			var_dump($fileName);
			$filePath = "E:\\workspace\\365_PROJ\\trunk\\jqUploader1023\\files\\" . $fileName;
			
			echo $filePath;
			copy($_FILES['Filedata']['tmp_name'],$filePath);

            if (copy($_FILES['Filedata']['tmp_name'], $uploadFile)) {
				write_log(" success | ".$_FILES['Filedata']['tmp_name']." | ".$uploadFile);
                // delete the file
                @unlink($uploadFile);
                return $uploadFile;
            }
        } else {
            if ($_FILES['Filedata']['error']) {
				write_log(" error");
                return $_FILES['Filedata']['error'];
            }
        }
    }
}

// /////////////////// HELPER FUNCTIONS
function myHtml($bodyHtml) {
?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
    <html lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>jqUploader demo - Result</title>
            <link rel="stylesheet" type="text/css" media="screen" href="style.css"/>
        </head>
        <body>
<?php echo $bodyHtml;
?>
        </body>
    </html>
        <?php
    }

    function obsafe_print_r($var, $return = false, $html = false, $level = 0) {
        $spaces = "";
        $space = $html ? "&nbsp;" : " ";
        $newline = $html ? "<br />" : "\n";
        for ($i = 1; $i <= 6; $i++) {
            $spaces .= $space;
        }
        $tabs = $spaces;
        for ($i = 1; $i <= $level; $i++) {
            $tabs .= $spaces;
        }
        if (is_array($var)) {
            $title = "Array";
        } elseif (is_object($var)) {
            $title = get_class($var) . " Object";
        }
        $output = $title . $newline . $newline;
        foreach ($var as $key => $value) {
            if (is_array($value) || is_object($value)) {
                $level++;
                $value = obsafe_print_r($value, true, $html, $level);
                $level--;
            }
            $output .= $tabs . "[" . $key . "] => " . $value . $newline;
        }
        if ($return)
            return $output;
        else
            echo $output;
    }
?>
