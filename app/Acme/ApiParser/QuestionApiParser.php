<?php namespace Acme\ApiParser;

class QuestionApiParser extends ApiParser 
{

	public function parse($question)
	{
		//common fields between methods in the news repos
		$output = [
			'id'   => $question['id'],
			'description' => $question['description'],
			'thumb' => $question['thumb']
		];


		if(array_key_exists('image', $question))
			 $output['image'] = $question['image'];

		if(array_key_exists('answers', $question))
	 		$output['answers'] = $this->parseAnswers( $question['answers'] );

	 	if(array_key_exists('api_url', $question))
	 		$output['url'] = $question['api_url'];

		return $output;
	}

	public function parseAnswers($answers)
	{
		return array_map( function($answer){
			return [
				'id' => $answer['id'],
				'description' => $answer['description'],
				'valid' => (bool) $answer['is_correct'] 
			];
		}, $answers);
	}
	
}

