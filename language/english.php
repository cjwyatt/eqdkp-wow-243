<?php
if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}
					
$english_array = array (
	'factions' => array(
		'alliance' => 'Alliance',
		'horde' => 'Horde',
  	),
	'races' => array(
		0 => 'Unknown',
		1 => 'Gnome',
		2 => 'Human',
		3 => 'Dwarf',
		4 => 'Night Elf',
		5 => 'Troll',
		6 => 'Undead',
		7 => 'Orc',
		8 => 'Tauren',
		9 => 'Draenei',
		10 => 'Blood Elf',
		11 => 'Worgen',
		12 => 'Goblin',
		13 => 'Pandaren',
	),
	'classes' => array(
		0 => 'Unknown',
		1 => 'Druid',
		2 => 'Hunter',
		3 => 'Mage',
		4 => 'Paladin',
		5 => 'Priest',
		6 => 'Rogue',
		7 => 'Shaman',
		8 => 'Warlock',
		9 => 'Warrior',
	),
	'talents' => array(
		0 => 'Balance',
		1 => 'Feral DPS',
		2 => 'Feral Tank',
		3 => 'Restoration',
		4 => 'Beast Mastery',
		5 => 'Marksmanship',
		6 => 'Survival',
		7 => 'Arcane',
		8 => 'Fire',
		9 => 'Frost',
		10 => 'Holy',
		11 => 'Protection',
		12 => 'Retribution',
		13 => 'Discipline',
		14 => 'Holy',
		15 => 'Shadow',
		16 => 'Assassination',
		17 => 'Combat',
		18 => 'Subtlety',
		19 => 'Elemental',
		20 => 'Enhancement',
		21 => 'Restoration',
		22 => 'Affliction',
		23 => 'Demonology',
		24 => 'Destruction',
		25 => 'Arms',
		26 => 'Fury',
		27 => 'Protection',
	),
	'roles' => 
		array (
			1 => 'Tank',
			2 => 'Healer',
			3 => 'Melee DPS',
			4 => 'Ranged DPS'
		),
	'professions' => array(
		'trade_alchemy' => 'Alchemy',
		'trade_blacksmithing' => 'Blacksmithing',
		'trade_engraving' => 'Enchanting',
		'trade_engineering' => 'Engineering',
		'trade_herbalism' => 'Herbalism',
		'inv_inscription_tradeskill01' => 'Inscription',
		'inv_misc_gem_01' => 'Jewelcrafting',
		'trade_leatherworking' => 'Leatherworking',
		'inv_pick_02' => 'Mining',
		'inv_misc_pelt_wolf_01' => 'Skinning',
		'trade_tailoring' => 'Tailoring',
	),
	'realmlist' => array(
		0 => 'Excalibur-WoW',
	),
	'lang' =>
		array (
			'wow243' => 'World of Warcraft 2.4.3',
			'uc_faction' => 'Faction',
			'uc_level' => 'Level',
			'uc_bar_health' => 'Total HP Unbuffed',
			'uc_bar_2value' => 'Total Mana Unbuffed (if applicable)',
			'uc_race' => 'Race',
			'uc_class' => 'Class',
			'uc_spec' => 'Spec',
			'core_sett_fs_gamesettings' => 'WoW Settings',
			'uc_prof1_value' => 'Level of the first profession',
			'uc_prof1_name' => 'Name of the first profession',
			'uc_prof2_value' => 'Level of the second profession',
			'uc_prof2_name' => 'Name of the second profession',
			'uc_prof_professions' => 'Professions',
			'health' => 'Health',
			'uc_bar_mana' => 'Mana',
			'servername' => 'Realm',
			'burning_crusade' => 'The Burning Crusade',
			'tbc_kar' => 'Karazahn',
			'tbc_za' => "Zul'Aman",
			'tbc_gru' => "Gruul's Lair",
			'tbc_mag' => "Magtheridon",
		),
);