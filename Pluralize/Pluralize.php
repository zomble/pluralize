<?php

namespace Pluralize;

class Pluralize
{
	/**
	 * @var \Pluralize\RuleSet
	 */
	protected $ruleset;

	public function __construct($options = array())
	{
		$this->ruleset(new RuleSet());
	}

	/**
	 * @param string|\Pluralize\RuleSet $rulesetClass
	 * @return \Pluralize\RuleSet
	 */
	public function ruleset($rulesetClass = null)
	{
		if (!is_null($rulesetClass)) {
			if ($rulesetClass instanceof \Pluralize\RuleSet) {
				$this->ruleset = $rulesetClass;
			} else {
				$this->ruleset = new $rulesetClass();
			}
		}
		return $this->ruleset;
	}

	public function fix($word, $count = 0, $includeCount = false)
	{
		return ($includeCount ? $count + ' ' : '') . ($count === 1 ? $this->singular($word) : $this->plural($word));
	}

	public function singular($word)
	{
		return $word;
	}

	public function plural($word)
	{
		if ($irregular = $this->ruleset()->irregular($word)) {
			return $irregular;
		}

		foreach ($this->ruleset()->uncountableRules as $rule) {
			$found = ($rule === $word || (@preg_match($rule, $word, $matches) !== false && count($matches)));
			if ($found) {
				return $word;
			}
		}

		foreach ($this->ruleset()->pluralRules as $rule => $replacement) {
			$found = preg_replace($rule, $replacement, $word);
			if ($found != $word) {
				return $found;
			}
		}
	}
}

