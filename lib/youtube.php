<?php
/*
 ***********************************************************/
/**
 * @name          : Facebook Page Builder.
 * @version	      : 1.2
 * @package       : apptha
 * @since         : Joomla 1.6
 * @subpackage    : Facebook Page Builder.
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @abstract      : Customize facebook fanpage design and controll it from this component.
 * @Creation Date : July 20 2011
 * @Modified Date : November 8 2011
 * */

/*
 ***********************************************************/

$ytb_pattern = "@youtube.com\/watch\?v=([0-9a-zA-Z_-]*)@i";

if (preg_match($ytb_pattern, stripslashes($_GET['youtube-value']), $match)) {

    /* Get youtube video details ,preview image, thumb image etc */

    $youtube_data = hd_GetSingleYoutubeVideo($match[1]);

    if ($youtube_data) {
        $thumb_path = $youtube_data['thumbnail_url'];
        $videoPath = 'http://www.youtube.com/embed/' . $youtube_data['id'];
        $width = $_GET['width'];
        $height = $_GET['height'];

        echo '<iframe width="' . $width . '" height="' . $height . '" src="' . $videoPath . '?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
    }
} else {

    /* Set error message. */
    echo '<div style="color:red">Please enter a A Valid YouTube URL!<div>';
}

/* * ********************************************************** Return Youtube single video******************************************************** */

function hd_GetSingleYoutubeVideo($youtube_media) {

    if ($youtube_media == '')
        return;

    $url = 'http://gdata.youtube.com/feeds/api/videos/' . $youtube_media;

    $ytb = hd_ParseYoutubeDetails(hd_GetYoutubePage($url));

    return $ytb[0];
}

/* * ********************************************************* Parse xml from Youtube****************************************************************** */

function hd_ParseYoutubeDetails($ytvideo_xml) {

    // Create parser, fill it with xml then delete it

    $yt_xml_parser = xml_parser_create();

    xml_parse_into_struct($yt_xml_parser, $ytvideo_xml, $yt_vals);

    xml_parser_free($yt_xml_parser);

    // Init individual entry array and list array

    $yt_video = array();

    $yt_vidlist = array();

    // is_entry tests if an entry is processing

    $is_entry = TRUE;

    // is_author tests if an author tag is processing

    $is_author = FALSE;

    foreach ($yt_vals as $yt_elem) {

        // If no entry is being processed and tag is not start of entry, skip tag

        if (!$is_entry && $yt_elem['tag'] != 'ENTRY')
            continue;

        // Processed tag
        switch ($yt_elem['tag']) {

            case 'ENTRY' :
                if ($yt_elem['type'] == 'open') {

                    $is_entry = TRUE;

                    $yt_video = array();
                } else {

                    $yt_vidlist[] = $yt_video;

                    $is_entry = FALSE;
                }
                break;
            case 'ID' :

                $yt_video['id'] = substr($yt_elem['value'], -11);

                $yt_video['link'] = $yt_elem['value'];

                break;

            case 'PUBLISHED' :

                $yt_video['published'] = substr($yt_elem['value'], 0, 10) . ' ' . substr($yt_elem['value'], 11, 8);

                break;
            case 'UPDATED' :

                $yt_video['updated'] = substr($yt_elem['value'], 0, 10) . ' ' . substr($yt_elem['value'], 11, 8);

                break;
            case 'MEDIA:TITLE' :

                $yt_video['title'] = $yt_elem['value'];

                break;
            case 'MEDIA:KEYWORDS' :

                $yt_video['tags'] = $yt_elem['value'];

                break;
            case 'MEDIA:DESCRIPTION' :

                $yt_video['description'] = $yt_elem['value'];

                break;
            case 'MEDIA:CATEGORY' :

                $yt_video['category'] = $yt_elem['value'];

                break;
            case 'YT:DURATION' :

                $yt_video['duration'] = $yt_elem['attributes'];

                break;
            case 'MEDIA:THUMBNAIL' :
                if ($yt_elem['attributes']['HEIGHT'] == 240) {

                    $yt_video['thumbnail'] = $yt_elem['attributes'];

                    $yt_video['thumbnail_url'] = $yt_elem['attributes']['URL'];
                }
                break;
            case 'YT:STATISTICS' :

                $yt_video['viewed'] = $yt_elem['attributes']['VIEWCOUNT'];

                break;
            case 'GD:RATING' :

                $yt_video['rating'] = $yt_elem['attributes'];

                break;
            case 'AUTHOR' :

                $is_author = ($yt_elem['type'] == 'open');

                break;
            case 'NAME' :
                if ($is_author)
                    $yt_video['author_name'] = $yt_elem['value'];

                break;
            case 'URI' :
                if ($is_author)
                    $yt_video['author_uri'] = $yt_elem['value'];

                break;
            default :
        }
    }

    unset($yt_vals);

    return $yt_vidlist;
}

/* * ************************************************************ Returns content of a remote page************************************************************ */
/* Still need to do it without curl */

function hd_GetYoutubePage($url) {

    // Try to use curl first

    if (function_exists('curl_init')) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $xml = curl_exec($ch);

        curl_close($ch);
    }
    // If not found, try to use file_get_contents (requires php > 4.3.0 and allow_url_fopen)
    else {
        $xml = @file_get_contents($url);
    }

    return $xml;
}

?>