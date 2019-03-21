<?php

class TranslationProcessor
{
	private $jsonFile;
	protected $timeCodes;
	protected $translation;
	protected $wordTimeCodes;
	private $dataFromFile;

	/**
	 * TranslationProcessor constructor.
	 * @param string $jsonFile
	 */
	public function __construct(string $jsonFile)
	{
		$this->jsonFile = $jsonFile;
	}

	/**
	 * @return $this
	 */
	public function translateTextWithTimeCodes()
	{
		$this->dataFromFile = $this->getDecodedJsonFileContents();
		$this->setTimeCodes();
		$this->setWordTimeCode();
		$this->setTranslation();
		$this->mapTimecodesAndTranslation();

		return $this;
	}

	private function mapTimecodesAndTranslation()
	{
		$translationArray = $this->getTranslationArray();

		foreach ($this->timeCodes as $key => &$timeCodes) {
			$timeCodes['translation'] = $translationArray[$key];
		}
	}

	/**
	 * @return string
	 */
	public function toJson(): string
	{
		return html_entity_decode(
			json_encode(
				$this->timeCodes
			)
		);
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return $this->timeCodes;
	}

	/**
	 * @return array
	 */
	private function getTranslationArray(): array
	{
		$results = array_filter(explode('.', $this->translation));
		foreach ($results as &$sentence) {
			$sentence .= ".";
		}

		return $results;
	}

	/**
	 * @return mixed
	 */
	private function getDecodedJsonFileContents()
	{
		return json_decode(
			htmlentities(
				file_get_contents($this->jsonFile),
				ENT_NOQUOTES
			),
			true
		);
	}

	private function setTimeCodes()
	{
		$this->timeCodes = $this->dataFromFile['time_codes'] ?? [];
	}

	private function setTranslation()
	{
		$this->translation = $this->dataFromFile['translation'] ?? [];
	}

	private function setWordTimeCode()
	{
		$this->wordTimeCodes = $this->dataFromFile['word_time_codes'] ?? [];
	}
}
