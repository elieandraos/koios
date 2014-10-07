<?php

class News extends \Eloquent {
	protected $table = 'news';
	protected $fillable = ['name', 'description', 'caption', 'image', 'application_id', 'news_category_id'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function newsCategory()
	{
		return $this->belongsTo('NewsCategory');
	}

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'name' => 'required',
		'description' => 'required',
		'news_category_id' => 'required|exists:news_category,id'
	];

	public function isValid($data)
	{
		$validation = Validator::make($data, static::$rules);
		if($validation->passes())
		{
			return true;
		}

		$this->errors = $validation->messages();
		return false;
	}

	/****************
	 * IMAGE UPLOAD *
	 ****************/
	public function getUploadsPath()
	{
		$path = uploads_path().$this->newsCategory->application->slug."/news/";
		File::exists($path) or File::makeDirectory($path);
		$path .= $this->id."/";
		File::exists($path) or File::makeDirectory($path);
		return $path;
	}

	public function getUploadsRelativeUrl()
	{
		return uploads_relative_url().$this->newsCategory->application->slug."/news/".$this->id."/";
	}

	public function getImageThumbRelativeUrl()
	{
		return $this->getUploadsRelativeUrl()."30-".$this->image;
	}

	public function getImageRelativeUrl()
	{
		return $this->getUploadsRelativeUrl().$this->image;
	}


	public function uploadImage($uploaded_image)
	{
		
		$filename = NULL;
		if($uploaded_image)
		{
			$image = Image::make($uploaded_image->getRealPath()); 
			$filename = $uploaded_image->getClientOriginalName();
			$image->save($this->getUploadsPath().$filename)
				  ->resize(30, 30)
				  ->save($this->getUploadsPath()."30-".$filename);

			$this->update(['image' => $filename]);
		}
		return $filename;
	}
}