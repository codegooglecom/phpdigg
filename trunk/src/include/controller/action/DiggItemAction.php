<?php

include_once "model/bean/DiggItem.php";
include_once "model/dao/DiggItemDao.php";
include_once "model/service/DiggItemManager.php";

include_once "controller/action/Action.php";

class DiggItemAction extends Action {
	public function __construct() {
		$this->manager = new DiggItemManager();
	}

	public function execute() {
		
	}
	
	public function createDiggItem() {
		$content = $_POST["content"];

		$diggItem = new DiggItem();
		
		$userId = $_COOKIE["userId"] ? $_COOKIE["userId"] : "0";
		$userName = $_COOKIE["userName"] ? $_COOKIE["userName"] : "anonymous";
		
		$diggItem->setUserId($userId);
		$diggItem->setUserName($userName);
		
		$diggItem->setContent($content);
		$diggItem->setGmtCreate(date("Y-m-d H:i:s"));
		
		$userIp = $_SERVER["REMOTE_ADDR"];
		$diggItem->setUserIp($userIp);

		$this->manager->save($diggItem);
		
		$result = $diggItem->toJSONObject();
		
		$result["avator"] = $this->manager->getUserAvator($userId);
		
		return $result;
	}

	public function createImageDiggItem() {
		$name = $_POST["name"];
		$url = $_POST["url"];
		
		if (strlen($name) == 0 || strlen($url) == 0) {
			return null;
		}
	
		$diggItem = new DiggItem();
		
		$username = $_COOKIE["userName"] ? $_COOKIE["userName"] : "anonymous";
		$diggItem->setUserName($username);
		
		$diggItem->setGmtCreate(date("Y-m-d H:i:s"));
		
		$userIp = $_SERVER["REMOTE_ADDR"];
		$diggItem->setUserIp($userIp);
		
		$diggItem->setName($name);
		$diggItem->setUrl($url);
		
		$content = "$username shared image $name <img src='$url' width='64'></img>.";
		
		$diggItem->setContent($content);
		
		$this->manager->save($diggItem);
		
		$result = $diggItem->toJSONObject();
		
		return $result;
	}
	
	public function createMusicDiggItem() {
		$diggItem = new DiggItem();
		
		$username = $_COOKIE["userName"] ? $_COOKIE["userName"] : "anonymous";
		$diggItem->setUserName($username);
		
		$diggItem->setGmtCreate(date("Y-m-d H:i:s"));
		
		$userIp = $_SERVER["REMOTE_ADDR"];
		$diggItem->setUserIp($userIp);
		
		$name = $_POST["name"];
		$url = $_POST["url"];
		
		$diggItem->setName($name);
		$diggItem->setUrl($url);
		
		$content = "$username shared music <a href='$url'>$name</a>.";
		
		$diggItem->setContent($content);
		
		$this->manager->save($diggItem);
		
		$result = $diggItem->toJSONObject();
		
		return $result;
	}
	
	public function diggDiggItem() {
		$id = $_POST["id"];
		$digg = $_COOKIE[$id];

		$result = null;
		if (!$digg) {
			$count = $this->manager->digg($id);

			$result = array(
				"id" => $id,
				"count" => $count,
				"digg" => true
			);

			setcookie($id, "digg", time() + 60 * 60 * 48);
		} else {
			$result = array(
				"id" => $id,
				"count" => $count,
				"digg" => false
			);
		}
		
		return $result;
	}
	
	public function indexDiggItem($page = 1, $size = 5, $order = 'recommend') {
		$resultArray = $this->manager->findAll(array(
			"orderby" => $order,
			"pagination" => array(
				"start" => ($page - 1) * $size ,
				"size" => $size
			)
		));
		$result = array();
		foreach($resultArray as $diggItem) {
			$result[] = $diggItem->toJSONObject();
		}
		return $result;
	}
	
	public function indexDiggItemWithAvator($page = 1, $size = 5, $order = 'recommend') {
		$sql = "SELECT a.digg_item_id AS id, a.digg_item_content AS content, a.gmt_create AS gmtCreate, a.digg_item_recommend AS recommend, b.username AS userName, b.avator_url AS userAvator FROM digg_item a, digg_user b WHERE a.user_id = b.id";
		$sql .= (" ORDER BY $order DESC");
		$start = ($page - 1) * $size;
		$sql .= (" LIMIT $start, $size");
		
		$resultArray = $this->manager->execute($sql);
		return $resultArray;
	}
	
	public function itemCount() {
		$result = $this->manager->count();
		
		return $result;
	}
	
	public function feed() {
		header('Content-Type: application/xml; charset=UTF-8');
		
		$rss = '<?xml version="1.0" encoding="UTF-8"?>';
		
		$rss .= '<rss version="2.0">';
		$rss .= '<channel>';
      	$rss .= '<title>Twigg - 分享你的秘密</title>';
      	$rss .= '<link>http://digg.wjl.cn</link>';
      	$rss .= '<description>秘密分享站点</description>';
      	$rss .= '<language>zh-cn</language>';
      	$rss .= '<webMaster>bbbiao@gmail.com</webMaster>';
      
      	$resultArray = $this->manager->findAll(array(
			"orderby" => "gmtCreate",
		));
		
		$rss .= '<pubDate>' . $resultArray[0]->getGmtCreate() . '</pubDate>';
      	$rss .= '<lastBuildDate>' . $resultArray[0]->getGmtCreate() . '</lastBuildDate>';
		
		foreach($resultArray as $diggItem) {
			$jsonObj = $diggItem->toJSONObject();
			
			$rss .= '<item>';
         	$rss .= '<title>'. $jsonObj["userName"] . ' - ' . $jsonObj["gmtCreate"] . '</title>';
         	$rss .= '<link>http://digg.wjl.cn/digg.php?id='. $jsonObj["id"]. '</link>';
         	$rss .= '<description><![CDATA[' . $jsonObj["content"] . ']]></description>';
         	$rss .= '<pubDate>' . $jsonObj["gmtCreate"] . '</pubDate>';
         	$rss .= '<guid>http://digg.wjl.cn/digg.php?id=' . $jsonObj["id"] . '</guid>';
      		$rss .= '</item>';
		}      	
      	
      	$rss .= '</channel>';
      	$rss .= '</rss>';
      	
      	return $rss;
	}
}

?>