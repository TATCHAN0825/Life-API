<?php

namespace apart\LifeAPI\Form;

use pocketmine\form\Form;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;


class moneyForm implements Form
{
	private $money;

	public function __construct(Config $money)
	{
		$this->money = $money;
	}

	public function handleResponse(Player $player, $data): void
	{
		if ($data === null) {
			//フォームが閉じられた場合
			$player->sendMessage(TextFormat::RED . "フォームが閉じられました。");
			return;//ここで処理を終了
		}
		switch ($data) {
			case 0:
				//日本語で挨拶する
				$player->chat("こんにちは！");
				break;
			case 1:
				//英語で挨拶する
				$player->chat("Hello!");
				break;
			case 2:
				//りんごを取得する
				$inventory = $player->getInventory();
				$item = Item::get(Item::APPLE, 0, 1);
				if ($inventory->canAddItem($item)) {//アイテムが追加可能か調べる
					$player->getInventory()->addItem($item);//アイテムを追加する
					$player->sendMessage("りんごを取得しました！");
				} else {
					$player->sendMessage(TextFormat::RED . "アイテムを追加できませんでした。");
				}
				break;
			case 3:
				//テストボタン
				$player->sendMessage("テストボタンが押されました。");
				break;
		}
	}

	public function jsonSerialize()
	{
		return [
			"type" => "form",
			"title" => "§l§aマネーMENU",
			"content" => "自由に選択してね。",
			"buttons" => [
				[
					"text" => "§l送金する",
				],
				[
				    "text" => "所持金を確認する",
				],
				[
					"text" => "他のプレイヤーの所持金を見る",
				],


			],
		];
	}
}