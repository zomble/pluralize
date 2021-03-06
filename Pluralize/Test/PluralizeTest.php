<?php

namespace Pluralize\Test;

use Pluralize\Pluralize;

class PluralizeTest extends \PHPUnit_Framework_TestCase
{
	public function testRuleSet()
	{
		$pluralize = new Pluralize();
		$result = $pluralize->ruleset();
		$this->assertInstanceOf('\Pluralize\RuleSet', $result);
	}

	/**
	 * @param string $test
	 * @param string $expected
	 *
	 * @dataProvider providerPlurals
	 */
	public function testPluralization($test, $expected)
	{
		$pluralize = new Pluralize();
		$this->assertEquals($expected, $pluralize->plural($test));
	}

	/**
	 * Do the opposite.
	 *
	 * @param string $expected
	 * @param string $test
	 *
	 * @dataProvider providerPlurals
	 */
	public function testSingular($expected, $test)
	{
		$pluralize = new Pluralize();
		$this->assertEquals($expected, $pluralize->singular($test));
	}

	/**
	 * @param $test
	 * @param $expected
	 *
	 * @dataProvider providerPlurals
	 */
	public function testCount($single, $plural) {
		$pluralize = new Pluralize();
		$this->assertEquals('1 ' . $single, $pluralize->fix($plural, 1, true));
		$this->assertEquals('5 ' . $plural, $pluralize->fix($single, 5, true));
		$this->assertEquals('1 ' . $single, $pluralize->fix($plural, 1, true));
		$this->assertEquals('5 ' . $plural, $pluralize->fix($single, 5, true));
	}

	/**
	 * @param $test
	 * @param $expected
	 *
	 * @dataProvider providerPlurals
	 */
	public function testAutomaticCasing($test, $expected) {
		$test = ucfirst($test);
		$expected = ucfirst($expected);
		$pluralize = new Pluralize();
		$this->assertEquals($expected, $pluralize->fix($test));
	}

	/**
	 * @param $test
	 * @param $expected
	 *
	 * @dataProvider providerPlurals
	 */
	public function testAutomaticCapitalCasing($test, $expected) {
		$test = strtoupper($test);
		$expected = strtoupper($expected);
		$pluralize = new Pluralize();
		$this->assertEquals($expected, $pluralize->fix($test));
	}

	public function providerPlurals()
	{
		return array(
			// Uncountables
			array('fish', 'fish'),
			array('media', 'media'),
			array('moose', 'moose'),
			array('money', 'money'),
			array('sheep', 'sheep'),
			array('series', 'series'),
			array('species', 'species'),
			array('agenda', 'agenda'),
			array('news', 'news'),
			array('reindeer', 'reindeer'),
			array('starfish', 'starfish'),
			// Pluralization
			array('man', 'men'),
			array('ox', 'oxen'),
			array('bus', 'buses'),
			array('wife', 'wives'),
			array('guest', 'guests'),
			array('thing', 'things'),
			array('guess', 'guesses'),
			array('person', 'people'),
			array('meteor', 'meteors'),
			array('chateau', 'chateaux'),
			array('lap', 'laps'),
			array('cough', 'coughs'),
			array('death', 'deaths'),
			array('coach', 'coaches'),
			array('boy', 'boys'),
			array('guy', 'guys'),
			array('girl', 'girls'),
			array('chair', 'chairs'),
			array('tomato', 'tomatoes'),
			array('potato', 'potatoes'),
			array('hero', 'heroes'),
			array('volcano', 'volcanoes'),
			array('cherry', 'cherries'),
			array('piano', 'pianos'),
			array('monkey', 'monkeys'),
			array('day', 'days'),
			array('lady', 'ladies'),
			array('bath', 'baths'),
			array('professional', 'professionals'),
			array('dwarf', 'dwarves'), // `dwarfs`
			array('plural', 'plurals'),
			array('encyclopedia', 'encyclopedias'),
			array('louse', 'lice'),
			array('roof', 'rooves'),
			array('woman', 'women'),
			array('formula', 'formulas'),
			array('polyhedron', 'polyhedra'),
			array('index', 'indices'), // Maybe `indexes`
			array('matrix', 'matrices'),
			array('vertex', 'vertices'),
			array('ax', 'axes'), // How to go back to `axis` v `axe`, or is it `ax`?
			array('crisis', 'crises'),
			array('criterion', 'criteria'), // Should this just go one way, no one says `criterion`
			array('phenomenon', 'phenomena'),
			array('addendum', 'addenda'),
			array('datum', 'data'), // Another which really only goes one way
			array('forum', 'forums'),
			array('millennium', 'millennia'),
			array('alumnus', 'alumni'),
			array('medium', 'mediums'),
			array('census', 'censuses'),
			array('genus', 'genera'),
			array('dogma', 'dogmas'),
			array('life', 'lives'),
			array('hive', 'hives'),
			array('kiss', 'kisses'),
			array('dish', 'dishes'),
			array('human', 'humans'),
			array('knife', 'knives'),
			array('phase', 'phases'),
			array('judge', 'judges'),
			array('class', 'classes'),
			array('witch', 'witches'),
			array('church', 'churches'),
			array('massage', 'massages'),
			array('prospectus', 'prospectuses'),
			array('syllabus', 'syllabi'),
			array('viscus', 'viscera'),
			array('cactus', 'cacti'),
			array('hippopotamus', 'hippopotamuses'),
			array('octopus', 'octopi'), // `octopuses`, `octopodes`
			array('platypus', 'platypuses'),
			array('kangaroo', 'kangaroos'),
			array('atlas', 'atlases'),
			array('stigma', 'stigmata'),
			array('schema', 'schemas'),
			array('phenomenon', 'phenomena'),
			array('diagnosis', 'diagnoses'),
			array('mongoose', 'mongooses'),
			array('mouse', 'mice'),
			array('liturgist', 'liturgists'),
			array('box', 'boxes'),
			array('gas', 'gases'),
			array('self', 'selves'),
			array('chief', 'chiefs'),
			array('quiz', 'quizzes'),
			array('cherry', 'cherries'),
			array('child', 'children'),
			array('syllabus', 'syllabi'),
			array('shelf', 'shelves'),
			array('fizz', 'fizzes'),
			array('thief', 'thieves'),
			array('day', 'days'),
			array('loaf', 'loaves'),
			array('mango', 'mangoes'),
			array('fix', 'fixes'),
			array('spy', 'spies'),
			array('day', 'days'),
			array('vertebra', 'vertebrae'),
			array('clock', 'clocks'),
			array('lap', 'laps'),
			array('cuff', 'cuffs'),
			array('leaf', 'leaves'),
			array('calf', 'calves'),
			array('moth', 'moths'),
			array('mouth', 'mouths'),
			array('house', 'houses'),
			array('proof', 'proofs'),
			array('hoof', 'hooves'),
			array('elf', 'elves'),
			array('turf', 'turfs'),
			array('craft', 'crafts'),
			array('die', 'dice'),
			array('penny', 'pennies'),
			array('campus', 'campuses'),
			array('platypus', 'platypuses'),
			array('virus', 'viri'), // `viruses`
			array('bureau', 'bureaux'),
			array('kiwi', 'kiwis'),
			array('wiki', 'wikis'),
			array('igloo', 'igloos'),
			array('ninja', 'ninjas'),
			array('pizza', 'pizzas'),
			array('kayak', 'kayaks'),
			array('canoe', 'canoes'),
			array('tiding', 'tidings'),
			array('pea', 'peas'),
			array('drive', 'drives'),
			array('nose', 'noses'),
			array('movie', 'movies'),
			array('status', 'statuses'),
			array('alias', 'aliases'),
			array('memorandum', 'memorandums'),
			array('language', 'languages'),
			array('plural', 'plurals'),
			array('word', 'words'),
			array('multiple', 'multiples'),
			array('reward', 'rewards'),
			array('sandwich', 'sandwiches'),
			array('subway', 'subways'),
			array('direction', 'directions'),
			array('land', 'lands'),
			array('row', 'rows'),
			array('rose', 'roses'),
			array('raise', 'raises'),
			array('friend', 'friends'),
			array('follower', 'followers'),
			array('male', 'males'),
			array('nail', 'nails'),
			array('sex', 'sexes'),
			array('tape', 'tapes'),
			array('ruler', 'rulers'),
			array('king', 'kings'),
			array('queen', 'queens'),
			array('zero', 'zeros'),
			array('quest', 'quests'),
			array('goose', 'geese'),
			array('foot', 'feet'),
			array('ex', 'exes'),
			array('heat', 'heats'),
			array('train', 'trains'),
			array('test', 'tests'),
			array('pie', 'pies'),
			array('fly', 'flies'),
			array('eye', 'eyes'),
			array('lie', 'lies'),
			array('node', 'nodes'),
			array('chinese', 'chinese'),
			array('regex', 'regexes'),
			array('license', 'licenses'),
			array('zebra', 'zebras'),
			array('general', 'generals'),
			array('corps', 'corps'),
			array('pliers', 'pliers'),
			array('scissors', 'scissors'),
			array('fireman', 'firemen'),
			array('chirp', 'chirps'),
			array('harp', 'harps'),
			array('corpse', 'corpses'),
			array('dye', 'dyes'),
			array('move', 'moves'),
			array('zombie', 'zombies'),
			array('tie', 'ties'),
			array('groove', 'grooves'),
			array('bee', 'bees'),
			array('ave', 'aves'),
			array('wave', 'waves'),
			array('wolf', 'wolves'),
			array('airwave', 'airwaves'),
			array('archive', 'archives'),
			array('dive', 'dives'),
			array('aftershave', 'aftershaves'),
			array('cave', 'caves'),
			array('grave', 'graves'),
			array('gift', 'gifts'),
			array('nerve', 'nerves'),
			array('nerd', 'nerds'),
			array('carve', 'carves'),
			array('rave', 'raves'),
			array('scarf', 'scarves'),
			array('sale', 'sales'),
			array('sail', 'sails'),
			array('swerve', 'swerves'),
			array('love', 'loves'),
			array('dove', 'doves'),
			array('glove', 'gloves'),
			array('wharf', 'wharves'),
			array('valve', 'valves'),
			array('werewolf', 'werewolves'),
			array('view', 'views'),
			array('emu', 'emus'),
			array('menu', 'menus'),
			array('wax', 'waxes'),
			array('fax', 'faxes'),
			array('nut', 'nuts'),
			array('crust', 'crusts'),
			array('chickenpox', 'chickenpox')
		);
	}
}
