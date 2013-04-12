<?php

namespace Pluralize;

class RuleSet
{
	/**
	 * @var array
	 */
	public $pluralRules = array(
		'/$/' => 's',
		'/s$/' => 's',
		'/(ese)$/' => '$1',
		'/^(ax|test)is$/' => '$1es',
		'/([au]s)$/' => '$1es',
		'/(e[mn]u)s?$/' => '$1s',
		'/([^l]ias|[aeiou]las|[emjzr]as)$/' => '$1',
		'/(alumn|syllab|octop|vir|radi|nucle|fung|cact|stimul|termin|bacill|foc)(us|i)$/' => '$1i',
		'/^(alumn|alg|vertebr)(a|ae)$/' => '$1ae',
		'/(bu)s$/' => '$1ses',
		'/([^aeiou])o$/' => '$1oes',
		'/^(agend|addend|millenni|dat|extrem|bacteri|desiderat|strat|candelabr|errat|ov|symposi)(a|um)$/' => '$1a',
		'/^(apheli|hyperbat|periheli|asyndet|noumen|phenomen|criteri|organ|prolegomen|\w+hedr)(a|on)$/' => '$1a',
		'/sis$/' => 'ses',
		'/(?:([^f])fe|(ar|l|[eo][ao])f)$/' => '$1$2ves',
		'/([^aeiouy]|qu)y$/' => '$1ies',
		'/(x|ch|ss|sh|zz)$/' => '$1es',
		'/(matr|cod|mur|sil|vert|ind)(ix|ex)$/' => '$1ices',
		'/^(m|l)(ice|ouse)$/' => '$1ice',
		'/(pe)(rson|ople)$/' => '$1ople',
		'/(child)(ren)?$/' => '$1ren',
		'/(eau)x?$/' => '$1x',
		'/m(a|e)n$/' => 'men',
	);

	/**
	 * @var array
	 */
	public $irregularRules = array(
		'i' => 'we',
		'me' => 'us',
		'he' => 'they',
		'she' => 'they',
		'them' => 'them',
		'myself' => 'ourselves',
		'yourself' => 'yourselves',
		'itself' => 'themselves',
		'herself' => 'themselves',
		'himself' => 'themselves',
		'themself' => 'themselves',
		'canto' => 'cantos',
		'hetero' => 'heteros',
		'photo' => 'photos',
		'zero' => 'zeros',
		'piano' => 'pianos',
		'portico' => 'porticos',
		'pro' => 'pros',
		'quarto' => 'quartos',
		'kimono' => 'kimonos',
		'ox' => 'oxen',
		'die' => 'dice',
		'foot' => 'feet',
		'goose' => 'geese',
		'quiz' => 'quizzes',
		'human' => 'humans',
		'proof' => 'proofs',
		'carve' => 'carves',
		'valve' => 'valves',
		'thief' => 'thieves',
		'groove' => 'grooves',
		'stigma' => 'stigmata',
		'genus' => 'genera',
		'viscus' => 'viscera',
		'syllabus' => 'syllabi',
	);

	/**
	 *
	 */
	public $uncountableRules = array(
		'advice', 'agenda', 'bison', 'bream', 'buffalo', 'carp', 'chassis',
		'cod', 'cooperation', 'corps', 'digestion', 'debris', 'diabetes',
		'energy', 'equipment', 'elk', 'excretion', 'expertise', 'flounder',
		'gallows', 'graffiti', 'headquarters', 'health', 'herpes', 'highjinks',
		'homework', 'information', 'jeans', 'justice', 'labour', 'machinery',
		'mackerel', 'media', 'mews', 'money', 'moose', 'news', 'pike', 'plankton',
		'pliers', 'pollution', 'rain', 'rice', 'salmon', 'scissors', 'series',
		'sewage', 'shrimp', 'species', 'staff', 'swine', 'trout', 'tuna',
		'whiting', 'wildebeest',
		'/pox$/',
		'/ois$/',
		'/deer$/',
		'/fish$/',
		'/sheep$/',
		'/measles$/',
		'/[nrlm]ese$/'
	);

	public function __construct()
	{
		$this->pluralRules = array_reverse($this->pluralRules);
	}

	public function irregular($word)
	{
		return isset($this->irregularRules[$word]) ? $this->irregularRules[$word] : false;
	}

	public function uncountable()
	{

	}
}

