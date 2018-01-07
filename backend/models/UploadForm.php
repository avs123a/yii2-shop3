<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
	public $newfile1;
	
	public function rules()
	{
		return [
		    [['newfile1'], 'file', 'extensions' => 'png', 'mimeTypes' => 'image/png', 'skipOnEmpty' => false]
		];		
	}
	
}