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
			if ($rulesetClass instanceof RuleSet) {
				$this->ruleset = $rulesetClass;
			} else {
				$this->ruleset = new $rulesetClass();
			}
		}

		return $this->ruleset;
	}

	public function fix($word, $count = 0, $includeCount = false)
	{
		return ($includeCount ? $count . ' ' : '') . ($count === 1 ? $this->singular($word) : $this->plural($word));
	}

	public function singular($word)
	{
		$restoreCase = $this->restoreWordCase($word);
		$word = strtolower($word);

		if ($irregular = $this->ruleset()->irregular($word)) {
			return $restoreCase($word);
		}

		// There is no reverse look up, for plural to singular, so loop through them.
		foreach ($this->ruleset()->irregularRules as $rule => $replacement) {
			if ($replacement === $word) {
				return $restoreCase($rule);
			}
		}

		$found = $this->ruleset()->uncountable($word);
		if ($found) {
			return $restoreCase($word);
		}

		return $restoreCase($this->sanitize($word, $this->ruleset()->singularRules));
	}

	/**
	 * @param $word
	 * @return bool|mixed
	 */
	public function plural($word)
	{
		$restoreCase = $this->restoreWordCase($word);
		$word = strtolower($word);

		if ($irregular = $this->ruleset()->irregular($word)) {
			return $restoreCase($irregular);
		}

		$found = $this->ruleset()->uncountable($word);
		if ($found) {
			return $restoreCase($word);
		}


		return $restoreCase($this->sanitize($word, $this->ruleset()->pluralRules));
	}

	/**
	 * @param $word
	 * @param $rules
	 * @return string The word, or fixed word.
	 */
	protected function sanitize($word, $rules)
	{
		foreach ($rules as $rule => $replacement) {
			$found = preg_replace($rule, $replacement, $word);
			if ($found != $word) {
				return $found;
			}
		}
		return $word;
	}

	/**
	 * Detect current casing, and restore automagicaly later through a callable;
	 *
	 * @param $token string
	 *
	 * @return \Callable
	 */
	protected function restoreWordCase($token)
	{
		if ($token === strtoupper($token)) {
			return function ($word) {
				return strtoupper($word);
			};
		}

		if ($token === ucfirst($token)) {
			return function ($word) {
				return ucfirst($word);
			};
		}

		return function ($word) {
			return $word;
		};
	}
}

