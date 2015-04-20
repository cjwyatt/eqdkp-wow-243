<?php

if (!defined('EQDKP_INC')) {
	header('HTTP/1.0 404 Not Found');
	exit ;
}

if (!class_exists('wow243')) {
	class wow243 extends game_generic {
		public $version = '0.1';
		protected $this_game = 'wow243';
		protected $types = array('factions', 'races', 'classes', 'talents', 'roles', 'classrole', 'professions', 'filters');
		public $langs = array('english');
		protected static $apiLevel = 20;
		
		protected $classes			= array();
		protected $roles			= array();
		protected $races			= array();															// for each type there must be the according var
		protected $factions			= array();															// and the according function: load_$type
		protected $professions		= array();
		protected $filters			= array();
		
		protected $class_dependencies = array(
			array(
				'name'		=> 'faction',
				'type'		=> 'factions',
				'admin' 	=> true,
				'decorate'	=> false,
				'parent'	=> false,
			),
			array(
				'name'		=> 'race',
				'type'		=> 'races',
				'admin'		=> false,
				'decorate'	=> true,
				'parent'	=> array(
					'faction' => array(
						'alliance'	=> array(0,1,2,3,4,9),
						'horde'		=> array(0,5,6,7,8,10),
					),
				),
			),
			array(
				'name'		=> 'class',
				'type'		=> 'classes',
				'admin'		=> false,
				'decorate'	=> true,
				'primary'	=> true,
				'colorize'	=> true,
				'roster'	=> true,
				'recruitment' => true,
				'parent'	=> array(
					'race' => array(
						0 	=> 'all',							// Unknown
						1 	=> array(0,3,6,8,9),				// Gnome
						2 	=> array(0,3,4,5,8,9),				// Human
						3 	=> array(0,2,4,5,6,9),				// Dwarf
						4 	=> array(0,1,2,5,6,9),				// Night Elf
						5 	=> array(0,2,3,5,6,7,9),			// Troll
						6 	=> array(0,3,5,6,8,9),				// Undead
						7 	=> array(0,2,6,7,8,9),				// Orc
						8 	=> array(0,1,2,7,9),				// Tauren
						9 	=> array(0,2,3,4,5,7,9),			// Draenai
						10 	=> array(0,2,3,4,5,6,8),			// Blood Elf
					),
				),
			),
			array(
				'name'		=> 'spec',
				'type'		=> 'talents',
				'admin'		=> false,
				'decorate'	=> false,
				'recruitment' => true,
				'parent'	=> array(
					'class' => array(
						0 	=> 'all',			// Unknown
						1 	=> array(0,1,2,3),	// Druid
						2 	=> array(4,5,6),	// Hunter
						3 	=> array(7,8,9),	// Mage
						4 	=> array(10,11,12),	// Paladin
						5 	=> array(13,14,15),	// Priest
						6 	=> array(16,17,18),	// Rogue
						7 	=> array(19,20,21),	// Shaman
						8 	=> array(22,23,24),	// Warlock
						9 	=> array(25,26,27),	// Warrior
					),
				),
			),
		);
		
		public $default_roles = array(
			1	=> array(1, 4, 9),			// Tank
			2	=> array(1, 4, 7),			// Healer
			3	=> array(1, 4, 6, 7, 9),			// Melee DPS
			4	=> array(1, 2, 5, 7, 8)		// Ranged DPS
		);
		
		public $default_classrole = array(
			1	=> 3,	// Druid
			2	=> 4,	// Hunter
			3	=> 4,	// Mage
			4	=> 3,	// Paladin
			5	=> 2,	// Priest
			6	=> 3,	// Rogue
			7	=> 3,	// Shaman
			8	=> 4,	// Warlock
			9	=> 1,	// Warrior
		);
		
		protected $class_colors = array(
			1	=> '#C41F3B',
			2	=> '#FF7C0A',
			3	=> '#AAD372',
			4	=> '#68CCEF',
			5	=> '#F48CBA',
			6	=> '#FFFFFF',
			7	=> '#FFF468',
			8	=> '#1a3caa',
			9	=> '#9382C9',
			10	=> '#C69B6D',
			11	=> '#00C77B',
		);
		
		protected $ArrInstanceCategories = array(
			'classic'	=> array(2717, 2677, 3429, 3428),
			'bc'		=> array(3457, 3836, 3923, 3607, 3845, 3606, 3959, 4075),
			'wotlk'		=> array(4603, 3456, 4493, 4500, 4273, 2159, 4722, 4812, 4987),
			'cataclysm'	=> array(5600, 5094, 5334, 5638, 5723, 5892),
			'mop'		=> array(6125, 6297, 6067, 6622, 6738),
			'wod'		=> array(6967, 6996),
		);
		
		protected $glang		= array();
		protected $lang_file	= array();
		protected $path			= '';
		public $lang			= false;
		
		public function install($blnEQdkpInstall=false) {
			$arrEventIDs = array();
			$arrEventIDs[] = $this->game->addEvent($this->glang('tbc_kar'), 0, "kar.png");
			$arrEventIDs[] = $this->game->addEvent($this->glang('tbc_za'), 0, "za.png");
			$arrEventIDs[] = $this->game->addEvent($this->glang('tbc_gru'), 0, "gru.png");
			$arrEventIDs[] = $this->game->addEvent($this->glang('tbc_mag'), 0, "mag.png");

			$this->game->updateDefaultMultiDKPPool('Default', 'Default MultiDKPPool', $arrEventIDs);
		
			//Links
			$this->game->addLink('Excalibur WoW', 'http://www.excalibur-wow.com/');
			
			//Ranks
			$this->game->addRank(0, "Guildmaster");
			$this->game->addRank(1, "Officer");
			$this->game->addRank(2, "Veteran");
			$this->game->addRank(3, "Member");
			$this->game->addRank(4, "Initiate", true);
			$this->game->addRank(5, "Dummy Rank #1");
			$this->game->addRank(6, "Dummy Rank #2");
			$this->game->addRank(7, "Dummy Rank #3");
			$this->game->addRank(8, "Dummy Rank #4");
			$this->game->addRank(9, "Dummy Rank #5");
		}
		
		public function uninstall() {
			$this->game->removeLink('Excalibur WoW');
		}
		
		public function decorate_classes($class_id, $profile=array(), $size=16, $pathonly=false) {
			$big = ($size > 40) ? '_b' : '';
			if(is_file($this->root_path.'games/'.$this->this_game.'/icons/classes/'.$class_id.$big.'.png')){
				$icon_path = $this->server_path.'games/'.$this->this_game.'/icons/classes/'.$class_id.$big.'.png';
				return ($pathonly) ? $icon_path : '<img src="'.$icon_path.'" height="'.$size.'" alt="class '.$class_id.'" class="'.$this->this_game.'_classicon classicon'.'" title="'.$this->game->get_name('classes', $class_id).'" />';
			}
			return false;
		}
		
		public function profilefields() {
			$this->load_type('professions', array($this->lang));
			$this->load_type('realmlist', array($this->lang));
			$xml_fields = array(
				'servername'	=> array(
					'category'		=> 'character',
					'lang'			=> 'servername',
					'type'			=> 'text',
					'size'			=> '21',
					'edecode'		=> true,
					'autocomplete'	=> $this->realmlist[$this->lang],
					'undeletable'	=> true,
					'sort'			=> 1
				),
				'level'	=> array(
					'type'			=> 'spinner',
					'category'		=> 'character',
					'lang'			=> 'uc_level',
					'max'			=> 70,
					'min'			=> 1,
					'undeletable'	=> true,
					'sort'			=> 2
				),
				'health_bar'	=> array(
					'type'			=> 'int',
					'category'		=> 'character',
					'lang'			=> 'uc_bar_health',
					'undeletable'	=> true,
					'size'			=> 4,
					'sort'			=> 3
				),
				'second_bar'	=> array(
					'type'			=> 'int',
					'category'		=> 'character',
					'lang'			=> 'uc_bar_2value',
					'size'			=> 4,
					'undeletable'	=> true,
					'sort'			=> 4
				),
				'prof1_name'	=> array(
					'type'			=> 'dropdown',
					'category'		=> 'profession',
					'lang'			=> 'uc_prof1_name',
					'options'		=> $this->professions[$this->lang],
					'undeletable'	=> true,
					'image'			=> "games/wow/profiles/professions/{VALUE}.jpg",
					'options_lang'	=> "professions",
					'sort'			=> 1,
				),
				'prof1_value'	=> array(
					'type'			=> 'int',
					'category'		=> 'profession',
					'lang'			=> 'uc_prof1_value',
					'size'			=> 4,
					'undeletable'	=> true,
					'sort'			=> 2
				),
				'prof2_name'	=> array(
					'type'			=> 'dropdown',
					'category'		=> 'profession',
					'lang'			=> 'uc_prof2_name',
					'options'		=> $this->professions[$this->lang],
					'undeletable'	=> true,
					'image'			=> "games/wow/profiles/professions/{VALUE}.jpg",
					'options_lang'	=> "professions",
					'sort'			=> 3,
				),
				'prof2_value'	=> array(
					'type'			=> 'int',
					'category'		=> 'profession',
					'lang'			=> 'uc_prof2_value',
					'size'			=> 4,
					'undeletable'	=> true,
					'sort'			=> 4
				),
			);
			
			return $xml_fields;
		}
		
		protected function load_filters($langs) {
		}
	}

}