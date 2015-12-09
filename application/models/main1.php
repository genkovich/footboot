<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main
 *
 * @author genkovich
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main1 extends CI_Model {

    private $items_to_display = 5;
    private $url;
    public $data;

    function __construct() {
        $this->url = "http://www.telegraph.co.uk/sport/football/competitions/premier-league/rss";
    }

    public function get_video() {
        $urlvid         = "http://www.premierleague.com/en-gb/videos.html";
        $ch             = curl_init();
        $timeout        = 0;
        curl_setopt($ch, CURLOPT_URL, $urlvid);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36");
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $rawdata        = curl_exec($ch);
        curl_close($ch);
        preg_match_all('/showVideoOverlay.(.*).;return false/i', $rawdata, $matches1);
        preg_match_all('/<a title="(.*)" onclick/i', $rawdata, $matches2);
        $data['titles'] = $matches2[1];
        $data['video']  = $matches1[1];
        return $data;
    }

    public function get_news() {
        $rss = simplexml_load_file($this->url);
        if ($rss) {
            $items      = $rss->channel->item;
            $item_count = 0;

            foreach ($items as $item) {
                $news[$item_count]['title']   = $item->title;
                $news[$item_count]['pic']     = $item->enclosure['url'];
                $description_temp             = $item->description;
                preg_match('~(.*)<br clear=\'all\'/>~i', $description_temp, $matches);
                $news[$item_count]['desc']    = $matches[1];
                $ts                           = strtotime($item->pubDate);
                $news[$item_count]['pubDate'] = date("Y-m-d", $ts);
                if (++$item_count >= $this->items_to_display)
                    break;
            }
            return $news;
        }
    }

    public function get_video_links() {
        $videos = $this->get_video();
        foreach ($videos['video'] as $video) {
            $link[] = 'http://admin.brightcove.com/viewer/us20150903.1327/BrightcoveBootloader.swf?playerID=2522850455001&playerKey=AQ~~%2CAAACSBmEp-k~%2Ck6M0BLQIXJ_fOxXUjJd4CUhd7yHzmz9-&%40videoPlayer=' . $video . '&autoStart=&bgcolor=%23FFFFFF&debuggerID=&dynamicStreaming=true&flashID=myExperience_3635a929d2c34bc4b58ac66f8fd7d8db&height=400&htmlFallback=true&includeAPI=true&isUI=true&isVid=true&originalTemplateReadyHandler=BCL.onTemplateReady&startTime=1449444235660&templateErrorHandler=BCL.onPlayerError&templateLoadHandler=BCL.onTemplateLoad&templateReadyHandler=brightcove%5B%22templateReadyHandlermyExperience_3635a929d2c34bc4b58ac66f8fd7d8db%22%5D&width=210&wmode=transparent';
        }
        return $link;
    }

}
