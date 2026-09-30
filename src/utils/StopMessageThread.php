<?php

class StopMessageThread extends Thread
{
	private $page, $msg, $name;
	public function __construct(PocketMinecraftServer $server, $msg){
		if($server->extraprops->get("discord-msg") == true and ($this->page = $server->extraprops->get("discord-webhook-url")) !== "none"){
			$this->msg = $server->extraprops->get("discord-ru-smiles") ? str_replace("@", " ", str_replace("�", "<:ru_cool:960113011383738369>", str_replace("�", "<:ru_cry:960112920346390548>", str_replace("�", "<:ru_happy:960112868601237504>", $msg)))) : str_replace("@", "", $msg);
			$this->name = $server->extraprops->get("discord-bot-name");
			$this->start();
		}
		
	}
	
	public function run(){
		Utils::curl_post($this->page, [
			"username" => $this->name,
			"content" => $this->msg
		]);
	}
}