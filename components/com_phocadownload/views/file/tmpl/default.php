<?php
defined('_JEXEC') or die('Restricted access'); 

echo '<div id="phoca-dl-file-box" class="pd-file-view'.$this->params->get( 'pageclass_sfx' ).'" >';

if ( $this->params->get( 'show_page_heading' ) ) { 
	echo '<h1>'. $this->escape($this->params->get('page_heading')) . '</h1>';
}

if (!empty($this->category[0])) {
	echo '<div class="pd-file">';
	if ($this->tmpl['display_up_icon'] == 1 && $this->tmpl['tmplr'] == 0) {
		
		if (isset($this->category[0]->id)) {
			if ($this->category[0]->id > 0) {
				$linkUp = JRoute::_(PhocaDownloadHelperRoute::getCategoryRoute($this->category[0]->id, $this->category[0]->alias));
				$linkUpText = $this->category[0]->title;
			} else {
				$linkUp 	= '#';
				$linkUpText = ''; 
			}
			echo '<div class="pdtop">'
				.'<a title="'.$linkUpText.'" href="'. $linkUp.'" >'
				.JHTML::_('image', 'components/com_phocadownload/assets/images/up.png', JText::_('COM_PHOCADOWNLOAD_UP'))
				.'</a></div>';
		}
	}
} else {
	echo '<div class="pd-file"><div class="pdtop"></div>';
}


if (!empty($this->file[0])) {
	$v = $this->file[0];
	
	// USER RIGHT - Access of categories (if file is included in some not accessed category) - - - - -
	// ACCESS is handled in SQL query, ACCESS USER ID is handled here (specific users)
	$rightDisplay	= 0;
	if (!empty($this->category[0])) {
		$rightDisplay = PhocaDownloadHelper::getUserRight('accessuserid', $v->cataccessuserid, $v->cataccess, $this->tmpl['user']->authorisedLevels(), $this->tmpl['user']->get('id', 0), 0);
	}
	// - - - - - - - - - - - - - - - - - - - - - -
	
	if ($rightDisplay == 1) {
	
		$l = new PhocaDownloadLayout();
	
		echo '<h3 class="pdfv-name">'.$l->getName($v->title, $v->filename, 1). '</h3>';
		
		
// =====================================================================================		
// BEGIN LAYOUT AREA
// =====================================================================================


		if ((int)$this->tmpl['display_file_view'] == 1 || (int)$this->tmpl['display_file_view'] == 2 || (int)$v->confirm_license > 0) {
					
			$pdTitle = '';
			if ($v->title != '') {
				$pdTitle .= '<div class="pd-title">'.$v->title.'</div>';
			}
					
			$pdImage = '';
			if ($v->image_download != '') {
				$pdImage .= '<div class="pd-image">'.$l->getImageDownload($v->image_download).'</div>';		
			}
			
			$pdVideo = '';
			$pdVideo = $l->displayVideo($v->video_filename, 1);
					
			if ($v->filename != '') {
				$imageFileName = $l->getImageFileName($v->image_filename);
				
				$pdFile = '<div class="pd-filenamebox">';
				if ($this->tmpl['filename_or_name'] == 'filenametitle') {
					$pdFile .= '<div class="pd-title">'. $v->title . '</div>';
				}
				
				$pdFile .= '<div class="pd-filename">'. $imageFileName['filenamethumb']
					. '<div class="pd-document'.$this->tmpl['file_icon_size'].'" '
					. $imageFileName['filenamestyle'].'>';
				
				$pdFile .= '<div class="pd-float">';
				$pdFile .= $l->getName($v->title, $v->filename);
				$pdFile .= '</div>';
				
				$pdFile .= PhocaDownloadHelper::displayNewIcon($v->date, $this->tmpl['displaynew']);
				$pdFile .= PhocaDownloadHelper::displayHotIcon($v->hits, $this->tmpl['displayhot']);
				
				//Specific icons
				if (isset($v->image_filename_spec1) && $v->image_filename_spec1 != '') {
					$pdFile .= '<div class="pd-float">'.$l->getImageDownload($v->image_filename_spec1).'</div>';
				} 
				if (isset($v->image_filename_spec2) && $v->image_filename_spec2 != '') {
					$pdFile .= '<div class="pd-float">'.$l->getImageDownload($v->image_filename_spec2).'</div>';
				} 
				
				$pdFile .= '</div></div></div>' . "\n";
			}
					
			$pdFileSize = '';
			$fileSize = $l->getFilesize($v->filename);
			if ($fileSize != '') {
				$pdFileSize .= '<div class="pd-filesize-txt">'.JText::_('COM_PHOCADOWNLOAD_FILESIZE').':</div>';
				$pdFileSize .= '<div class="pd-fl-m">'.$fileSize.'</div>';
			}
					
			$pdVersion = '';
			if ($v->version != '') {
				$pdVersion .= '<div class="pd-version-txt">'.JText::_('COM_PHOCADOWNLOAD_VERSION').':</div>';
				$pdVersion .= '<div class="pd-fl-m">'.$v->version.'</div>';
			}
					
			$pdLicense = '';
			if ($v->license != '') {
				if ($v->license_url != '') {
					$pdLicense .= '<div class="pd-license-txt">'.JText::_('COM_PHOCADOWNLOAD_LICENSE').':</div>';
					$pdLicense .= '<div class="pd-fl-m"><a href="'.$v->license_url.'" target="_blank">'.$v->license.'</a></div>';
				} else {
					$pdLicense .= '<div class="pd-license-txt">'.JText::_('COM_PHOCADOWNLOAD_LICENSE').':</div>';
					$pdLicense .= '<div class="pd-fl-m">'.$v->license.'</div>';
				}
			}
					
			$pdAuthor = '';
			if ($v->author != '') {
				if ($v->author_url != '') {
					$pdAuthor .= '<div class="pd-author-txt">'.JText::_('COM_PHOCADOWNLOAD_AUTHOR').':</div>';
					$pdAuthor .= '<div class="pd-fl-m"><a href="'.$v->author_url.'" target="_blank">'.$v->author.'</a></div>';
				} else {
					$pdAuthor .= '<div class="pd-author-txt">'.JText::_('COM_PHOCADOWNLOAD_AUTHOR').':</div>';
					$pdAuthor .= '<div class="pd-fl-m">'.$v->author.'</div>';
				}
			}
			
			$pdAuthorEmail = '';
			if ($v->author_email != '') {
				$pdAuthorEmail .= '<div class="pd-email-txt">'.JText::_('COM_PHOCADOWNLOAD_EMAIL').':</div>';
				$pdAuthorEmail .= '<div class="pd-fl-m">'. $l->getProtectEmail($v->author_email).'</div>';
			}
					
			$pdFileDate = '';
			$fileDate = $l->getFileDate($v->filename, $v->date);
			if ($fileDate != '') {
				$pdFileDate .= '<div class="pd-date-txt">'.JText::_('COM_PHOCADOWNLOAD_DATE').':</div>';
				$pdFileDate .= '<div class="pd-fl-m">'.$fileDate.'</div>';
			}
					
			$pdDownloads = '';
			if ($this->tmpl['display_downloads'] == 1) {
				$pdDownloads .= '<div class="pd-downloads-txt">'.JText::_('COM_PHOCADOWNLOAD_DOWNLOADS').':</div>';
				$pdDownloads .= '<div class="pd-fl-m">'.$v->hits.' x</div>';
			}
					
			$pdDescription = '';
			if ($l->isValueEditor($v->description)) {
				$pdDescription .= '<div class="pd-fdesc">'.$v->description.'</div>';
			}
			
			$pdFeatures = '';
			if ($l->isValueEditor($v->features)) {
				$pdFeatures .= '<div class="pd-features-txt">'.JText::_('COM_PHOCADOWNLOAD_FEATURES').'</div>';
				$pdFeatures .= '<div class="pd-features">'.$v->features.'</div>';
			}
					
			$pdChangelog = '';
			if ($l->isValueEditor($v->changelog)) {
				$pdChangelog .= '<div class="pd-changelog-txt">'.JText::_('COM_PHOCADOWNLOAD_CHANGELOG').'</div>';
				$pdChangelog .= '<div class="pd-changelog">'.$v->changelog.'</div>';
			}
			
			$pdNotes = '';
			if ($l->isValueEditor($v->notes)) {
				$pdNotes .= '<div class="pd-notes-txt">'.JText::_('COM_PHOCADOWNLOAD_NOTES').'</div>';
				$pdNotes .= '<div class="pd-notes">'.$v->notes.'</div>';
			}
					

			// pdmirrorlink1
			$pdMirrorLink1 = '';
			$mirrorOutput1 = PhocaDownloadHelper::displayMirrorLinks(1, $v->mirror1link, $v->mirror1title, $v->mirror1target);
			if ($mirrorOutput1 != '') {
				
				if ($this->tmpl['display_mirror_links'] == 4 || $this->tmpl['display_mirror_links'] == 6) {
					$classMirror = 'pd-button-mirror1';
				} else {
					$classMirror = 'pd-mirror';
				}
				
				$pdMirrorLink1 = '<div class="'.$classMirror.'">'.$mirrorOutput1.'</div>';
			}

			// pdmirrorlink2
			$pdMirrorLink2 = '';
			$mirrorOutput2 = PhocaDownloadHelper::displayMirrorLinks(1, $v->mirror2link, $v->mirror2title, $v->mirror2target);
			if ($mirrorOutput2 != '') {
				if ($this->tmpl['display_mirror_links'] == 4 || $this->tmpl['display_mirror_links'] == 6) {
					$classMirror = 'pd-button-mirror2';
				} else {
					$classMirror = 'pd-mirror';
				}
			
				$pdMirrorLink2 = '<div class="'.$classMirror.'">'.$mirrorOutput2.'</div>';
			}
			
			// pdreportlink
			$pdReportLink = PhocaDownloadHelper::displayReportLink(1, $v->title);

			
			// pdrating
			$pdRating 	= PhocaDownloadRateHelper::renderRateFile($v->id, $this->tmpl['display_rating_file']);
			
			// pdtags
			$pdTags = '';
			if ($this->tmpl['display_tags_links'] == 2 || $this->tmpl['display_tags_links'] == 3) {
				if ($l->displayTags($v->id) != '') {
					$pdTags .= $l->displayTags($v->id);
				}
			
			}

			
			// ---------------------------------------------------
			//Convert
			// ---------------------------------------------------
			if ($this->tmpl['display_specific_layout'] == 0) {
				echo '<div class="pd-filebox">';
				//echo $pdTitle;
				echo $pdImage;
				echo $pdFile;
				echo $pdFileSize;
				echo $pdVersion;
				echo $pdLicense;
				echo $pdAuthor;
				echo $pdAuthorEmail;
				echo $pdFileDate;
				echo $pdDownloads;
				echo $pdDescription;
				echo $pdFeatures;
				echo $pdChangelog;
				echo $pdNotes;
				if ($this->tmpl['display_mirror_links'] == 5 || $this->tmpl['display_mirror_links'] == 6) {
				echo '<div class="pd-buttons">'.$pdMirrorLink2.'</div>';
				echo '<div class="pd-buttons">'.$pdMirrorLink1.'</div>';
				} else if ($this->tmpl['display_mirror_links'] == 2 || $this->tmpl['display_mirror_links'] == 3) {
					echo '<div class="pd-mirrors">'.$pdMirrorLink2.$pdMirrorLink1.'</div>';
				}
				
				echo '<div class="pd-report">'.$pdReportLink.'</div>';
				echo '<div class="pd-rating">'.$pdRating.'</div>';
				echo '<div class="pd-tags">'.$pdTags.'</div>';
				echo '<div class="pd-video">'.$pdVideo.'</div>';
				echo '<div class="pd-cb"></div>';
				echo '</div>';
			} else {
			
				/*$fileLayout = '<div class="pd-filebox">
				{pdimage}
				{pdfile}
				{pdfilesize}
				{pdversion}
				{pdlicense}
				{pdauthor}
				{pdauthoremail}
				{pdfiledate}
				{pddownloads}
				{pddescription}
				{pdfeatures}
				{pdchangelog}
				{pdnotes}
				<div class="pd-mirrors">{pdmirrorlink2} {pdmirrorlink1}</div>
				<div class="pd-report">{pdreportlink}</div>
				<div class="pd-rating">{pdrating}</div>
				<div class="pd-tags">{pdtags}</div>
				<div class="pd-cb"></div>
				</div>';*/
			
			
				$fileLayout 		= PhocaDownloadHelper::getLayoutText('file');
				$fileLayoutParams 	= PhocaDownloadHelper::getLayoutParams('file');
				
				$replace	= array($pdTitle, $pdImage, $pdFile, $pdFileSize, $pdVersion, $pdLicense, $pdAuthor, $pdAuthorEmail, $pdFileDate, $pdDownloads, $pdDescription, $pdFeatures, $pdChangelog, $pdNotes, $pdMirrorLink1, $pdMirrorLink2, $pdReportLink, $pdRating, $pdTags, $pdVideo);
				$output		= str_replace($fileLayoutParams['search'], $replace, $fileLayout);
				
				echo $output;
			}

			// ---------------------------------------------------	
			
			
			$o = '<div class="pd-cb">&nbsp;</div>';
			
			if ((int)$v->confirm_license > 0) {
				$o .= '<h4 class="pdfv-confirm-lic-text">'.JText::_('COM_PHOCADOWNLOAD_LICENSE_AGREEMENT').'</h4>';
				$o .= '<div id="phoca-dl-license" style="height:'.(int)$this->tmpl['licenseboxheight'].'px">'.$v->licensetext.'</div>';
				
				// External link
				if ($v->link_external != '' && $v->directlink == 1) {	
					$o .= '<form action="" name="phocaDownloadForm" id="phocadownloadform" target="'.$this->tmpl['download_external_link'].'">';	
					$o .= '<input type="checkbox" name="license_agree" onclick="enableDownloadPD()" /> <span>'.JText::_('COM_PHOCADOWNLOAD_I_AGREE_TO_TERMS_LISTED_ABOVE').'</span> ';
					$o .= '<input type="button" name="submit" onClick="location.href=\''.$v->link_external.'\';" id="pdlicensesubmit" value="'.JText::_('COM_PHOCADOWNLOAD_DOWNLOAD').'" />';
				} else {
					$o .= '<form action="'.$this->request_url.'" method="post" name="phocaDownloadForm" id="phocadownloadform">';
					$o .= '<input type="checkbox" name="license_agree" onclick="enableDownloadPD()" /> <span>'.JText::_('COM_PHOCADOWNLOAD_I_AGREE_TO_TERMS_LISTED_ABOVE').'</span> ';
					$o .= '<input type="submit" name="submit" id="pdlicensesubmit" value="'.JText::_('COM_PHOCADOWNLOAD_DOWNLOAD').'" />';
					$o .= '<input type="hidden" name="download" value="'.$v->id.'" />';
					$o .= '<input type="hidden" name="'. JUtility::getToken().'" value="1" />';
				}
				$o .= '</form>';

				// For users who have disabled Javascript
				$o .= '<script type=\'text/javascript\'>document.forms[\'phocadownloadform\'].elements[\'pdlicensesubmit\'].disabled=true</script>';
			} else {
				// External link
				if ($v->link_external != '') {	
					$o .= '<form action="" name="phocaDownloadForm" id="phocadownloadform" target="'.$this->tmpl['download_external_link'].'">';
					$o .= '<input type="button" name="submit" onClick="location.href=\''.$v->link_external.'\';" id="pdlicensesubmit" value="'.JText::_('COM_PHOCADOWNLOAD_DOWNLOAD').'" />';
				} else {
					$o .= '<form action="'.$this->request_url.'" method="post" name="phocaDownloadForm" id="phocadownloadform">';
					$o .= '<input type="submit" name="submit" id="pdlicensesubmit" value="'.JText::_('COM_PHOCADOWNLOAD_DOWNLOAD').'" />';
					$o .= '<input type="hidden" name="license_agree" value="1" />';
					$o .= '<input type="hidden" name="download" value="'.$v->id.'" />';
					$o .= '<input type="hidden" name="'. JUtility::getToken().'" value="1" />';
				}
				$o .= '</form>';
			}
			/* TODO Joomla! returns error message
			if (JComponentHelper::isEnabled('com_jcomments', true) && $this->tmpl['display_file_comments'] == 1) {
				include_once(JPATH_BASE.DS.'components'.DS.'com_jcomments'.DS.'jcomments.php');
				$o .= JComments::showComments($v->id, 'com_phocadownload_files', JText::_('COM_PHOCADOWNLOAD_FILE') .' '. $v->title);
			}*/
			
			if ($this->tmpl['display_file_comments'] == 2) {
				$o .= '<div class="pd-fbcomments">'.$this->loadTemplate('comments-fb').'</div>';
			}
			
			echo $o;
		
		} else {
			echo '<h3 class="pd-filename-txt">'.JText::_('COM_PHOCADOWNLOAD_FILE') .'</h3>';
			echo '<div class="pd-error">'.JText::_('COM_PHOCADOWNLOAD_NO_RIGHTS_ACCESS_CATEGORY').'</div>';
		}
	}
	echo '<div>&nbsp;</div>';// end of box
} else {
	echo '<div>&nbsp;</div>';
}
echo '</div></div><div class="pd-cb">&nbsp;</div>'. $this->tmpl['phoca_dwnld'];
?>