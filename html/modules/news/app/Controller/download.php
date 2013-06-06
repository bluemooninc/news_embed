<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/05
 * Time: 13:13
 * To change this template use File | Settings | File Templates.
 */


//include_once 'header.php';
//include("../../mainfile.php");
include_once _MY_MODULE_PATH . '/fileup.ini.php';
include_once _MY_MODULE_PATH . '/include/browser.php';
include_once _MY_MODULE_PATH . "/class/mbfunction.class.php";
include_once _MY_MODULE_PATH . "/class/download.class.php";
include_once _MY_MODULE_PATH . "/class/class.sfiles.php";

class Controller_Download extends AbstractAction
{
	public function action_index()
	{
		$this->template = 'news_submit.html';
	}

	public function action_view()
	{
		global $xoopsUser;
		ini_set("memory_limit", "40M");

		if (!is_object($xoopsUser) && GUEST_DOWNLOAD == 0) {
			redirect_header(XOOPS_URL . "/user.php", 2, _FILEUP_ERROR);
			exit();
		}
		$downloadname = htmlspecialchars(rawurldecode($_GET['url']), ENT_QUOTES);
		$realfilename = htmlspecialchars(rawurldecode($_GET['filename']), ENT_QUOTES);
		$fpathname = XOOPS_ROOT_PATH . "/uploads/" . $realfilename;
		if (!file_exists($fpathname)) {
			print("Error - ($fpathname) $downloadname does not exist.");
			return;
		}
		$down = new download($downloadname);
		$ctype = $down->contentType();
// Get real name for client browser
		$sfiles = new sFiles();
		$dl_filename = $sfiles->getRealNameByDownloadName($downloadname);

		$mb = new mb_func();
		ob_clean();
		$browser = $version = 0;
		UsrBrowserAgent($browser, $version);
		@ignore_user_abort();
		@set_time_limit(0);
		if ($browser == 'IE' && (ini_get('zlib.output_compression'))) {
			ini_set('zlib.output_compression', 'Off');
		}
		/*if (!empty($content_encoding)) {
			header('Content-Encoding: ' . $content_encoding);
		}*/
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . filesize($fpathname));
		header("Content-type: " . $ctype);
		header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Last-Modified: ' . date("D M j G:i:s T Y"));
		header('Content-Disposition: attachment; filename="' . $downloadname .'"'); //$mb->cnv_mbstr4browser($dl_filename, $browser));
//header('Content-Disposition: attachment; filename="' . $dl_filename . '"');
//header("Content-Disposition: inline; " . $mb->cnv_mbstr4browser($dl_filename,$browser));
		if ($browser == 'IE') {
			header('Pragma: public');
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		} else {
			header('Pragma: no-cache');
		}
		$fp = fopen($fpathname, 'r');
		while (!feof($fp)) {
			$buffer = fread($fp, 1024 * 6); //speed-limit 64kb/s
			print $buffer;
			flush();
			ob_flush();
			usleep(10000);
		}
		fclose($fp);
	}
}