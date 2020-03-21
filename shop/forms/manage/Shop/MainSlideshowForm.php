<?php
/**
 * Created by PhpStorm.
 * User: a35b62
 * Date: 28.01.19
 * Time: 5:18
 */

namespace shop\forms\manage\Shop;


use shop\entities\Shop\MainSlideshow;
use yii\base\Model;
use yii\web\UploadedFile;

class MainSlideshowForm extends Model
{
    public $title;
    public $text;
    public $link;
    public $sort;

    /**
     * @var UploadedFile[]
     */
    public $image;

    private $_slideshow;

    public function __construct(MainSlideshow $slideshow = null, $config = [])
    {
        if ($slideshow) {
            $this->title = $slideshow->title;
            $this->text = $slideshow->text;
            $this->link = $slideshow->link;
            $this->sort = $slideshow->sort;
            $this->image = $slideshow->image;
            $this->_slideshow = $slideshow;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['image', 'required', 'on' => 'create'],
            [['text', 'title', 'link'], 'string', 'max' => 255],
            [['image'], 'image'],
            [['sort'], 'integer', 'min' => 1],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'title' => 'Наименование',
            'text' => 'Текст',
            'image' => 'Изображение',
            'link' => 'Ссылка',
            'sort' => 'Сортировка'
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->image = UploadedFile::getInstance($this, 'image');
            return true;
        }
        return false;
    }
}